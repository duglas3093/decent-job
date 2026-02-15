<?= $this->extend('admin/layout/main') ?>
<?= $this->section('title') ?>Editar Beneficiario<?= $this->endSection() ?>

<?= $this->section('content') ?>

<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">
        
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6 class="text-xl font-bold text-slate-700 uppercase">
                            <i class="fa-solid fa-user-pen mr-2 text-blue-500"></i> Editar Beneficiario
                        </h6>
                        <p class="text-sm text-slate-500 mb-4">Actualizando información de: <span class="font-bold text-blue-600"><?= esc($beneficiary['beneficiary_names']) ?> <?= esc($beneficiary['beneficiary_lastnames']) ?></span></p>
                    </div>

                    <div class="flex-auto px-0 pt-0 pb-2">
                        <form class="w-full p-6" action="<?= base_url('admin/update_beneficiary') ?>" method="POST">
                            
                            <input type="hidden" name="beneficiary_id" value="<?= $beneficiary['beneficiary_id'] ?>">

                            <div class="mb-8 border-b border-gray-100 pb-6">
                                <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">1. Información del Proyecto</h6>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    <div>
                                        <label class="label-std">Proyecto</label>
                                        <div class="relative">
                                            <select class="input-std" name="financier_id" required>
                                                <?php foreach($financiers as $financier): ?>
                                                    <option value="<?= $financier['financier_id'] ?>" 
                                                        <?= $beneficiary['financier_id'] == $financier['financier_id'] ? 'selected' : '' ?>>
                                                        <?= esc($financier['financier_project']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="label-std">Gestión (Año)</label>
                                        <input class="input-std" name="beneficiary_financier_year" type="number" 
                                               value="<?= esc($beneficiary['beneficiary_financier_year']) ?>" required>
                                    </div>
                                    <div>
                                        <label class="label-std">Estado Actual</label>
                                        <select class="input-std" name="status_id">
                                            <option value="1" <?= $beneficiary['status_id'] == 1 ? 'selected' : '' ?>>Activo</option>
                                            <option value="2" <?= $beneficiary['status_id'] == 2 ? 'selected' : '' ?>>Inactivo</option>
                                            <option value="9" <?= $beneficiary['status_id'] == 9 ? 'selected' : '' ?>>Pendiente</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8 border-b border-gray-100 pb-6">
                                <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">2. Datos Personales</h6>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                    
                                    <div>
                                        <label class="label-std">Nombres</label>
                                        <input class="input-std" name="beneficiary_names" type="text" value="<?= esc($beneficiary['beneficiary_names']) ?>" required>
                                    </div>
                                    <div>
                                        <label class="label-std">Apellidos</label>
                                        <input class="input-std" name="beneficiary_lastnames" type="text" value="<?= esc($beneficiary['beneficiary_lastnames']) ?>" required>
                                    </div>
                                    
                                    <?php 
                                        $munis = ['Cochabamba', 'Sacaba', 'Quillacollo', 'Tiquipaya', 'Colcapirua'];
                                        $savedMuni = $beneficiary['beneficiary_municipality'];
                                        $isCustomMuni = !in_array($savedMuni, $munis) && !empty($savedMuni);
                                    ?>
                                    <div>
                                        <label class="label-std">Municipio</label>
                                        
                                        <div id="wrapper_select_municipality" class="relative <?= $isCustomMuni ? 'hidden' : '' ?>">
                                            <select class="input-std" id="municipality" 
                                                    name="<?= $isCustomMuni ? '' : 'beneficiary_municipality' ?>" 
                                                    <?= $isCustomMuni ? '' : 'required' ?>
                                                    onchange="transformToInput(this, 'wrapper_select_municipality', 'wrapper_input_municipality', 'input_municipality_custom')">
                                                <option value="" disabled>Seleccione...</option>
                                                <?php foreach($munis as $muni): ?>
                                                    <option value="<?= $muni ?>" <?= $savedMuni == $muni ? 'selected' : '' ?>><?= $muni ?></option>
                                                <?php endforeach; ?>
                                                <option value="Otro" <?= $isCustomMuni ? 'selected' : '' ?>>Otro (Escribir...)</option>
                                            </select>
                                        </div>

                                        <div id="wrapper_input_municipality" class="flex items-center gap-2 <?= $isCustomMuni ? '' : 'hidden' ?>">
                                            <input type="text" id="input_municipality_custom" 
                                                   class="input-std" 
                                                   name="<?= $isCustomMuni ? 'beneficiary_municipality' : '' ?>" 
                                                   value="<?= $isCustomMuni ? esc($savedMuni) : '' ?>"
                                                   <?= $isCustomMuni ? 'required' : '' ?>
                                                   placeholder="Especifique municipio...">
                                            
                                            <button type="button" onclick="revertToSelect('municipality', 'wrapper_select_municipality', 'wrapper_input_municipality', 'input_municipality_custom')" 
                                                    class="p-2 bg-red-100 text-red-500 rounded-lg hover:bg-red-200 transition">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="label-std">CI</label>
                                        <div class="flex gap-2">
                                            <input class="input-std w-2/3" name="beneficiary_ci" type="number" value="<?= esc($beneficiary['beneficiary_ci']) ?>" required>
                                            <select class="input-std w-1/3" name="beneficiary_ci_extension" required>
                                                <?php 
                                                    $exts = ['CB', 'LP', 'SC', 'OR', 'PT', 'TJ', 'CH', 'BE', 'PD'];
                                                    foreach($exts as $ext): 
                                                ?>
                                                    <option value="<?= $ext ?>" <?= $beneficiary['beneficiary_ci_extension'] == $ext ? 'selected' : '' ?>><?= $ext ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="label-std">Fecha Nacimiento</label>
                                        <input class="input-std" name="beneficiary_birthdate" type="date" value="<?= esc($beneficiary['beneficiary_birthdate']) ?>" required>
                                    </div>
                                    <div>
                                        <label class="label-std">Celular</label>
                                        <input class="input-std" name="beneficiary_cellphone" type="number" value="<?= esc($beneficiary['beneficiary_cellphone']) ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-8 border-b border-gray-100 pb-6">
                                <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">3. Datos del Negocio</h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    
                                    <?php 
                                        $types = ['Gastronomico', 'Textil', 'Servicios', 'Artesano'];
                                        $savedType = $beneficiary['beneficiary_entrepreneurship_type'];
                                        $isCustomType = !in_array($savedType, $types) && !empty($savedType);
                                    ?>
                                    <div>
                                        <label class="label-std">Rubro / Tipo</label>
                                        <div id="wrapper_select_type" class="relative <?= $isCustomType ? 'hidden' : '' ?>">
                                            <select class="input-std" id="entrepreneurship_type"
                                                    name="<?= $isCustomType ? '' : 'beneficiary_entrepreneurship_type' ?>" 
                                                    <?= $isCustomType ? '' : 'required' ?>
                                                    onchange="transformToInput(this, 'wrapper_select_type', 'wrapper_input_type', 'input_type_custom')">
                                                <option value="" disabled>Seleccione...</option>
                                                <?php foreach($types as $t): ?>
                                                    <option value="<?= $t ?>" <?= $savedType == $t ? 'selected' : '' ?>><?= $t ?></option>
                                                <?php endforeach; ?>
                                                <option value="Otro" <?= $isCustomType ? 'selected' : '' ?>>Otro (Escribir...)</option>
                                            </select>
                                        </div>
                                        <div id="wrapper_input_type" class="flex items-center gap-2 <?= $isCustomType ? '' : 'hidden' ?>">
                                            <input type="text" id="input_type_custom" class="input-std" 
                                                   name="<?= $isCustomType ? 'beneficiary_entrepreneurship_type' : '' ?>" 
                                                   value="<?= $isCustomType ? esc($savedType) : '' ?>" placeholder="Especifique...">
                                            <button type="button" onclick="revertToSelect('entrepreneurship_type', 'wrapper_select_type', 'wrapper_input_type', 'input_type_custom')" class="p-2 bg-red-100 text-red-500 rounded-lg hover:bg-red-200 transition"><i class="fa-solid fa-xmark"></i></button>
                                        </div>
                                    </div>

                                    <?php 
                                        $channels = ['Tienda fisica', 'Venta ambulante', 'Venta por internet'];
                                        $savedChannel = $beneficiary['beneficiary_sales_channel'];
                                        $isCustomChannel = !in_array($savedChannel, $channels) && !empty($savedChannel);
                                    ?>
                                    <div>
                                        <label class="label-std">Canal de Venta</label>
                                        <div id="wrapper_select_channel" class="relative <?= $isCustomChannel ? 'hidden' : '' ?>">
                                            <select class="input-std" id="sales_channel"
                                                    name="<?= $isCustomChannel ? '' : 'beneficiary_sales_channel' ?>" 
                                                    <?= $isCustomChannel ? '' : 'required' ?>
                                                    onchange="transformToInput(this, 'wrapper_select_channel', 'wrapper_input_channel', 'input_channel_custom')">
                                                <option value="" disabled>Seleccione...</option>
                                                <?php foreach($channels as $c): ?>
                                                    <option value="<?= $c ?>" <?= $savedChannel == $c ? 'selected' : '' ?>><?= $c ?></option>
                                                <?php endforeach; ?>
                                                <option value="Otro" <?= $isCustomChannel ? 'selected' : '' ?>>Otro (Escribir...)</option>
                                            </select>
                                        </div>
                                        <div id="wrapper_input_channel" class="flex items-center gap-2 <?= $isCustomChannel ? '' : 'hidden' ?>">
                                            <input type="text" id="input_channel_custom" class="input-std" 
                                                   name="<?= $isCustomChannel ? 'beneficiary_sales_channel' : '' ?>" 
                                                   value="<?= $isCustomChannel ? esc($savedChannel) : '' ?>" placeholder="Especifique...">
                                            <button type="button" onclick="revertToSelect('sales_channel', 'wrapper_select_channel', 'wrapper_input_channel', 'input_channel_custom')" class="p-2 bg-red-100 text-red-500 rounded-lg hover:bg-red-200 transition"><i class="fa-solid fa-xmark"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label class="label-std">Descripción del Negocio</label>
                                        <textarea class="input-std" name="beneficiary_entrepreneurship_description" rows="2"><?= esc($beneficiary['beneficiary_entrepreneurship_description']) ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">4. Capacitación</h6>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="label-std">¿Pasaste cursos?</label>
                                        <select class="input-std" id="has_course" name="beneficiary_has_course" 
                                                onchange="toggleSection('has_course', 'course_detail_container', 'course_name')">
                                            <option value="No" <?= $beneficiary['beneficiary_has_course'] == 'No' ? 'selected' : '' ?>>No</option>
                                            <option value="Si" <?= $beneficiary['beneficiary_has_course'] == 'Si' ? 'selected' : '' ?>>Sí</option>
                                        </select>
                                    </div>
                                    <div id="course_detail_container" class="<?= $beneficiary['beneficiary_has_course'] == 'Si' ? '' : 'hidden' ?>">
                                        <label class="label-std">Nombre del curso</label>
                                        <input class="input-std" id="course_name" name="beneficiary_course_name" type="text" 
                                               value="<?= esc($beneficiary['beneficiary_course_name']) ?>"
                                               <?= $beneficiary['beneficiary_has_course'] == 'Si' ? 'required' : '' ?>>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end pt-6 border-t border-gray-100 mt-6 gap-3">
                                <a href="<?= base_url('admin/beneficiaries') ?>" class="px-6 py-2.5 bg-slate-200 text-slate-700 font-bold rounded-lg hover:bg-slate-300 transition">Cancelar</a>
                                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 shadow-md transition transform hover:-translate-y-0.5">
                                    Actualizar Datos
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .label-std { display: block; font-size: 0.75rem; font-weight: 700; color: #4b5563; text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em; }
    .input-std { display: block; width: 100%; padding: 0.625rem; font-size: 0.875rem; color: #1f2937; background-color: #f9fafb; border: 1px solid #d1d5db; border-radius: 0.5rem; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; }
    .input-std:focus { outline: none; border-color: #3b82f6; background-color: #fff; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
</style>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    // 1. FUNCIONES PARA EL SELECT <-> INPUT
    function transformToInput(selectElement, selectWrapperId, inputWrapperId, inputId) {
        if (selectElement.value === 'Otro') {
            const selectWrapper = document.getElementById(selectWrapperId);
            const inputWrapper = document.getElementById(inputWrapperId);
            const textInput = document.getElementById(inputId);
            
            const fieldName = selectElement.getAttribute('name');
            selectElement.setAttribute('data-original-name', fieldName);

            selectElement.removeAttribute('name');
            selectElement.removeAttribute('required');
            
            textInput.setAttribute('name', fieldName);
            textInput.setAttribute('required', 'required');
            textInput.focus();

            selectWrapper.classList.add('hidden');
            inputWrapper.classList.remove('hidden');
        }
    }

    function revertToSelect(selectId, selectWrapperId, inputWrapperId, inputId) {
        const selectElement = document.getElementById(selectId);
        const selectWrapper = document.getElementById(selectWrapperId);
        const inputWrapper = document.getElementById(inputWrapperId);
        const textInput = document.getElementById(inputId);

        const fieldName = selectElement.getAttribute('data-original-name') || textInput.getAttribute('name');

        textInput.removeAttribute('name');
        textInput.removeAttribute('required');
        textInput.value = '';

        selectElement.setAttribute('name', fieldName);
        selectElement.setAttribute('required', 'required');
        selectElement.value = ""; 

        inputWrapper.classList.add('hidden');
        selectWrapper.classList.remove('hidden');
    }

    function toggleSection(selectId, containerId, requiredInputId = null) {
        const select = document.getElementById(selectId);
        const container = document.getElementById(containerId);
        
        if (select.value === 'Si') {
            container.classList.remove('hidden');
            if (requiredInputId) {
                const input = document.getElementById(requiredInputId);
                if(input) input.setAttribute('required', 'required');
            }
        } else {
            container.classList.add('hidden');
            if (requiredInputId) {
                const input = document.getElementById(requiredInputId);
                if(input) input.removeAttribute('required');
            }
        }
    }
</script>
<?= $this->endSection() ?>