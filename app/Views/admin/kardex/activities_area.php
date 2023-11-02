<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Actividades realizadas
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('admin/search/script') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-2 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl ligth:bg-slate-850 ligth:shadow-ligth-xl rounded-2xl bg-clip-border">
                    <input type="hidden" id="base_url" value="<?= base_url() ?>" >
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <?php if((session('msg'))): ?>
                            <div class="bg-<?= session('msg.type') ?>-100 border border-<?= session('msg.type') ?>-400 text-<?= session('msg.type') ?>-700 px-4 py-3 rounded relative mb-2" role="alert">
                                <span class="block sm:inline"><?= session('msg.body ') ?></span>
                            </div>
                        <?php endif ?>
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white text-xl">Actividades de <?= "{$beneficiary['beneficiary_name']} {$beneficiary['beneficiary_lastname']}" ?>: <?= count($activities) ?></h6>
                            </div>
                            <div class="absolute top-0 right-0">
                                <button onclick="supportBeneficiary(<?= $beneficiary['beneficiary_id'] ?>,'<?= $beneficiary['beneficiary_lastname'] ?> <?= $beneficiary['beneficiary_name'] ?>',<?= $areaBeneficiary_id ?>,<?= $beneficiary['kardex_id'] ?>)" title="Agregar actividad" class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out"
                                            data-te-toggle="modal"
                                                data-te-target="#addActivity"
                                                data-te-ripple-init
                                                data-te-ripple-color="light"
                                                >
                                                <i class="fa-solid fa-plus"></i> 
                                                Agregar Actividad
                                </button> 
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <?= $this->include('admin/search/input') ?>
                        <div class="p-3 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse light:border-white/40 text-slate-500 order-table table">
                                <thead class="align-bottom">
                                    <tr class="">
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none light:border-white/40 light:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            ACTIVIDAD
                                        </th>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none light:border-white/40 light:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            DESCRIPCIÓN
                                        </th>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none light:border-white/40 light:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            ESTADO
                                        </th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none light:border-white/40 light:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            CREADO
                                        </th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none light:border-white/40 light:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            ACTUALIZADO
                                        </th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none light:border-white/40 light:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($activities as $activity): ?>
                                        <?php 
                                            $created = date('d-m-Y', strtotime($activity['created_at']));
                                            $createdTime = date('H:m:s', strtotime($activity['created_at']));
                                            $updated = date('d-m-Y', strtotime($activity['updated_at']));
                                            $updatedTime = date('H:m:s', strtotime($activity['updated_at']));
                                        ?>
                                    <tr class="uppercase">
                                        <td class="p-2 align-middle bg-transparent border-b light:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal light:text-white whitespace-normal">
                                                        <?= $activity['support_name'] ?>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b light:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight light:text-white light:opacity-80 whitespace-normal">
                                                <?= $activity['detkar_description'] ?>
                                            </p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b light:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="bg-gradient-to-tl from-cyan-500 to-cyan-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-normal text-center align-baseline font-bold uppercase leading-none text-white ">
                                                <?= $activity['status_name'] ?>
                                            </span>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b light:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight light:text-white light:opacity-80">
                                                <?= $created ?>
                                            </p>
                                            <p class="mb-0 text-xs leading-tight light:git text-black light:opacity-80 text-gray-500">
                                                <?= $createdTime ?>
                                            </p>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b light:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight light:text-white light:opacity-80">
                                                <?= $updated ?>
                                            </p>
                                            <p class="mb-0 text-xs leading-tight light:git text-black light:opacity-80 text-gray-500">
                                                <?= $updatedTime ?>
                                            </p>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b light:border-white/40 whitespace-nowrap shadow-transparent">
                                            <button onclick="editSupportBeneficiary(<?= $activity['detkar_id'] ?>,<?= $beneficiary['beneficiary_id'] ?>,'<?= $beneficiary['beneficiary_lastname'] ?> <?= $beneficiary['beneficiary_name'] ?>',<?= $areaBeneficiary_id ?>,<?= $beneficiary['kardex_id'] ?>)" title="Vulnerabilidad" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                                                data-te-toggle="modal"
                                                data-te-target="#addActivity"
                                                data-te-ripple-init
                                                data-te-ripple-color="light">
                                                <i class="fa-solid fa-pencil"></i> 
                                            </button>
                                            <?php if($session['rol'] == 1): ?>
                                            <button onclick="deleteActivity(<?= $activity['detkar_id'] ?>)" title="Borrar" class="inline-block px-2 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="addActivity" tabindex="-1" aria-labelledby="titleModal" aria-modal="true" role="dialog">
    <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px]">
        <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none ligth:bg-neutral-600">
        <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 ligth:border-opacity-50">
            <h5 class="text-xl font-medium leading-normal text-neutral-800 ligth:text-neutral-200" id="titleModalActivitty"></h5>
            <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            </button>
        </div>
        <div class="relative p-4">
            <div id="newSupportForBeneficiary">
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-3/6 px-3 mb-2 md:mb-0">
                        <input type="hidden" name="beneficiary_id_support" id="beneficiary_id_support" value="">
                        <input type="hidden" name="kardex" id="kardex" value="">
                        <input type="hidden" name="detkardex" id="detkardex" value="">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="support_id">
                            Actividades<span class="text-red-600 ">*</span>
                        </label>
                        <select
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.support_id') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                            id="support_id" name="support_id">
                            <?php foreach ($supports as $support):?>
                                <option value="<?= $support['support_id'] ?>"><?= $support['support_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                            <p class="text-red-500 text-xs italic"></p>
                    </div>
                    <div class="w-full md:w-3/6 px-3 mb-2 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status_id">
                            ESTADO<span class="text-red-600 ">*</span>
                        </label>
                        <select
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.status_id') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                            id="status_id" name="status_id">
                            <?php foreach ($status as $state):?>
                                <option value="<?= $state['status_id'] ?>"><?= $state['status_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                            <p class="text-red-500 text-xs italic"></p> 
                    </div>
                    <div class="w-full md:w-6/6 px-3 mb-2 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="detkar_description">
                            DESCRIPCION<span class="text-red-600 ">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.compromise_description') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white" name="detkar_description" id="detkar_description" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
        </div>
            <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 ligth:border-opacity-50">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-3" onclick="saveSupportBeneficiary(<?= $areaBeneficiary_id ?>)" title="Guardar ayuda">
                    <i class="fa-solid fa-check"></i> Guardar
                </button>
                <button class="inline-block rounded bg-red-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-red-700 transition duration-150 ease-in-out hover:bg-red-accent-100 focus:bg-red-accent-100 focus:outline-none focus:ring-0 active:bg-red-accent-200" onclick="viewFormSupport()" title="Cancelar" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                    <i class="fa-solid fa-xmark"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    function supportBeneficiary(beneficiary,beneficiaryName,area, kardex) {
        $('#supportBeneficiaryTable').html("");
        document.getElementById("detkardex").value = "";
        document.getElementById("beneficiary_id_support").value = beneficiary;
        document.getElementById("kardex").value = kardex;
        document.getElementById('titleModalActivitty').innerHTML = beneficiaryName.toUpperCase()
    }
    
    function editSupportBeneficiary(activity,beneficiary,beneficiaryName,area, kardex) {
        $('#supportBeneficiaryTable').html("");
        document.getElementById("detkardex").value = activity;
        document.getElementById("beneficiary_id_support").value = beneficiary;
        document.getElementById("kardex").value = kardex;
        document.getElementById('titleModalActivitty').innerHTML = beneficiaryName.toUpperCase()
        
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/edit_support_beneficiary`
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                activity:activity
            },
            success: (result)=>{
                let detkar = JSON.parse(result);
                
                document.getElementById('detkar_description').value = detkar.detkar_description;

                let selectSupport = document.getElementById('support_id');
                let optionSupport = Array.from(selectSupport.options).find(function(option) {
                    return option.value === detkar.support_id;
                });

                if (optionSupport) {
                    optionSupport.selected = true;
                }

                let selectStatus = document.getElementById('status_id');
                let optionStatus = Array.from(selectStatus.options).find(function(option) {
                    return option.value === detkar.status_id;
                });

                if (optionStatus) {
                    optionStatus.selected = true;
                }

            },
            error: (error)=>{}
        })
    }

    function saveSupportBeneficiary(area){
        let beneficiary = document.getElementById('beneficiary_id_support').value;
        let kardex = document.getElementById('kardex').value;
        let detkardex = document.getElementById('detkardex').value;
        let detkar_description = document.getElementById('detkar_description').value;
        let support = document.getElementById('support_id').value;
        let status = document.getElementById('status_id').value;
        $('#AreaBeneficiaryTable').html("");
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/save_support_beneficiary`
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                beneficiary:beneficiary,
                kardex:kardex,
                detkar_description:detkar_description,
                support:support,
                status:status,
                area:area,
                detkardex:detkardex
            },
            success: (result)=>{
                window.location.reload();
            },
            error: (error)=>{}
        })
    }

    function deleteActivity(activity){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/delete_activity`
        if(confirm("Se borrará está actividad, ¿Está seguro?")){
            $.ajax({
                type: "POST",
                url: controller,
                data: {
                    activity:activity
                },
                success: (result)=>{
                    window.location.reload();
                },
                error: (error)=>{}
            })
        }
    }
</script>
<?= $this->endSection() ?>