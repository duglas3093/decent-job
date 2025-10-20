<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Editar Cuestionario: <?= esc($questionnaire['title'] ?? 'Cuestionario') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6 class="text-xl">Editar Cuestionario: <?= esc($questionnaire['title'] ?? 'Cargando...') ?></h6>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-6">
                            <form id="questionnaireForm" class="w-full"> 
                                <input type="hidden" id="questionnaireId" value="<?= esc($questionnaire['id'] ?? '') ?>">
                                
                                <?= $this->include('admin/questionnarie/form') ?>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    
<?= $this->endSection() ?>