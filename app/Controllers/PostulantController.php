<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\Beneficiary;
use App\Entities\Contact;
use App\Entities\Kardex;
use App\Entities\Postulant;

class PostulantController extends BaseController
{
    public function add(){
        $data['session'] = session()->get();
        $areaModel = model('AreaModel');
        $financierModel = model('FinancierModel');
        $data['financiers'] = $financierModel->where('status_id',1)->findAll();
        $data['areas'] = $areaModel->where('status_id',1)->findAll();
        return view('users/form_postulant',$data);
    }

    public function store()
{
    $validation = service('validation');

    // 1. Reglas de Validación (Ajustadas a los nuevos names)
    // Nota: La unicidad del CI la manejamos en el try-catch para soportar la combinación CI + Extensión
    $validation->setRules([
        'beneficiary_names'        => ['label' => 'Nombres', 'rules' => 'required|min_length[2]'],
        'beneficiary_lastnames'    => ['label' => 'Apellidos', 'rules' => 'required|min_length[2]'],
        'beneficiary_ci'           => ['label' => 'Carnet Identidad', 'rules' => 'required|numeric'],
        'beneficiary_ci_extension' => ['label' => 'Extensión CI', 'rules' => 'required'],
        'financier_id'             => ['label' => 'Financiador', 'rules' => 'required'],
    ]);

    // 2. Si falla la validación, volver atrás
    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()
            ->withInput()
            ->with('errors', $validation->getErrors())
            ->with('msg', ['type' => 'red', 'body' => 'Por favor corrija los errores del formulario.']);
    }

    // 3. Obtener todos los datos del POST
    $data = $this->request->getPost();

    // 4. Tratamiento de Datos Especiales

    // A) Checkboxes de "Otras Actividades"
    // Vienen como array ['Estudiar', 'Trabajar'], debemos guardarlos como string "Estudiar, Trabajar"
    if (isset($data['beneficiary_other_activities']) && is_array($data['beneficiary_other_activities'])) {
        $data['beneficiary_other_activities'] = implode(', ', $data['beneficiary_other_activities']);
    } else {
        $data['beneficiary_other_activities'] = null; // O cadena vacía ''
    }

    // B) Fechas de creación (Opcional, si no usas useTimestamps del modelo)
    // $data['beneficiary_created_at'] = date('Y-m-d H:i:s');

    // 5. Instanciar el Nuevo Modelo
    $model = new \App\Models\BeneficiaryModel();

    try {
        // 6. Guardar
        // El método save() determina automáticamente si es insert o update
        $model->save($data);
        
        // (Opcional) Obtener el ID insertado si necesitas hacer algo más
        $newId = $model->getInsertID();

        // 7. Redireccionar con Éxito
        return redirect()->route('application_form')->with('msg', [
            'type' => 'green',
            'body' => '¡El diagnóstico se guardó exitosamente!'
        ]);

    } catch (\Exception $e) {
        // 8. Manejo de Errores de Base de Datos
        
        // Código 1062 es "Duplicate entry" en MySQL
        if (strpos($e->getMessage(), '1062') !== false) {
            return redirect()->back()->withInput()->with('msg', [
                'type' => 'red',
                'body' => 'Error: Ya existe un beneficiario registrado con ese CI y Extensión.'
            ]);
        }

        // Otros errores
        return redirect()->back()->withInput()->with('msg', [
            'type' => 'red',
            'body' => 'Ocurrió un error al guardar: ' . $e->getMessage()
        ]);
    }
}

    function assemblyAreas($form){
        $areas = [];
        $areaModel = model('AreaModel');
        $activeAreas = $areaModel->where('status_id',1)->select('area_id')->findAll();
        foreach ($activeAreas as $activeArea) {
            if(isset($form["area_{$activeArea['area_id']}"]) && $form["area_{$activeArea['area_id']}"] == "on"){
                array_push($areas, $activeArea['area_id']);
            }
        }
        echo json_encode($areas);
        return $areas;
    }

    function saveAreaParticipant($beneficiary_id, $areasPostulant){
        $kardexModel = model('KardexModel');

        foreach ($areasPostulant as $ap) {
            $area_id = $ap;
            if(!$kardex = $kardexModel->where('beneficiary_id', $beneficiary_id)->select('kardices.kardex_id,kardices.beneficiary_area')->first()){
                $formData = [
                    'beneficiary_id'        => $beneficiary_id,
                    'beneficiary_area'      => "$area_id",
                ];
                $kardex = new Kardex($formData);
                $kardexModel->save($kardex);
            }else{
                if(!strstr($kardex['beneficiary_area'],"$area_id")){
                        $formData = [
                            'kardex_id'             => $kardex['kardex_id'],
                            'beneficiary_id'        => $beneficiary_id,
                            'beneficiary_area'      => "{$kardex['beneficiary_area']},$area_id",
                        ];
                        $kardexModel->save($formData);
                }
            }
        }
    }

    function replaceStringElement($originalString, $searchElement, $replaceElement) {
        $newString = str_replace($searchElement, $replaceElement, $originalString);        
        return $newString;
    }
}
