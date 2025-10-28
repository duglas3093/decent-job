<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
<?= $is_read_only ? 'Ver' : 'Editar' ?> Respuestas | <?= esc($submission['title'] ?? 'Cuestionario') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
// Extracción de variables para simplificar el código
$title = esc($submission['title'] ?? 'Cuestionario');
$description = esc($submission['description'] ?? 'Respuestas del beneficiario a la encuesta.');
$beneficiary_id = $submission['user_id'];
$submission_id = $submission['id'];
$questions = $submission['questions'] ?? [];
$read_only_attr = $is_read_only ? 'disabled' : ''; // Atributo para deshabilitar campos
$button_text = $is_read_only ? 'Respuestas en Modo Lectura' : 'Guardar Correcciones';
?>

<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-2 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap items-center justify-between">
                            <h6 class="text-xl">
                                <?= $is_read_only ? 'Visualización' : 'Edición' ?> de Respuestas
                            </h6>
                            <h6 class="text-lg text-gray-700">
                                Cuestionario: **<?= $title ?>**
                            </h6>
                        </div>
                        <p class="text-sm text-gray-500 mt-1">
                            Enviado el: <?= date('d-m-Y H:i', strtotime($submission['submitted_at'])) ?>
                        </p>
                    </div>
                    
                    <div class="flex-auto px-0 pt-0 pb-2 mt-4">
                        <div class="p-6">
                            
                            <form id="submissionForm" class="w-full">
                                <input type="hidden" id="beneficiaryId" value="<?= esc($beneficiary_id) ?>">
                                <input type="hidden" id="submissionId" value="<?= esc($submission_id) ?>">

                                <div id="statusMessage" class="hidden p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert"></div>

                                <div class="mb-8 p-4 border rounded-lg shadow-sm bg-gray-50">
                                    <h4 class="text-lg font-bold mb-3">Detalles del Cuestionario</h4>
                                    <p class="text-gray-700"><?= $description ?></p>
                                </div>
                                
                                <div id="dynamicQuestionsContainer" class="space-y-8">
                                    <?php if (!empty($questions)): ?>
                                        <?php foreach ($questions as $q): 
                                            $q_id = $q['id'];
                                            $q_type = $q['type'];
                                            $q_text = esc($q['text']);
                                            $q_order = $q['order'];
                                            $user_val = $q['user_responses']['text_value']; // Valor para texto/número
                                            $q_required = 'required';
                                        ?>
                                            <div class="question-block p-4 border rounded-lg shadow-lg bg-white" data-question-id="<?= $q_id ?>" data-type="<?= $q_type ?>">
                                                <label class="block text-gray-800 text-base font-bold mb-3">
                                                    <?= $q_order ?>. <?= $q_text ?>
                                                </label>

                                                <div class="answer-area pl-4 pt-2">
                                                    <?php if ($q_type === 'TEXT_INPUT' || $q_type === 'NUMERIC'): ?>
                                                        <input type="<?= $q_type === 'NUMERIC' ? 'number' : 'text' ?>" 
                                                            name="q_<?= $q_id ?>" 
                                                            class="w-full md:w-1/2 p-2 border rounded focus:ring-blue-500 focus:border-blue-500 bg-gray-100"
                                                            value="<?= esc($user_val) ?>"
                                                            <?= $read_only_attr ?> <?= $q_required ?>>

                                                    <?php elseif ($q_type === 'SINGLE_SELECT' || $q_type === 'MULTIPLE_CHOICE'): ?>
                                                        <?php 
                                                        $input_type = $q_type === 'SINGLE_SELECT' ? 'radio' : 'checkbox';
                                                        $name_attr = $q_type === 'SINGLE_SELECT' ? "q_{$q_id}" : "q_{$q_id}[]";
                                                        
                                                        foreach ($q['options'] as $o):
                                                            // Determinar si esta opción fue marcada en la respuesta guardada
                                                            $is_checked = $o['is_selected'] ? 'checked' : '';
                                                        ?>
                                                            <div class="flex items-center mb-2">
                                                                <input type="<?= $input_type ?>" 
                                                                    id="option_<?= $o['id'] ?>" 
                                                                    name="<?= $name_attr ?>" 
                                                                    value="<?= $o['id'] ?>" 
                                                                    class="form-<?= $input_type ?> h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                                    <?= $is_checked ?>
                                                                    <?= $read_only_attr ?>
                                                                    <?= $input_type === 'radio' ? $q_required : '' ?>>
                                                                <label for="option_<?= $o['id'] ?>" class="ml-2 text-gray-700 <?= $is_checked ? 'font-semibold text-blue-700' : '' ?>"><?= esc($o['text']) ?></label>
                                                            </div>
                                                        <?php endforeach; ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="flex justify-end mt-8 border-t pt-4">
                                    <?php if (!$is_read_only): ?>
                                        <button type="submit" id="submitSubmissionBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-150 ease-in-out">
                                            <?= $button_text ?>
                                        </button>
                                    <?php else: ?>
                                        <span class="text-lg font-bold text-green-700"><?= $button_text ?></span>
                                    <?php endif; ?>
                                    
                                    <a href="javascript:history.back()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg ml-3 transition duration-150 ease-in-out">
                                        Volver
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>