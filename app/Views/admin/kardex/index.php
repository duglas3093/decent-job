<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Kardex de NOMBRE_DEL_BENEFICIARIO
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
    $questionnaire_id_to_fill = 4 //questionnaire 2 
?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-0 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl ligth:bg-slate-850 ligth:shadow-ligth-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex justify-between items-center flex-wrap gap-4">
                            <div>
                                <h6 class="ligth:text-white text-xl leading-tight">KARDEX DE <br class="sm:hidden"> <?= strtoupper("{$beneficiary['beneficiary_name']} {$beneficiary['beneficiary_lastname']}") ?></h6>
                            </div>
                            <div>
                                <button onclick="printKardex('imprimir')" class="inline-block px-4 py-2 bg-slate-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-slate-500 focus:outline-none focus:ring-0 active:bg-slate-600 transition duration-150 ease-in-out" title="Imprimir">
                                    <i class="fa-solid fa-print"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <div class="overflow-x-auto ml-4 pr-8 pl-4 pt-4 pb-4" >
                            <div class=" rounded overflow-hidden shadow-lg" id="imprimir">
                                <div class="px-6 py-4">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-y-2 md:gap-x-4 text-sm">
                                        <div class="md:col-span-7">
                                            <h6 class="font-bold text-xl mb-2"><?= strtoupper("{$beneficiary['beneficiary_name']} {$beneficiary['beneficiary_lastname']}") ?></h6>
                                        </div>
                                        <div class="md:col-start-9 md:col-span-4">
                                            <span class="font-bold text-md">Edad: </span>
                                            <?= ((new DateTime(date("Y-m-d")))->diff(new DateTime($beneficiary['beneficiary_datebirth'])))->y ?> Años
                                        </div>
                                        <div class="md:col-span-8">
                                            <span class="font-bold text-md">C.I.: </span>
                                            <?= "{$beneficiary['beneficiary_ci']} {$beneficiary['beneficiary_complement']}" ?>
                                        </div>
                                        <!-- <div class="col-start-9 col-end-12 ">
                                            <span class="font-bold text-md">REF: </span>
                                            ...
                                        </div> -->
                                        <div class="md:col-span-12">
                                            <span class="font-bold text-md">CEL.: </span>
                                            <?= $beneficiary['beneficiary_celphone'] ?>
                                        </div>
                                        <div class="md:col-span-8">
                                            <span class="font-bold text-md">FECHA DE INGRESO: </span>
                                            <?= date('d-m-Y', strtotime($beneficiary['created_at'])) ?>
                                        </div>
                                        <div class="md:col-span-8 break-words">
                                            <span class="font-bold text-md">CORREO: </span>
                                            <?= $beneficiary['beneficiary_email'] ?>
                                        </div>
                                        <div class="md:col-start-9 md:col-span-4">
                                            <span class="font-bold text-md">CIUDAD: </span>
                                            <?= $beneficiary['city_name'] ?>
                                        </div>
                                        <div class="md:col-span-12">
                                            <span class="font-bold text-md">DIRECCION: </span>
                                            <?= $beneficiary['beneficiary_direction'] ?>
                                        </div>
                                        <div class="md:col-span-12">
                                            <span class="font-bold text-md">HORARIO: </span>
                                            <?= $beneficiary['schedule_description'] ?>
                                        </div>
                                        <div class="md:col-span-12">
                                            <span class="font-bold text-md">DIAS DE TRABAJO: </span>
                                            <?php 
                                                $diasSemana = $beneficiary['beneficiary_days'];

                                                $reemplazo = array(
                                                    '1' => 'Lunes',
                                                    '2' => 'Martes',
                                                    '3' => 'Miércoles',
                                                    '4' => 'Jueves',
                                                    '5' => 'Viernes',
                                                    '6' => 'Sábado',
                                                    '7' => 'Domingo',
                                                );
                                                
                                                $diasSemana = str_replace(array_keys($reemplazo), $reemplazo, $diasSemana);
                                                
                                                $diasSemana = rtrim($diasSemana, ',');
                                                
                                                echo $diasSemana;
                                            ?>
                                        </div>
                                        <div class="md:col-span-11 md:col-start-2 mt-4">
                                            <span class="font-bold text-md">QUIERE: </span>
                                            <?= $beneficiary['beneficiary_entrepreneurship'] == 1 ? "Ayuda con su emprendimiento<br>":"" ?>
                                            <?= $beneficiary['beneficiary_job'] == 1 ? "Ayuda a buscar trabajo":"" ?>
                                        </div>
                                        <?php if($beneficiary['beneficiary_entrepreneurship'] == 1): ?>
                                            <div class="md:col-span-11 md:col-start-2">
                                                <span class="font-bold text-md">IDEA DE NEGOCIO: </span>
                                                <?= $beneficiary['beneficiary_business'] ?>
                                            </div>
                                            <div class="md:col-span-11 md:col-start-2">
                                                <span class="font-bold text-md">HABILIDADES: </span>
                                                <?= $beneficiary['beneficiary_skills'] ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($beneficiary['beneficiary_job'] == 1): ?>
                                            <div class="md:col-span-11 md:col-start-2">
                                                <span class="font-bold text-md">EXPERIENCIA LABORAL: </span>
                                                <?= $beneficiary['beneficiary_experience'] ?>
                                            </div>
                                            <div class="md:col-span-11 md:col-start-2">
                                                <span class="font-bold text-md">DESEO: </span>
                                                <?= $beneficiary['beneficiary_workarea'] ?>
                                            </div>
                                            <div class="md:col-span-11 md:col-start-2">
                                                <span class="font-bold text-md">NO DESEO: </span>
                                                <?= $beneficiary['beneficiary_notworkarea'] ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="md:col-span-11 md:col-start-2">
                                            <span class="font-bold text-md">ULTIMO GRADO/PROFESION: </span>
                                            <?= $beneficiary['beneficiary_grade'] ?>
                                        </div>
                                        </div>
                                        <!-- <div class="md:col-span-11 md:col-start-2">
                                            <span class="font-bold text-md">OBSERVACIONES: </span>
                                            ...
                                        </div> -->
                                        <div class="md:col-span-11 md:col-start-2">
                                            <span class="font-bold text-md">MEDIO POR EL QUE CONOCIO EL PROYECTO: </span>
                                            <?= $beneficiary['sm_name'] ?>
                                        </div>
                                    </div>
                                    <div class="mt-8 mb-5">
                                        <div class="w-full">
                                            <a href="<?= base_url("admin/questionnaire/fill/{$beneficiary['beneficiary_id']}/{$questionnaire_id_to_fill}"); ?>" 
                                                class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out"
                                                title="Nuevo seguimiento">
                                                <i class="fa-solid fa-plus"></i>
                                                Nuevo seguimiento
                                            </a>
                                            <div class="mt-6">
                                                <table class="w-full text-sm text-left text-gray-500">
                                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 hidden md:table-header-group">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-3">#</th>
                                                            <th scope="col" class="px-6 py-3">Área / Cuestionario</th>
                                                            <th scope="col" class="px-6 py-3">Fecha</th>
                                                            <th scope="col" class="px-6 py-3">Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $cont = 1;
                                                            foreach ($submissions as $submission): 
                                                        ?>
                                                        <tr class="bg-white border-b hover:bg-gray-50 block md:table-row rounded-lg shadow-md md:shadow-none mb-4 md:mb-0">
                                                            <td class="p-4 md:px-6 md:py-4 md:border-b md:table-cell block" data-label="#">
                                                                <span class="font-bold text-gray-700"><?= $cont ?></span>
                                                            </td>
                                                            <td class="p-4 md:px-6 md:py-4 md:border-b md:table-cell block" data-label="Área">
                                                                <?= esc($submission['questionnaire_title']) ?>
                                                            </td>
                                                            <td class="p-4 md:px-6 md:py-4 md:border-b md:table-cell block" data-label="Fecha">
                                                                <?= date('d-m-Y', strtotime($submission['submitted_at'])) ?>
                                                            </td>
                                                            <td class="p-4 md:px-6 md:py-4 md:border-b md:table-cell block" data-label="Acciones">
                                                                <div class="flex flex-col sm:flex-row gap-2">
                                                                    <a href="<?= base_url("admin/submission/edit/{$submission['submission_id']}"); ?>" 
                                                                        class="inline-block text-center px-3 py-1.5 bg-yellow-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-yellow-600 transition duration-150 ease-in-out" 
                                                                        title="Corregir Respuestas">
                                                                        <i class="fa-solid fa-edit"></i> <span class="sm:inline">Editar</span>
                                                                    </a>

                                                                    <a href="<?= base_url("admin/submission/view/{$submission['submission_id']}"); ?>" 
                                                                        class="inline-block text-center px-3 py-1.5 bg-gray-500 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-gray-600 transition duration-150 ease-in-out" 
                                                                        title="Ver Respuestas (Solo Lectura)">
                                                                        <i class="fa-solid fa-eye"></i> <span class="sm:inline">Ver</span>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                            $cont++; 
                                                            endforeach; 
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* Estilos para la vista de tarjetas en móviles */
    @media (max-width: 767px) {
        /* Oculta el thead en móviles */
        table thead {
            display: none;
        }
        /* Añade la etiqueta de datos antes del contenido de la celda */
        table td::before {
            content: attr(data-label);
            font-weight: bold;
            display: inline-block;
            margin-right: 0.5rem;
        }
    }
</style>

<script>
    function printKardex(idDiv) {
        const printWindow = window.open('', '_blank');
        const contentDiv = document.getElementById(idDiv).outerHTML
        const contentHTML = `
                            <html>
                                <head>
                                    <title></title>
                                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
                                    <style></style>
                                </head>
                                <body>
                                    ${contentDiv}
                                </body>
                            </html>
                            `;

        printWindow.document.open();
        printWindow.document.write(contentHTML);
        printWindow.document.close();

        setTimeout(function() {
            printWindow.print();
            printWindow.close();
        }, 500);
    }
</script>
<?= $this->endSection() ?>