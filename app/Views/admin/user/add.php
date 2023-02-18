<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Agregar usuario
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl ligth:bg-slate-850 ligth:shadow-ligth-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white">Agregar un nuevo usuarios</h6>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <div class="p-0 overflow-x-auto ml-4 p-8">
                            <form class="w-full"  action="<?= base_url('admin/store_user') ?>" method="POST" enctype="multipart/form-data">
                                <?= $this->include('admin/user/form') ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>