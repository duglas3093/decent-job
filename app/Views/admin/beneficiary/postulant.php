<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Postulantes
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('admin/search/script') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <input type="hidden" value="<?= base_url(); ?>" id="base_url">
    <div class="w-full px-6 py-2 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl ligth:bg-slate-850 ligth:shadow-ligth-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <?php if((session('msg'))): ?>
                            <div class="bg-<?= session('msg.type') ?>-100 border border-<?= session('msg.type') ?>-400 text-<?= session('msg.type') ?>-700 px-4 py-3 rounded relative mb-2" role="alert">
                                <span class="block sm:inline"><?= session('msg.body ') ?></span>
                            </div>
                        <?php endif ?>
                        <div class="flex flex-wrap items-center justify-between">
                            <h6 class="ligth:text-white text-xl">Postulantes: <?= count($beneficiaries) ?></h6>
                            <?php if(count($beneficiaries) > 0): ?>
                                <button onclick="deletePostulants()" class="inline-block px-4 py-2.5 bg-yellow-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-yellow-500">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    <span class="hidden sm:inline ml-1">Eliminar postulaciones</span>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-4">
                        <?= $this->include('admin/search/input') ?>
                        <!-- Vista de Tabla para Escritorio -->
                        <div class="p-0 overflow-x-auto hidden md:block">
                            <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table" id="table">
                                <thead class="align-bottom">
                                    <tr class="">
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            NOMBRE
                                        </th>
                                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            CI
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            EDAD
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            CIUDAD
                                        </th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none ligth:border-white/40 ligth:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($beneficiaries as $beneficiary): ?>
                                    <tr class="uppercase">
                                        <td
                                            class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal ligth:text-white">
                                                        <?= $beneficiary['beneficiary_lastname'] ?> <?= $beneficiary['beneficiary_name'] ?>
                                                    </h6>
                                                    <p class="mb-0 text-xs leading-tight ligth:git text-black ligth:opacity-80 text-slate-400">
                                                        <?= $beneficiary['beneficiary_celphone'] ?> <a class="text-green-500" href="https://wa.me/+591<?= $beneficiary['beneficiary_celphone'] ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80">
                                                <?= $beneficiary['beneficiary_ci'] ?>
                                            </p>
                                        </td>
                                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80 text-slate-400">
                                                <?= ((new DateTime(date("Y-m-d")))->diff(new DateTime($beneficiary['beneficiary_datebirth'])))->y ?> Años
                                            </span>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80 text-slate-400">
                                                <?= $beneficiary['city_name'] ?>
                                            </span>    
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <a href="<?= base_url("admin/info_postulant/{$beneficiary['beneficiary_id']}") ?>" title="Ver postulante" class="inline-block px-2 py-1.5 bg-sky-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-sky-700 hover:shadow-lg focus:bg-sky-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-sky-800 active:shadow-lg transition duration-150 ease-in-out"
                                                >
                                                <!-- <i class="fa-solid fa-check"></i> -->
                                                <i class="fa-solid fa-eye"></i>
                                            </a> 
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Vista de Tarjetas para Móviles -->
                        <div class="block md:hidden px-4" id="cards">
                            <?php if(count($beneficiaries) > 0): ?>
                                <?php foreach($beneficiaries as $beneficiary): ?>
                                <div class="card-item bg-white border border-gray-200 rounded-lg shadow-md p-4 mb-4 uppercase">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h6 class="mb-1 text-sm font-bold leading-normal ligth:text-white">
                                                <?= $beneficiary['beneficiary_lastname'] ?> <?= $beneficiary['beneficiary_name'] ?>
                                            </h6>
                                            <p class="mb-1 text-xs leading-tight text-slate-500">
                                                <i class="fa-solid fa-id-card mr-1"></i> CI: <?= $beneficiary['beneficiary_ci'] ?>
                                            </p>
                                            <p class="mb-2 text-xs leading-tight text-slate-500">
                                                <i class="fa-solid fa-cake-candles mr-1"></i> <?= ((new DateTime(date("Y-m-d")))->diff(new DateTime($beneficiary['beneficiary_datebirth'])))->y ?> Años
                                            </p>
                                        </div>
                                        <a href="<?= base_url("admin/info_postulant/{$beneficiary['beneficiary_id']}") ?>" title="Ver postulante" class="inline-block px-3 py-2 bg-sky-600 text-white font-medium text-lg leading-tight uppercase rounded shadow-md hover:bg-sky-700">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                    <hr class="my-2">
                                    <div class="text-xs text-slate-500">
                                        <span><i class="fa-solid fa-phone mr-1"></i> <?= $beneficiary['beneficiary_celphone'] ?></span>
                                        <a class="text-green-500 ml-1" href="https://wa.me/+591<?= $beneficiary['beneficiary_celphone'] ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                                        <span class="ml-3"><i class="fa-solid fa-map-marker-alt mr-1"></i> <?= $beneficiary['city_name'] ?></span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function deletePostulants(){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/delete_all_postulants`
        let message = 'Se borraran todas las postulaciones'
        if (confirm(message)) {
            $.ajax({
                type: "POST",
                url: controller,
                data: {},
                success: (result)=>{
                    location.reload()
                },
                error: (error)=>{}
            })
        }
    }

    // function dropPostulant(beneficiary) {
    //     let url = document.getElementById("base_url").value;
    //     let controller = `${url}/admin/drop_postulant`
    //     $.ajax({
    //         type: "POST",
    //         url: controller,
    //         data: {beneficiary:beneficiary},
    //         success: (result)=>{},
    //         error: (error)=>{}
    //     })
    // }
</script>
<?= $this->endSection() ?>