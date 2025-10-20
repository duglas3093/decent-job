<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Cuestionarios
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('admin/search/script') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
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
                            <h6 class="ligth:text-white text-xl">Cuestionarios: <?= count($questionnaries) ?></h6>
                            <a href="<?= base_url("admin/add_questionnarie"); ?>" class="inline-block px-4 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">
                                <i class="fa-solid fa-plus"></i>
                                <span class="ml-1 hidden sm:inline">Crear Cuestionario</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-4">
                        <?= $this->include('admin/search/input') ?>
                        
                        <!-- Vista de Tabla para Escritorio -->
                        <div class="p-0 overflow-x-auto hidden md:block">
                            <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table" id="table">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Cuestionario
                                        </th>
                                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Descripción
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Estado
                                        </th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none ligth:border-white/40 ligth:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($questionnaries as $questionnarie): ?>
                                    <tr class="uppercase">
                                        <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <h6 class="px-4 mb-0 text-sm leading-normal ligth:text-white"><?= $questionnarie['questionnarie_title'] ?></h6>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80 normal-case"><?= $questionnarie['questionnarie_description'] ?></p>
                                        </td>
                                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="bg-gradient-to-tl <?= $questionnarie['status_name'] == 'Activo' ? 'from-emerald-500 to-teal-400' : 'from-slate-600 to-slate-300' ?> px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                <?= $questionnarie['status_name'] ?>
                                            </span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <a href="<?= base_url("admin/edit_questionnarie/{$questionnarie['questionnarie_id']}") ?>" title="Editar Cuestionario" class="text-xs font-semibold leading-tight text-slate-400">
                                                <i class="fa-solid fa-pencil text-blue-600 text-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Vista de Tarjetas para Móviles -->
                        <div class="block md:hidden px-4" id="cards">
                            <?php foreach($questionnaries as $questionnarie): ?>
                            <div class="card-item bg-white border border-gray-200 rounded-lg shadow-md p-4 mb-4 uppercase">
                                <div class="flex justify-between items-start">
                                    <h6 class="mb-1 text-sm font-bold leading-normal ligth:text-white"><?= $questionnarie['questionnarie_title'] ?></h6>
                                    <a href="<?= base_url("admin/edit_questionnarie/{$questionnarie['questionnarie_id']}") ?>" title="Editar Cuestionario" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700">
                                        <i class="fa-solid fa-pencil"></i>
                                    </a>
                                </div>
                                <p class="mb-2 text-xs font-semibold leading-tight normal-case text-slate-600"><?= $questionnarie['questionnarie_description'] ?></p>
                                <span class="bg-gradient-to-tl <?= $questionnarie['status_name'] == 'Activo' ? 'from-emerald-500 to-teal-400' : 'from-slate-600 to-slate-300' ?> px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                    <?= $questionnarie['status_name'] ?>
                                </span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>