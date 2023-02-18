<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Usuarios
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl ligth:bg-slate-850 ligth:shadow-ligth-xl rounded-2xl bg-clip-border">
                    <?php if((session('msg'))): ?>
                        <article class="message is-<?= session('msg.type') ?>">
                            <div class="message-body">
                                <?= session('msg.body ') ?>
                            </div>
                        </article>
                    <?php endif ?>
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
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
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500">
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
                                            <p
                                                class="mb-0 text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80">
                                                <?= $user['user_celphone'] ?></p>
                                            <!-- <p
                                                class="mb-0 text-xs leading-tight ligth:text-white ligth:opacity-80 text-slate-400">
                                                <?= $user['rol_description'] ?></p> -->
                                        </td>
                                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80 text-slate-400">
                                                <?= $user['rol_description'] ?>
                                            </span>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="bg-gradient-to-tl from-emerald-500 to-teal-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                <?= $user['status_name'] ?>
                                            </span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <a href="javascript:;"
                                                class="text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80 text-slate-400">
                                                Edit
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