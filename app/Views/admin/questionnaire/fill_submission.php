<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Nuevo Seguimiento: <?= esc($questionnaire['title'] ?? 'Cuestionario') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <input id="BASE_URL_ROOT" type="hidden" value="<?= base_url() ?>">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6 class="text-xl">
                            Nuevo Seguimiento para: <?= esc($questionnaire['title'] ?? 'Cuestionario') ?>
                            <span class="text-gray-500 text-sm block">Beneficiario ID: <?= esc($beneficiary_id) ?></span>
                        </h6>
                    </div>
                    
                    <div class="flex-auto px-0 pt-0 pb-2 mt-4">
                        <div class="p-6">
                            <form id="submissionForm" class="w-full">
                                <input type="hidden" id="beneficiaryId" value="<?= esc($beneficiary_id) ?>">
                                <input type="hidden" id="questionnaireId" value="<?= esc($questionnaire['id'] ?? '') ?>">
                                
                                <div id="statusMessage" class="hidden p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert"></div>

                                <div class="mb-8 p-4 border-b">
                                    <h4 class="text-lg font-semibold text-gray-800">1. Instrucciones</h4>
                                    <p class="text-gray-600 mt-2"><?= esc($questionnaire['description'] ?? 'Por favor, responda a todas las preguntas con precisión.') ?></p>
                                </div>

                                <div id="dynamicQuestionsContainer" class="space-y-8">
                                    <?php if (!empty($questionnaire['questions'])): ?>
                                        <?php foreach ($questionnaire['questions'] as $q): 
                                            // Normalizar las variables para simplificar el HTML
                                            $q_id = $q['id'];
                                            $q_type = $q['type'];
                                            $q_text = esc($q['text']);
                                            $q_order = $q['order'];
                                            $q_required = 'required'; // Todas las preguntas son obligatorias por defecto
                                        ?>
                                            <div class="question-block p-4 border rounded-lg shadow-sm bg-gray-50" data-question-id="<?= $q_id ?>" data-type="<?= $q_type ?>">
                                                <label class="block text-gray-700 text-base font-bold mb-3">
                                                    <?= $q_order ?>. <?= $q_text ?>
                                                </label>

                                                <div class="answer-area pl-4 pt-2">
                                                    <?php if ($q_type === 'TEXT_INPUT' || $q_type === 'NUMERIC'): ?>
                                                        <input type="<?= $q_type === 'NUMERIC' ? 'number' : 'text' ?>" 
                                                            name="q_<?= $q_id ?>" 
                                                            class="w-full md:w-1/2 p-2 border rounded focus:ring-blue-500 focus:border-blue-500"
                                                            placeholder="<?= $q_type === 'NUMERIC' ? 'Ingrese un número' : 'Escriba su respuesta aquí' ?>"
                                                            <?= $q_required ?>>

                                                    <?php elseif ($q_type === 'SINGLE_SELECT'): ?>
                                                        <?php foreach ($q['options'] as $o): ?>
                                                            <div class="flex items-center mb-2">
                                                                <input type="radio" 
                                                                    id="option_<?= $o['id'] ?>" 
                                                                    name="q_<?= $q_id ?>" 
                                                                    value="<?= $o['id'] ?>" 
                                                                    class="form-radio h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                                    <?= $q_required ?>>
                                                                <label for="option_<?= $o['id'] ?>" class="ml-2 text-gray-700"><?= esc($o['text']) ?></label>
                                                            </div>
                                                        <?php endforeach; ?>

                                                    <?php elseif ($q_type === 'MULTIPLE_CHOICE'): ?>
                                                        <?php foreach ($q['options'] as $o): ?>
                                                            <div class="flex items-center mb-2">
                                                                <input type="checkbox" 
                                                                    id="option_<?= $o['id'] ?>" 
                                                                    name="q_<?= $q_id ?>[]" 
                                                                    value="<?= $o['id'] ?>" 
                                                                    class="form-checkbox h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                                                <label for="option_<?= $o['id'] ?>" class="ml-2 text-gray-700"><?= esc($o['text']) ?></label>
                                                            </div>
                                                        <?php endforeach; ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p class="text-red-500">Este cuestionario no tiene preguntas.</p>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="flex justify-end mt-8 border-t pt-4">
                                    <button type="submit" id="submitSubmissionBtn" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg transition duration-150 ease-in-out">
                                        Enviar Respuestas
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?= base_url('js/submission.js') ?>"></script>
<?= $this->endSection() ?>