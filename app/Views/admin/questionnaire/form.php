<?php
    $data = $questionnaire['questionnaire'] ?? null;
    $is_edit_mode = $data && $data['id'];
?>

<div id="statusMessage" class="hidden p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert"></div>

<div class="flex flex-wrap -mx-3 mb-6 p-4 border rounded-lg bg-gray-50">
    <h3 class="text-lg font-semibold w-full px-3 mb-4 text-gray-800">1. Datos Generales del Cuestionario</h3>
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
            Título <span class="text-red-500">*</span>
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="title" name="title" type="text" placeholder="Ej: Encuesta de Satisfacción" required
            value="<?= $is_edit_mode ? htmlspecialchars($data['title'] ?? '') : '' ?>">
    </div>
    <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
            Descripción
        </label>
        <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="description" name="description" rows="1" placeholder="Breve descripción del cuestionario"><?= $is_edit_mode ? htmlspecialchars($data['description'] ?? '') : '' ?></textarea>
    </div>
</div>

<div class="mt-8 p-4 border rounded-lg bg-white shadow-md">
    <h3 class="text-lg font-semibold w-full mb-4 text-gray-800">2. Preguntas</h3>
    <div id="questionsContainer" class="space-y-6">
        </div>
    
    <button type="button" id="addQuestionBtn" class="mt-6 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded w-full">
        + Agregar Nueva Pregunta
    </button>
</div>

<div class="flex flex-wrap -mx-3 mt-6">
    <div class="w-full px-3">
        <button type="submit" id="saveQuestionnaireBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
            <?= $is_edit_mode ? "Actualizar Cuestionario" : "Guardar Cuestionario Completo" ?>
        </button>
        <a href="javascript:history.back()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2 sm:mt-0 sm:ml-2 w-full sm:w-auto inline-block text-center">
            Cancelar
        </a>
    </div>
</div>

<script>
    const BASE_URL_ROOT = '<?= base_url() ?>';
    window.questionnaireData = <?= json_encode($questionnaire['questionnaire']  ?? null, JSON_UNESCAPED_SLASHES); ?>;
</script>
<script src="<?= base_url('js/questionnaire_builder.js') ?>"></script>