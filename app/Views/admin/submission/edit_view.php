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
                <div class="flex flex-col sm:flex-row gap-2">
                    <button onclick="printForm('imprimir')" class="inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-800 text-white text-xs font-bold uppercase rounded shadow hover:shadow-md transition-all">
                        <i class="fa-solid fa-print mr-2"></i> Imprimir
                    </button>
                </div>
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border" id="imprimir">
                    
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap items-center justify-between">
                            <h6 class="text-xl">
                                <?= $is_read_only ? 'Visualización' : 'Edición' ?> de Respuestas
                            </h6>
                            
                            <h6 class="text-lg text-gray-700">
                                Cuestionario: <?= $title ?>
                            </h6>
                        </div>
                        <h6 class="text-lg">
                            Beneficiario: <?= "{$beneficiary[0]['beneficiary_names']} {$beneficiary[0]['beneficiary_lastnames']}" ?>
                        </h6>
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
                            </form>
                        </div>
                    </div>
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
            </div>
        </div>
    </div>
</main>
<script>
    const IS_READ_ONLY = <?= json_encode($is_read_only) ?>;
    const SUBMISSION_ID = document.getElementById('submissionId').value;
    const BENEFICIARY_ID = document.getElementById('beneficiaryId').value;

    document.addEventListener('DOMContentLoaded', () => {
        const submissionForm = document.getElementById('submissionForm');
        const submitButton = document.getElementById('submitSubmissionBtn');
        const statusMessage = document.getElementById('statusMessage');

        if (!IS_READ_ONLY && submissionForm && submitButton) {
            
            submissionForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                submitButton.disabled = true;
                submitButton.textContent = 'Guardando Cambios...';
                statusMessage.classList.add('hidden'); 

                const updatedResponses = [];
                document.querySelectorAll('.question-block').forEach(block => {
                    const qId = block.dataset.questionId;
                    const qType = block.dataset.type;
                    let value = null;
                    let optionIds = [];

                    if (qType === 'SINGLE_SELECT') {
                        const selected = block.querySelector(`input[name="q_${qId}"]:checked`);
                        if (selected) {
                            optionIds.push(selected.value);
                        }
                    } else if (qType === 'MULTIPLE_CHOICE') {
                        block.querySelectorAll(`input[name="q_${qId}[]"]:checked`).forEach(checkbox => {
                            optionIds.push(checkbox.value);
                        });
                    } else { 
                        const inputElement = block.querySelector(`input[name="q_${qId}"]`);
                        if (inputElement) { 
                            value = inputElement.value.trim();
                        }
                    }
                    
                    if (optionIds.length > 0) {
                            updatedResponses.push({
                                question_id: qId,
                                option_ids: optionIds 
                            });
                    } else if (value !== null && value !== "") { 
                        updatedResponses.push({
                            question_id: qId,
                            value: value 
                        });
                    }
                });

                const submissionUpdateData = {
                    submission_id: SUBMISSION_ID,
                    responses: updatedResponses    
                };

                try {
                    const apiUrl = `<?= base_url('admin/submission/update') ?>`; 
                    
                    const response = await fetch(apiUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify(submissionUpdateData)
                    });

                    const result = await response.json();

                    if (response.ok) {
                        statusMessage.className = 'p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg';
                        statusMessage.textContent = result.message || '¡Respuestas actualizadas con éxito!';
                        setTimeout(() => {
                            window.location.href = `<?= base_url('admin/view_kardex_beneficiary/') ?>/${BENEFICIARY_ID}`; 
                        }, 1500);

                    } else {
                        statusMessage.className = 'p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg';
                        statusMessage.textContent = 'Error al actualizar: ' + (result.error || 'Error desconocido.');
                    }

                } catch (error) {
                    statusMessage.className = 'p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg';
                    statusMessage.textContent = 'Error de conexión con el servidor.';
                    console.error('Fetch Error:', error);
                } finally {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Guardar Correcciones';
                    statusMessage.classList.remove('hidden');
                }
            });
        }
    });

    function printForm(idDiv) {
        const content = document.getElementById(idDiv).innerHTML;
        const iframe = document.createElement('iframe');
        
        // Estilos para ocultar el iframe en la vista normal
        iframe.style.position = 'fixed';
        iframe.style.right = '0';
        iframe.style.bottom = '0';
        iframe.style.width = '0';
        iframe.style.height = '0';
        iframe.style.border = '0';
        
        document.body.appendChild(iframe);
        
        const doc = iframe.contentWindow.document;
        doc.open();
        doc.write(`
            <html>
                <head>
                    <title>Ficha de Beneficiario</title>
                    <script src="https://cdn.tailwindcss.com"><\/script>
                    
                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
                    
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

                    <style>
                        body { 
                            background: white; 
                            padding: 40px; 
                            font-family: sans-serif; 
                            -webkit-print-color-adjust: exact; 
                            print-color-adjust: exact;
                        }
                        
                        /* Estilos para tablas en impresión */
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f3f4f6; font-weight: bold; text-transform: uppercase; text-align: center; }
                        
                        /* 4. FORZAR TAMAÑO DEL MAPA AL IMPRIMIR */
                        #map-readonly {
                            width: 100% !important;
                            height: 300px !important; /* Altura fija para que no se corte */
                            border: 1px solid #ccc;
                            z-index: 0; /* Asegurar que quede detrás de textos si los hubiera */
                        }
                        
                        /* Ocultar controles de zoom del mapa en el papel */
                        .leaflet-control-container {
                            display: none !important;
                        }
                    </style>
                </head>
                <body>
                    ${content}
                </body>
            </html>
        `);
        doc.close();

        // Esperamos un poco más (800ms) para que las imágenes del mapa se acomoden
        iframe.contentWindow.onload = function() {
            setTimeout(() => {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
                document.body.removeChild(iframe);
            }, 800);
        };
    }
</script>
<?= $this->endSection() ?>