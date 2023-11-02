<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Usuarios
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('admin/search/script') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <input type="hidden" id="base_url" value="<?= base_url() ?>">
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
                                <h6 class="ligth:text-white text-xl">Usuarios: <?= count($users) ?></h6>
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
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Usuario
                                        </th>
                                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Celular
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Rol
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
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
                                            <a href="<?= base_url("admin/edit_user/{$user['user_id']}") ?>" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" title="Editar usuario">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a> 
                                            <button onclick="formPassword(<?= $user['user_id'] ?>)" class="inline-block px-2 py-1.5 bg-amber-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-amber-700 hover:shadow-lg focus:bg-amber-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-amber-800 active:shadow-lg transition duration-150 ease-in-out" title="Cambiar contraseña" data-te-toggle="modal"
                                                        data-te-target="#changePassword"
                                                        data-te-ripple-init
                                                        data-te-ripple-color="light">
                                                <i class="fa-solid fa-lock"></i>
                                            </button> 
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

    <div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="changePassword" tabindex="-1" aria-labelledby="titleModal" aria-modal="true" role="dialog">
        <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px]">
            <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none ligth:bg-neutral-600">
            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 ligth:border-opacity-50">
                <h5 class="text-xl font-medium leading-normal text-neutral-800 ligth:text-neutral-200">Cambiar Contraseña</h5>
                <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                </button>
            </div>
            <div class="relative p-4">
                <div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-3/8 px-3 mb-2 md:mb-0">
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area_id">
                                NUEVA CONTRASEÑA<span class="text-red-600 ">*</span>
                            </label>
                            <div class="relative">
                                <input type="password" id="passwordInput" placeholder="Contraseña" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.area_id') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white" value="">
                                <span id="togglePassword" class="absolute top-1/2 transform -translate-y-1/2 right-2 cursor-pointer">
                                    <i class="fas fa-eye text-gray-500"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 ligth:border-opacity-50">
                    <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-0" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light" onclick="changePassword()">
                        Guardar
                    </button>
                    <button type="button" class="inline-block rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    const passwordInput = document.getElementById("passwordInput");
    const passwordInputRepeat = document.getElementById("passwordInputRepeat");

    togglePassword.addEventListener("click", function () {
        passwordInput.type = (passwordInput.type === "password") ? "text" : "password";
    });

    function formPassword(user){
        document.getElementById("user_id").value = "";
        document.getElementById("user_id").value = user;
    }

    function changePassword(){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/change_password`
        let user = document.getElementById('user_id').value;
        let newPassword = document.getElementById('passwordInput').value;
        console.log(newPassword)
        if (newPassword.length > 0 && newPassword != null) {
            $.ajax({
                type: "POST",
                url: controller,
                data: {
                    newPassword:newPassword,
                    user:user
                },
                success: (result)=>{
                    document.getElementById("passwordInput").value = "";
                    document.getElementById("user_id").value = "";
                    alert("Se cambio la contraseña correctamente")
                },
                error: (error)=>{}
            })
        }else{
            alert("La contraseña no puede estar vacia");
        }
    }
</script>
<?= $this->endSection() ?>