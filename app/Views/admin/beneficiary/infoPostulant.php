<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Edición de beneficiario
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-0 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <input type="hidden" id="base_url" value="<?= base_url() ?>">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl ligth:bg-slate-850 ligth:shadow-ligth-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap items-start justify-between">
                            <h6 class="ligth:text-white text-xl mb-4 md:mb-0">Informaci&oacute;n</h6>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <button onclick="showVulnerabilities(<?= $beneficiary['beneficiary_id'] ?>)" title="Vulnerabilidad" class="inline-block px-4 py-2.5 bg-amber-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-amber-500"
                                            data-te-toggle="modal"
                                                data-te-target="#vulnerability_participant"
                                                data-te-ripple-init
                                                data-te-ripple-color="light"
                                                >
                                    <i class="fa-solid fa-user-injured"></i> 
                                    <span class="hidden sm:inline">Vulnerabilidades</span>
                                </button>
                                <a href="<?= base_url("admin/approve_postulant/{$beneficiary['beneficiary_id']}"); ?>" class="inline-block px-4 py-2.5 bg-green-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-500">
                                    <i class="fa-solid fa-check"></i> 
                                    <span class="hidden sm:inline">Aceptar</span>
                                </a>
                                <a href="<?= base_url("admin/drop_postulant/{$beneficiary['beneficiary_id']}"); ?>" class="inline-block px-4 py-2.5 bg-red-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-500">
                                    <i class="fa-solid fa-times"></i> 
                                    <span class="hidden sm:inline">Rechazar</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8" id="imprimir">
                        <div class="overflow-x-auto ml-4 pr-8 pl-4 pt-4 pb-4" >
                            <div class=" rounded overflow-hidden shadow-lg">
                                <div class="px-6 py-4 text-md">
                                    <h6 class="font-bold text-xl mb-2"><?= strtoupper("{$beneficiary['beneficiary_name']} {$beneficiary['beneficiary_lastname']}") ?></h6>
                                    
                                    <div class="flex flex-wrap -mx-2">
                                        <p class="w-full sm:w-1/2 px-2 mb-2"><strong class="font-bold">Edad:</strong> <?= ((new DateTime(date("Y-m-d")))->diff(new DateTime($beneficiary['beneficiary_datebirth'])))->y ?> Años</p>
                                        <p class="w-full sm:w-1/2 px-2 mb-2"><strong class="font-bold">C.I.:</strong> <?= "{$beneficiary['beneficiary_ci']} {$beneficiary['beneficiary_complement']}" ?></p>
                                        <p class="w-full sm:w-1/2 px-2 mb-2"><strong class="font-bold">Celular:</strong> <?= $beneficiary['beneficiary_celphone'] ?></p>
                                        <p class="w-full sm:w-1/2 px-2 mb-2"><strong class="font-bold">Fecha de Ingreso:</strong> <?= date('d-m-Y', strtotime($beneficiary['created_at'])) ?></p>
                                        <p class="w-full sm:w-1/2 px-2 mb-2"><strong class="font-bold">Correo:</strong> <?= $beneficiary['beneficiary_email'] ?></p>
                                        <p class="w-full sm:w-1/2 px-2 mb-2"><strong class="font-bold">Ciudad:</strong> <?= $beneficiary['city_name'] ?></p>
                                        <p class="w-full px-2 mb-2"><strong class="font-bold">Dirección:</strong> <?= $beneficiary['beneficiary_direction'] ?></p>
                                        <p class="w-full sm:w-1/2 px-2 mb-2"><strong class="font-bold">Horario:</strong> <?= $beneficiary['schedule_description'] ?></p>
                                        <p class="w-full sm:w-1/2 px-2 mb-2"><strong class="font-bold">Días de Trabajo:</strong> ...</p>
                                    </div>

                                    <hr class="my-4">

                                    <div class="space-y-3">
                                        <div>
                                            <p class="font-bold">Apoyo solicitado:</p>
                                            <p class="pl-4">
                                                <?= $beneficiary['beneficiary_entrepreneurship'] == 1 ? "Ayuda con su emprendimiento<br>":"" ?>
                                                <?= $beneficiary['beneficiary_job'] == 1 ? "Ayuda a buscar trabajo":"" ?>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="font-bold">Idea de Negocio:</p>
                                            <p class="pl-4"><?= $beneficiary['beneficiary_business'] ?></p>
                                        </div>
                                        <div>
                                            <p class="font-bold">Habilidades:</p>
                                            <p class="pl-4"><?= $beneficiary['beneficiary_skills'] ?></p>
                                        </div>
                                        <div>
                                            <p class="font-bold">Experiencia Laboral:</p>
                                            <p class="pl-4"><?= $beneficiary['beneficiary_experience'] ?></p>
                                        </div>
                                        <div>
                                            <p class="font-bold">Áreas de interés para trabajar:</p>
                                            <p class="pl-4"><?= $beneficiary['beneficiary_workarea'] ?></p>
                                        </div>
                                        <div>
                                            <p class="font-bold">Áreas donde NO le gustaría trabajar:</p>
                                            <p class="pl-4"><?= $beneficiary['beneficiary_notworkarea'] ?></p>
                                        </div>
                                        <div>
                                            <p class="font-bold">Medio por el que conoció el proyecto:</p>
                                            <p class="pl-4"><?= $beneficiary['sm_name'] ?></p>
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
    
    <div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="vulnerability_participant" tabindex="-1" aria-labelledby="titleModal" aria-modal="true" role="dialog">
        <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px]">
            <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none ligth:bg-neutral-600">
            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 ligth:border-opacity-50">
                <h5 class="text-xl font-medium leading-normal text-neutral-800 ligth:text-neutral-200">Vulnerabilidades</h5>
                <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                </button>
            </div>
            <div class="relative p-4">
                <div class="grid justify-items-end ...">
                    <button class="bg-amber-500 hover:bg-amber-700 text-white py-1 px-3 rounded mr-0" onclick="viewForm()" title="Agregar Vulnerabilidad">
                        <i class="fa-solid fa-plus"></i> Agregar Vulnerabilidad
                    </button>
                </div>
                <div id="newVulnerabilityForBeneficiary" style="display: none;">
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-3/8 px-3 mb-2 md:mb-0">
                            <input type="hidden" name="bevu_id" id="bevu_id" value="">
                            <input type="hidden" name="beneficiary_id" id="beneficiary_id" value="">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area_id">
                                VULNERABILIDAD<span class="text-red-600 ">*</span>
                            </label>
                            <select
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.area_id') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="vulnerability_id" name="vulnerability_id">
                                <?php foreach ($vulnerabilities as $vulnerability):?>
                                    <option value="<?= $vulnerability['vulnerability_id'] ?>"><?= $vulnerability['vulnerability_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-red-500 text-xs italic"></p>
                        </div>
                        <div class="w-full md:w-3/8 px-3 mb-2 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area_id">
                                OBSERVACION<span class="text-red-600 ">*</span>
                            </label>
                            <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.area_id') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white" id="vulnerability_observation">
                            <p class="text-red-500 text-xs italic"></p>
                        </div>
                        <div class="w-full md:w-1/8 px-3 mb-2 md:mb-0 md:mt-6">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-0" onclick="saveVulnerabilityBeneficiary()" title="Guardar">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-0" onclick="viewForm()" title="Cancelar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table">
                    <thead class="align-bottom">
                        <tr class="">
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                VULNERABILIDADES
                            </th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                OBSERVACION
                            </th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                        </tr>
                    </thead>
                    <tbody id="vulnerabilityBeneficiaryTable"></tbody>
                </table>
            </div>
                <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 ligth:border-opacity-50">
                    <button type="button" class="inline-block rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function showVulnerabilities(beneficiary){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/get_vulnerabilities`
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                beneficiary:beneficiary,
            },
            success: (result)=>{
                document.getElementById('beneficiary_id').value = beneficiary
                let vulnerabilities = JSON.parse(result)
                let html = ``
                if (vulnerabilities.length > 0) {
                    vulnerabilities.map( vulnerability => {
                        html += `
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    ${vulnerability.vulnerability_name}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent content-end">
                                    <div class="grid justify-items-center">${vulnerability.bevu_observation}</div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    <button title="Editar Vulnerabilidad" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" onClick="editVulnerability(${vulnerability.bevu_id})">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button title="Borrar Vulnerabilidad" class="inline-block px-2 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" onClick="deleteVulnerability(${vulnerability.bevu_id})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                        `
                    })
                }else{
                    html += `
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent content-end">
                                    No se agregaron vulnerabilidades
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    
                                </td>
                            </tr>
                        `
                }
                $('#vulnerabilityBeneficiaryTable').html(html);
            },
            error: (error)=>{}
        })
    }

    function viewForm(){
        // clearInputs()
        let newVulnerabilityForBeneficiary = document.getElementById('newVulnerabilityForBeneficiary').style.display;
        document.getElementById('newVulnerabilityForBeneficiary').style.display = newVulnerabilityForBeneficiary == 'none' ? 'block' : 'none';
    }

    function saveVulnerabilityBeneficiary(){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/save_vulnerabilities`
        let beneficiary = document.getElementById('beneficiary_id').value;
        let bevu = document.getElementById('bevu_id').value;
        let vulnerability = document.getElementById('vulnerability_id').value;
        let observation = document.getElementById('vulnerability_observation').value;
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                beneficiary:beneficiary,
                vulnerability:vulnerability,
                observation:observation,
                bevu:bevu
            },
            success: (result)=>{
                showVulnerabilities(beneficiary);
                viewForm()
                document.getElementById('beneficiary_id').value = "";
                document.getElementById('vulnerability_id').value = "";
                document.getElementById('bevu_id').value = "";
                document.getElementById('vulnerability_observation').value = "";
            },
            error: (error)=>{}
        })
    }

    function editVulnerability(bevu_id){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/edit_vulnerabilitie`
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                bevu_id:bevu_id
            },
            success: (result)=>{
                let vulnerability = JSON.parse(result)
                viewForm()
                document.getElementById('beneficiary_id').value = vulnerability.beneficiary_id;
                document.getElementById('vulnerability_id').value = vulnerability.vulnerability_id;
                document.getElementById('bevu_id').value = vulnerability.bevu_id;
                document.getElementById('vulnerability_observation').value = vulnerability.bevu_observation;

                var selectElement = document.getElementById("vulnerability_id");

                // Valor que deseas seleccionar
                var valorASeleccionar = vulnerability.vulnerability_id;

                // Itera a través de las opciones para encontrar la que coincide con el valor
                for (var i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value === valorASeleccionar) {
                        selectElement.options[i].selected = true;
                        break; // Termina el bucle una vez que se haya encontrado la opción
                    }
                }
            },
            error: (error)=>{}
        })
    }
    
    function deleteVulnerability(bevu_id){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/delete_vulnerabilitie`
        let beneficiary = document.getElementById('beneficiary_id').value;
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                bevu_id:bevu_id
            },
            success: (result)=>{
                showVulnerabilities(beneficiary);
                // viewForm()
                document.getElementById('beneficiary_id').value = "";
                document.getElementById('vulnerability_id').value = "";
                document.getElementById('vulnerability_observation').value = "";
            },
            error: (error)=>{}
        })
    }
</script>
<?= $this->endSection() ?>