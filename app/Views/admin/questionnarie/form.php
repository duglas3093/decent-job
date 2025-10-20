<div id="statusMessage" class="hidden p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert"></div>

<div class="flex flex-wrap -mx-3 mb-6 p-4 border rounded-lg bg-gray-50">
    <h3 class="text-lg font-semibold w-full px-3 mb-4 text-gray-800">1. Datos Generales del Cuestionario</h3>
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="title">
            Título <span class="text-red-500">*</span>
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="title" name="title" type="text" placeholder="Ej: Encuesta de Satisfacción" required>
    </div>
    <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
            Descripción
        </label>
        <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="description" name="description" rows="1" placeholder="Breve descripción del cuestionario"></textarea>
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
            Guardar Cuestionario Completo
        </button>
        <a href="javascript:history.back()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2 sm:mt-0 sm:ml-2 w-full sm:w-auto inline-block text-center">
            Cancelar
        </a>
    </div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', () => {
        const questionsContainer = document.getElementById('questionsContainer');
        const addQuestionBtn = document.getElementById('addQuestionBtn');
        const questionnaireForm = document.getElementById('questionnaireForm');
        let questionCounter = 0; // Para dar IDs únicos a los elementos

        // --- FUNCIÓN DE UTILIDAD: PLANTILLAS HTML ---

        /**
         * Genera el HTML para una nueva pregunta.
         */
        const getQuestionHtml = (index) => `
            <div class="question-item p-4 border border-gray-300 rounded-md bg-white shadow-sm" data-question-id="${index}">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-semibold text-gray-700">Pregunta #${index}</h4>
                    <button type="button" class="remove-question-btn text-red-500 hover:text-red-700 font-bold text-sm">Eliminar</button>
                </div>
                
                <div class="flex flex-wrap -mx-3 mb-3">
                    <div class="w-full md:w-3/4 px-3 mb-3 md:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-1">Enunciado de la Pregunta</label>
                        <input type="text" class="question-text appearance-none block w-full bg-gray-100 text-gray-700 border rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" placeholder="Ej: ¿Qué tan satisfecho está?">
                    </div>
                    <div class="w-full md:w-1/4 px-3">
                        <label class="block text-gray-700 text-sm font-bold mb-1">Tipo de Respuesta</label>
                        <select class="question-type block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="SINGLE_SELECT">Selección Única</option>
                            <option value="MULTIPLE_CHOICE">Selección Múltiple</option>
                            <option value="TEXT_INPUT">Respuesta de Texto</option>
                            <option value="NUMERIC">Numérica</option>
                        </select>
                    </div>
                </div>

                <div class="options-container mt-4 border-t pt-3 space-y-2">
                    <h5 class="text-sm font-semibold text-gray-600">Opciones:</h5>
                    <div class="options-list space-y-2">
                        </div>
                    <button type="button" class="add-option-btn text-blue-500 hover:text-blue-700 text-sm font-bold mt-2">+ Agregar Opción</button>
                </div>
            </div>
        `;

        /**
         * Genera el HTML para una opción de respuesta.
         */
        const getOptionHtml = () => `
            <div class="option-item flex items-center space-x-2">
                <input type="text" class="option-text appearance-none block w-full bg-gray-50 text-gray-700 border rounded py-1 px-2 text-sm focus:outline-none focus:bg-white focus:border-green-500" placeholder="Ej: Muy satisfecho" required>
                <button type="button" class="remove-option-btn text-red-400 hover:text-red-600 text-lg leading-none">&times;</button>
            </div>
        `;

        // --- MANEJO DE EVENTOS ---

        // 1. Agregar nueva pregunta
        addQuestionBtn.addEventListener('click', () => {
            questionCounter++;
            const questionHtml = getQuestionHtml(questionCounter);
            questionsContainer.insertAdjacentHTML('beforeend', questionHtml);
            
            // Inicializar el nuevo elemento
            const newQuestion = questionsContainer.lastElementChild;
            updateOptionsVisibility(newQuestion);
        });

        // 2. Delegación de eventos para preguntas y opciones
        questionsContainer.addEventListener('click', (e) => {
            const questionItem = e.target.closest('.question-item');
            if (!questionItem) return;

            // Eliminar Pregunta
            if (e.target.classList.contains('remove-question-btn')) {
                questionItem.remove();
            }

            // Agregar Opción
            else if (e.target.classList.contains('add-option-btn')) {
                const optionsList = questionItem.querySelector('.options-list');
                optionsList.insertAdjacentHTML('beforeend', getOptionHtml());
            }
            
            // Eliminar Opción
            else if (e.target.classList.contains('remove-option-btn')) {
                e.target.closest('.option-item').remove();
            }
        });

        // 3. Control de visibilidad de opciones basado en el tipo de respuesta
        questionsContainer.addEventListener('change', (e) => {
            if (e.target.classList.contains('question-type')) {
                const questionItem = e.target.closest('.question-item');
                updateOptionsVisibility(questionItem);
            }
        });

        /** Actualiza la visibilidad del contenedor de opciones. */
        const updateOptionsVisibility = (questionItem) => {
            const typeSelect = questionItem.querySelector('.question-type');
            const optionsContainer = questionItem.querySelector('.options-container');
            
            const type = typeSelect.value;
            const needsOptions = ['SINGLE_SELECT', 'MULTIPLE_CHOICE'].includes(type);
            
            optionsContainer.style.display = needsOptions ? 'block' : 'none';
            
            // Remover el atributo required si no necesita opciones (para que pase la validación del navegador)
            const optionInputs = optionsContainer.querySelectorAll('.option-text');
            optionInputs.forEach(input => {
                if (!needsOptions) {
                    input.removeAttribute('required');
                } else {
                    input.setAttribute('required', 'required');
                }
            });
        }

        // --- FUNCIÓN DE ENVÍO Y CONSTRUCCIÓN DEL OBJETO JSON ---

        questionnaireForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const btn = document.getElementById('saveQuestionnaireBtn');
            btn.disabled = true;
            btn.textContent = 'Guardando...';

            // 1. Construir el Objeto de Datos
            const questionnaireData = {
                title: document.getElementById('title').value.trim(),
                description: document.getElementById('description').value.trim(),
                questions: []
            };

            const questionItems = questionsContainer.querySelectorAll('.question-item');
            
            questionItems.forEach((item, index) => {
                const type = item.querySelector('.question-type').value;
                const question = {
                    text: item.querySelector('.question-text').value.trim(),
                    type: type,
                    order: index + 1, // Asegura un orden consecutivo
                    options: []
                };

                // Recopilar opciones solo si el tipo lo requiere
                if (['SINGLE_SELECT', 'MULTIPLE_CHOICE'].includes(type)) {
                    item.querySelectorAll('.option-item').forEach(optionItem => {
                        const text = optionItem.querySelector('.option-text').value.trim();
                        if (text) { // Solo si tiene texto
                            question.options.push({ text: text });
                        }
                    });
                }
                
                questionnaireData.questions.push(question);
            });

            // 2. Validaciones finales
            if (!questionnaireData.title) {
                alert('Por favor, ingrese un título para el cuestionario.');
                btn.disabled = false;
                btn.textContent = 'Guardar Cuestionario Completo';
                return;
            }
            if (questionnaireData.questions.length === 0) {
                alert('Debe agregar al menos una pregunta.');
                btn.disabled = false;
                btn.textContent = 'Guardar Cuestionario Completo';
                return;
            }

            // 3. Enviar a la API del Backend (CodeIgniter 4)
            try {
                const response = await fetch('<?= base_url('admin/store_questionnarie') ?>', { // Ajusta esta ruta a tu Controller
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        // Incluir token CSRF si está activo en CI4 (CI4 lo maneja si no es AJAX, pero si lo usas en AJAX, debe ir aquí)
                        // 'X-Requested-With': 'XMLHttpRequest', 
                        // 'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(questionnaireData)
                });

                const result = await response.json();
                const statusMessage = document.getElementById('statusMessage');

                if (response.ok) {
                    statusMessage.className = 'p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg';
                    statusMessage.textContent = '¡Cuestionario guardado con éxito! ID: ' + result.id;
                    statusMessage.classList.remove('hidden');
                    
                    // Opcional: Limpiar el formulario o redirigir
                    questionnaireForm.reset();
                    questionsContainer.innerHTML = '';
                    questionCounter = 0;

                } else {
                    statusMessage.className = 'p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg';
                    statusMessage.textContent = 'Error al guardar: ' + (result.error || 'Verifique la consola para más detalles.');
                    statusMessage.classList.remove('hidden');
                    console.error('API Error:', result);
                }
            } catch (error) {
                console.error('Fetch Error:', error);
                const statusMessage = document.getElementById('statusMessage');
                statusMessage.className = 'p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg';
                statusMessage.textContent = 'Error de conexión con el servidor.';
                statusMessage.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btn.textContent = 'Guardar Cuestionario Completo';
            }
        });

        // Iniciar con al menos una pregunta
        addQuestionBtn.click();
    });
    </script>