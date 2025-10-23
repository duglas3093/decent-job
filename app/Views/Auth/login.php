<?= $this->extend('users/layout/main') ?>
<?= $this->section('title')?>
Login
<?= $this->endSection()?>

<?= $this->section('content') ?>
<section class="h-screen w-full flex items-center justify-center absolute top-0 left-0">
    <div class="container px-6 py-12 h-full">
        <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
            <div class="md:w-8/12 lg:w-6/12 mb-12 md:mb-0">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                    class="w-full" alt="Phone image" />
            </div>
            <div class="md:w-8/12 lg:w-5/12 lg:ml-20">
                <?php if((session('msg'))){ ?>
                    <div class="bg-<?= session('msg.type') ?>-100 border border-<?= session('msg.type') ?>-400 text-<?= session('msg.type') ?>-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <span class="block sm:inline"><?= session('msg.body ') ?></span>
                    </div>
                <?php } ?>
                <form action="<?= base_url(route_to('signin')) ?>" method="POST">
                    <div class="mb-6">
                        <input 
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            type="email" name="user_email" placeholder="Email" value="<?= old('user_email') ?>"/>
                        <p class="text-red-600 text-xs"><?= session('errors.user_email') ?></p> 
                    </div>
                    <div class="mb-6">
                        <input type="password"
                            class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                            name="user_password" placeholder="Contraseña"/>
                        <p class="text-red-600 text-xs"><?= session('errors.user_password') ?></p>
                    </div>
                    <input type="submit"
                        class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out w-full"
                        data-mdb-ripple="true" data-mdb-ripple-color="light"
                        value="Iniciar Sesión"
                    />
                </form>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>