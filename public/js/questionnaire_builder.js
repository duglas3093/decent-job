document.addEventListener('DOMContentLoaded', () => {
        // --- ELEMENTOS DEL DOM ---
        const questionsContainer = document.getElementById('questionsContainer');
        const addQuestionBtn = document.getElementById('addQuestionBtn');
        const questionnaireForm = document.getElementById('questionnaireForm');
        const questionnaireIdInput = document.getElementById('questionnaireId'); // Para modo edición
        const statusMessage = document.getElementById('statusMessage');

        let questionCounter = 0; // Para dar IDs únicos a los elementos

        // --- FUNCIÓN DE UTILIDAD: PLANTILLAS HTML ---

        /**
         * Genera el HTML para una pregunta. Acepta datos para rellenar los campos.
         */
        const getQuestionHtml = (index, questionData = {}) => `
            <div class="question-item p-4 border border-gray-300 rounded-md bg-white shadow-sm" data-question-index="${index}" data-db-id="${questionData.id || ''}">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-semibold text-gray-700">Pregunta #${index + 1}</h4>
                    <button type="button" class="remove-question-btn text-red-500 hover:text-red-700 font-bold text-sm">Eliminar</button>
                </div>
                
                <div class="flex flex-wrap -mx-3 mb-3">
                    <div class="w-full md:w-3/4 px-3 mb-3 md:mb-0">
                        <label class="block text-gray-700 text-sm font-bold mb-1">Enunciado de la Pregunta</label>
                        <input type="text" class="question-text appearance-none block w-full bg-gray-100 text-gray-700 border rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" placeholder="Ej: ¿Qué tan satisfecho está?" value="${questionData.text || ''}">
                    </div>
                    <div class="w-full md:w-1/4 px-3">
                        <label class="block text-gray-700 text-sm font-bold mb-1">Tipo de Respuesta</label>
                        <select class="question-type block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-2 px-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="SINGLE_SELECT" ${questionData.type === 'SINGLE_SELECT' ? 'selected' : ''}>Selección Única</option>
                            <option value="MULTIPLE_CHOICE" ${questionData.type === 'MULTIPLE_CHOICE' ? 'selected' : ''}>Selección Múltiple</option>
                            <option value="TEXT_INPUT" ${questionData.type === 'TEXT_INPUT' ? 'selected' : ''}>Respuesta de Texto</option>
                            <option value="NUMERIC" ${questionData.type === 'NUMERIC' ? 'selected' : ''}>Numérica</option>
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
        const getOptionHtml = (optionData = {}) => `
            <div class="option-item flex items-center space-x-2" data-db-id="${optionData.id || ''}">
                <input type="text" class="option-text appearance-none block w-full bg-gray-50 text-gray-700 border rounded py-1 px-2 text-sm focus:outline-none focus:bg-white focus:border-green-500" placeholder="Ej: Muy satisfecho" value="${optionData.text || ''}" required>
                <button type="button" class="remove-option-btn text-red-400 hover:text-red-600 text-lg leading-none">&times;</button>
            </div>
        `;

        // --- LÓGICA PRINCIPAL ---

        /**
         * Agrega una nueva pregunta al contenedor, opcionalmente con datos existentes.
         */
        const addQuestion = (questionData = {}) => {
            const index = questionCounter;
            const questionHtml = getQuestionHtml(index, questionData);
            questionsContainer.insertAdjacentHTML('beforeend', questionHtml);
            
            const newQuestionEl = questionsContainer.lastElementChild;

            // Si la pregunta tiene opciones, las renderiza.
            if (questionData.options && questionData.options.length > 0) {
                const optionsList = newQuestionEl.querySelector('.options-list');
                questionData.options.forEach(option => {
                    optionsList.insertAdjacentHTML('beforeend', getOptionHtml(option));
                });
            }

            updateOptionsVisibility(newQuestionEl);
            questionCounter++;
        };

        // --- MANEJO DE EVENTOS ---

        // 1. Agregar nueva pregunta
        addQuestionBtn.addEventListener('click', () => {
            addQuestion(); // Llama a la función sin datos para crear una pregunta vacía.
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
            const isEditMode = !!(questionnaireIdInput && questionnaireIdInput.value);
            const questionnaireData = {
                id: isEditMode ? questionnaireIdInput.value : null,
                title: document.getElementById('title').value.trim(),
                description: document.getElementById('description').value.trim(),
                questions: []
            };

            // En questionnaire-builder.js
            let apiUrl;

            if (isEditMode) {
                // Concatenamos el root con la ruta específica
                apiUrl = BASE_URL_ROOT + '/admin/update_questionnarie'; 
            } else {
                apiUrl = BASE_URL_ROOT + '/admin/store_questionnarie';
            }

            const questionItems = questionsContainer.querySelectorAll('.question-item');
            
            questionItems.forEach((item, index) => {
                const type = item.querySelector('.question-type').value;
                const question = {
                    id: item.dataset.dbId || null, // ID de la pregunta para la actualización
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
                            question.options.push({ 
                                id: optionItem.dataset.dbId || null, // ID de la opción para la actualización
                                text: text 
                            });
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
                const response = await fetch(apiUrl, {
                    method: isEditMode ? 'POST' : 'POST', // O 'PUT' si prefieres para actualizaciones
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest', 
                    },
                    body: JSON.stringify(questionnaireData)
                });

                if (response.ok) {
                    const result = await response.json();
                    statusMessage.className = 'p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg';
                    statusMessage.textContent = result.message || '¡Operación completada con éxito!';
                    statusMessage.classList.remove('hidden');
                    
                    if (!isEditMode) {
                        // Limpiar formulario solo en modo creación
                        questionnaireForm.reset();
                        questionsContainer.innerHTML = '';
                        questionCounter = 0;
                        addQuestion(); // Añadir una pregunta inicial
                    }

                    // Redirigir a la lista después de un momento
                    setTimeout(() => {
                        window.location.href = BASE_URL_ROOT + '/admin/questionnaries';
                    }, 2000);

                } else {
                    const result = await response.json();
                    statusMessage.className = 'p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg';
                    statusMessage.textContent = 'Error al guardar: ' + (result.error || 'Verifique la consola para más detalles.');
                    statusMessage.classList.remove('hidden');
                    console.error('API Error:', result);
                }
            } catch (error) {
                console.error('Fetch Error:', error);
                statusMessage.className = 'p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg';
                statusMessage.textContent = 'Error de conexión con el servidor.';
                statusMessage.classList.remove('hidden');
            } finally {
                btn.disabled = false;
                btn.textContent = 'Guardar Cuestionario Completo';
            }
        });

        /**
         * Inicializa el formulario. Comprueba si estamos en modo edición
         * y puebla el formulario si es necesario.
         */
        const initializeForm = () => {
            const questionnaireData = window.questionnaireData; 

            // console.log para ver el estado: DEBE mostrar el array, no undefined.
            console.log("Datos de inicialización:", questionnaireData); 

            // Aquí es donde el formulario rellena los campos de Título y Descripción
            // ¡ESTO ES LO QUE ESTÁ FALTANDO EN TU CÓDIGO JS!
            // Si PHP no los rellenó en el HTML, JS DEBE hacerlo.
            if (questionnaireData && questionnaireData.id) {
                document.getElementById('title').value = questionnaireData.title || '';
                document.getElementById('description').value = questionnaireData.description || '';
            }

            // Lógica para preguntas
            if (questionnaireData && questionnaireData.questions && questionnaireData.questions.length > 0) {
                questionnaireData.questions.forEach(question => addQuestion(question));
            } else {
                // Modo Creación o Edición sin preguntas: agregar una vacía.
                addQuestion(); 
            }
        };

        initializeForm();
    });