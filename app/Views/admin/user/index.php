<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Usuarios
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
                                <!-- <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-<?= session('msg.type') ?>-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span> -->
                            </div>
                        <?php endif ?>
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white">Tabla de usuarios</h6>
                            </div>
                            <div class="absolute top-0 right-0">
                                <a href="<?= base_url("admin/add_user"); ?>" class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">
                                    <i class="fa-solid fa-plus"></i> 
                                    Agregar Usuario
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <?= $this->include('admin/search/input') ?>
                        <div class="p-3 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Usuario
                                        </th>
                                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Celular
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Rol
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Estado
                                        </th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none ligth:border-white/40 ligth:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    
                                    <?php foreach($users as $user): ?>
                                    <tr>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <!-- <div>
                                                    <img src="../assets/img/team-2.jpg"
                                                        class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl"
                                                        alt="user1" />
                                                </div> -->
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal ligth:text-white"><?= $user['user_lastname'] ?> <?= $user['user_name'] ?>
                                                    </h6>
                                                    <p class="mb-0 text-xs leading-tight ligth:text-white ligth:opacity-80 text-slate-400">
                                                        <?= $user['user_email'] ?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80">
                                                <?= $user['user_celphone'] ?>
                                            </p>
                                        </td>
                                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80 text-slate-400">
                                                <?= $user['rol_description'] ?>
                                            </span>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="bg-gradient-to-tl <?= $user['status_name'] == 'Activo' ? "from-emerald-500 to-teal-400":"from-red-500 to-red-400" ?> px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                <?= $user['status_name'] ?>
                                            </span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <a href="<?= base_url("admin/edit_user/{$user['user_id']}") ?>" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
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