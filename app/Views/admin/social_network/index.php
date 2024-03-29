<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Ciudades
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('admin/search/script') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <!-- <input type="hidden" value="<?= base_url(); ?>" id="base_url"> -->
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
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white text-xl">Redes Sociales: <?= count($smedias) ?></h6>
                            </div>
                            <div class="absolute top-0 right-0">
                                <a href="<?= base_url("admin/add_social_network"); ?>" class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">
                                    <i class="fa-solid fa-plus"></i> 
                                    Agregar Red Social
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <?= $this->include('admin/search/input') ?>
                        <div class="p-3 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table">
                                <thead class="align-bottom">
                                    <tr class="">
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            RED SOCIAL
                                        </th>
                                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            ESTADO
                                        </th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none ligth:border-white/40 ligth:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($smedias as $smedia): ?>
                                    <tr class="uppercase">
                                        <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80">
                                            <?= $smedia['sm_name'] ?>
                                            </p>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="bg-gradient-to-tl <?= $smedia['status_name'] == 'Activo' ? "from-emerald-500 to-teal-400":"from-red-500 to-red-400" ?> px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                <?= $smedia['status_name'] ?>
                                            </span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <a href="<?= base_url("admin/edit_social_network/{$smedia['sm_id']}") ?>" title="Editar red social" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a> 
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
<?= $this->endSection() ?>