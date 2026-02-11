<?= $this->extend('users/layout/main') ?>

<?= $this->section('title') ?>
Diagnóstico Emprendedor
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border md:mr-20 md:ml-20 md:mt-5">
    
    <div class="p-6 pb-4 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <div class="text-center md:text-left">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                Diagnóstico Emprendedor
            </h2>
            <p class="text-gray-600 mt-2 text-sm">
                Por favor complete la información del proyecto y los datos del beneficiario.
            </p>
        </div>
    </div>

    <div class="flex-auto px-4 pt-0 pb-2">
        <form class="w-full p-4" action="<?= base_url('store_postulant') ?>" method="POST">
            
            <div class="mb-8 border-b border-gray-200 pb-6">
                <h6 class="text-indigo-600 text-sm font-bold uppercase mb-4 tracking-wide">
                    1. Datos del Proyecto
                </h6>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="financier_id">
                            Nombre del proyecto <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition-colors"
                                    id="financier_id" name="financier_id" required>
                                <?php if(!empty($financiers)): ?>
                                    <?php foreach($financiers as $financier): ?>
                                        <option value="<?= $financier['financier_id'] ?>" <?= old('financier_id') == $financier['financier_id'] ? 'selected' : '' ?>>
                                            <?= esc($financier['financier_project']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_financier_year">
                            Año del proyecto <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition-colors"
                            id="beneficiary_financier_year" name="beneficiary_financier_year" type="number" 
                            placeholder="Ej: 2022" min="1900" max="2099"
                            value="<?= old('beneficiary_financier_year') ?>" required>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h6 class="text-indigo-600 text-sm font-bold uppercase mb-4 tracking-wide">
                    2. Datos del Beneficiario
                </h6>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                    
                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="names">
                            Nombres <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="names" name="beneficiary_names" type="text" placeholder="Ingrese nombres" value="<?= old('names') ?>" required>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="lastnames">
                            Apellidos <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="lastnames" name="beneficiary_lastnames" type="text" placeholder="Ingrese apellidos" value="<?= old('lastnames') ?>" required>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="birthdate">
                            Fecha de nacimiento <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="birthdate" name="beneficiary_birthdate" type="date" value="<?= old('birthdate') ?>" required>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ci">
                            Documento de Identidad (CI) <span class="text-red-500">*</span>
                        </label>
                        <div class="flex gap-2">
                            <div class="w-3/4">
                                <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                    id="  ci" name="beneficiary_ci" type="number" placeholder="Ej: 5293848" 
                                    value="<?= old('ci') ?>" required>
                            </div>
                            
                            <div class="w-1/4 relative">
                                <select class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                        id="  ci_extension" name="beneficiary_ci_extension" required>
                                    <option value="CB" <?= old('ci_extension') == 'CB' ? 'selected' : '' ?>>CB</option>
                                    <option value="LP" <?= old('ci_extension') == 'LP' ? 'selected' : '' ?>>LP</option>
                                    <option value="SC" <?= old('ci_extension') == 'SC' ? 'selected' : '' ?>>SC</option>
                                    <option value="OR" <?= old('ci_extension') == 'OR' ? 'selected' : '' ?>>OR</option>
                                    <option value="PT" <?= old('ci_extension') == 'PT' ? 'selected' : '' ?>>PT</option>
                                    <option value="TJ" <?= old('ci_extension') == 'TJ' ? 'selected' : '' ?>>TJ</option>
                                    <option value="CH" <?= old('ci_extension') == 'CH' ? 'selected' : '' ?>>CH</option>
                                    <option value="BE" <?= old('ci_extension') == 'BE' ? 'selected' : '' ?>>BE</option>
                                    <option value="PD" <?= old('ci_extension') == 'PD' ? 'selected' : '' ?>>PD</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-500 text-xs italic mt-1">Seleccione el departamento de expedición.</p>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            G&eacute;nero <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="gender" name="beneficiary_gender" required>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                        </select>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cellphone">
                            Número de celular <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="cellphone" name="beneficiary_cellphone" type="number" placeholder="Ej: 70000000" value="<?= old('cellphone') ?>" required>
                    </div>
                    
                    <div class="md:col-span-2 lg:col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ref_name">
                            Nombre persona de referencia
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="ref_name" name="beneficiary_ref_name" type="text" placeholder="Nombre del familiar/amigo" value="<?= old('ref_name') ?>">
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ref_phone">
                            Teléfono de referencia
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="ref_phone" name="beneficiary_ref_phone" type="number" placeholder="Ej: 4444444" value="<?= old('ref_phone') ?>">
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="municipality">
                            Municipio
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                    id="  municipality" name="beneficiary_municipality" onchange="toggleOtherMunicipality(this)">
                                <option value="" selected>Seleccione...</option>
                                <option value="Cochabamba">Cochabamba</option>
                                <option value="Sacaba">Sacaba</option>
                                <option value="Quillacollo">Quillacollo</option>
                                <option value="Tiquipaya">Tiquipaya</option>
                                <option value="Colcapirua">Colcapirua</option>
                                <option value="Otro">Otro</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div id="other_municipality_container" class="hidden">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="other_municipality">
                            Especifique otro municipio
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition-all duration-300"
                            id="other_municipality" name="beneficiary_other_municipality" type="text" placeholder="Escriba el municipio">
                    </div>

                    <div class="col-span-full mt-4">
                        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Ubicación Exacta (Se detectará tu ubicación automáticamente) <span class="text-red-500">*</span>
                        </label>
                        
                        <div id="map" style="height: 400px; width: 100%; z-index: 0;" class="relative rounded-lg shadow-inner border border-gray-300"></div>
                        
                        <input type="hidden" id="latitude" name="beneficiary_latitude" required>
                        <input type="hidden" id="longitude" name="beneficiary_longitude" required>

                        <p class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-map-marker-alt"></i> 
                            <span id="map-status">Detectando tu ubicación...</span> (Puedes arrastrar el marcador para corregir).
                        </p>
                    </div>

                </div>
            </div>

            <div class="mb-8 border-b border-gray-200 pb-6">
                <h6 class="text-indigo-600 text-sm font-bold uppercase mb-4 tracking-wide">
                    3. Datos del Emprendimiento
                </h6>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="entrepreneurship_type">
                            Tipo de Emprendimiento <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition-colors"
                                    id="entrepreneurship_type" name="beneficiary_entrepreneurship_type" required>
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="Gastronomico" <?= old('entrepreneurship_type') == 'Gastronomico' ? 'selected' : '' ?>>Gastronómico</option>
                                <option value="Textil" <?= old('entrepreneurship_type') == 'Textil' ? 'selected' : '' ?>>Textil</option>
                                <option value="Servicios" <?= old('entrepreneurship_type') == 'Servicios' ? 'selected' : '' ?>>Servicios</option>
                                <option value="Artesano" <?= old('entrepreneurship_type') == 'Artesano' ? 'selected' : '' ?>>Artesano</option>
                                <option value="Otro" <?= old('entrepreneurship_type') == 'Otro' ? 'selected' : '' ?>>Otro</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sales_channel">
                            ¿Cómo ofrece sus servicios? <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition-colors"
                                    id="sales_channel" name="beneficiary_sales_channel" onchange="toggleOnlineChannel(this)" required>
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="Tienda fisica" <?= old('sales_channel') == 'Tienda fisica' ? 'selected' : '' ?>>Tienda física</option>
                                <option value="Venta ambulante" <?= old('sales_channel') == 'Venta ambulante' ? 'selected' : '' ?>>Venta ambulante</option>
                                <option value="Venta por internet" <?= old('sales_channel') == 'Venta por internet' ? 'selected' : '' ?>>Venta por internet</option>
                                <option value="Otro" <?= old('sales_channel') == 'Otro' ? 'selected' : '' ?>>Otro</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div id="online_specify_container" class="hidden md:col-span-2 transition-all duration-300">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="online_specify">
                            Especifique (Plataforma, Red Social, Web, etc.) <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="online_specify" name="beneficiary_online_specify" type="text" placeholder="Ej: Facebook Marketplace, WhatsApp, Página Web..." value="<?= old('online_specify') ?>">
                    </div>

                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="entrepreneurship_description">
                            Descripción del Emprendimiento <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="entrepreneurship_description" name="beneficiary_entrepreneurship_description" rows="3" 
                                placeholder="Describa brevemente de qué trata su negocio..." required><?= old('entrepreneurship_description') ?></textarea>
                    </div>

                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sales_address">
                            Dirección de Venta <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="sales_address" name="beneficiary_sales_address" type="text" 
                            placeholder="Dirección donde realiza la actividad comercial" value="<?= old('sales_address') ?>" required>
                    </div>

                </div>
            </div>

            <div class="mb-8 border-b border-gray-200 pb-6 mt-8">
                <h6 class="text-indigo-600 text-sm font-bold uppercase mb-4 tracking-wide">
                    4. Conocimiento Técnico y de Formación
                </h6>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="start_motivation">
                            ¿Por qué iniciaste este tipo de actividad? <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="start_motivation" name="beneficiary_start_motivation" rows="2" required><?= old('start_motivation') ?></textarea>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Pasaste algún curso con relación al negocio? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="has_course" name="beneficiary_has_course" onchange="toggleSection('has_course', 'course_detail_container', 'course_name')" required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si" <?= old('has_course') == 'Si' ? 'selected' : '' ?>>Sí</option>
                            <option value="No" <?= old('has_course') == 'No' ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>

                    <div id="course_detail_container" class="hidden transition-all duration-300">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="course_name">
                            Indica el nombre del curso <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="course_name" name="beneficiary_course_name" type="text" value="<?= old('course_name') ?>">
                    </div>

                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="missing_skills">
                            ¿Qué habilidades o conocimientos técnicos consideras que te hacen falta? <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="missing_skills" name="beneficiary_missing_skills" rows="2" required><?= old('missing_skills') ?></textarea>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Cuánto tiempo lleva funcionando tu negocio? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500" name="beneficiary_business_age" required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Menos de 6 meses">Menos de 6 meses</option>
                            <option value="Entre 6 meses y 1 año">Entre 6 meses y 1 año</option>
                            <option value="1 a 3 años">1 a 3 años</option>
                            <option value="Mas de 3 años">Más de 3 años</option>
                        </select>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Tenías experiencia cuando iniciaste? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="has_experience" name="beneficiary_has_experience" onchange="toggleSection('has_experience', 'experience_detail_container', 'experience_source')" required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div id="experience_detail_container" class="hidden md:col-span-2 transition-all duration-300">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="experience_source">
                            ¿Dónde la obtuviste? <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="experience_source" name="beneficiary_experience_source" type="text" value="<?= old('experience_source') ?>">
                    </div>

                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            Además de tu emprendimiento ¿Realizas otras actividades?
                        </label>
                        <div class="flex flex-wrap gap-4 mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="beneficiary_other_activities[]" value="Estudiar" class="form-checkbox h-5 w-5 text-indigo-600 bg-gray-100 border-gray-300 rounded">
                                <span class="ml-2 text-gray-700">Estudiar</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="beneficiary_other_activities[]" value="Quehaceres de casa" class="form-checkbox h-5 w-5 text-indigo-600 bg-gray-100 border-gray-300 rounded">
                                <span class="ml-2 text-gray-700">Quehaceres de casa</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="beneficiary_other_activities[]" value="Cuidar familia" class="form-checkbox h-5 w-5 text-indigo-600 bg-gray-100 border-gray-300 rounded">
                                <span class="ml-2 text-gray-700">Cuidar familia</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="beneficiary_other_activities[]" value="Otra actividad economica" class="form-checkbox h-5 w-5 text-indigo-600 bg-gray-100 border-gray-300 rounded">
                                <span class="ml-2 text-gray-700">Otra actividad económica</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿En qué horario estudias?
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500" name="beneficiary_study_schedule">
                            <option value="Ninguna" selected>Ninguna / No estudio</option>
                            <option value="Manana">Mañana</option>
                            <option value="Tarde">Tarde</option>
                            <option value="Noche">Noche</option>
                        </select>
                    </div>

                    <div class="col-span-full border-t border-gray-200 my-4"></div>

                    <div class="col-span-full md:col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Alguna institución compró algo para tu emprendimiento? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="inst_bought" name="beneficiary_inst_bought" onchange="toggleSection('inst_bought', 'inst_bought_details', 'inst_bought_name')" required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div id="inst_bought_details" class="hidden col-span-full md:col-span-1 grid grid-cols-1 gap-4 bg-blue-50 p-4 rounded-lg border border-blue-100">
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">¿Qué institución?</label>
                            <input class="w-full bg-white border border-gray-300 rounded py-2 px-3" id="inst_bought_name" name="beneficiary_inst_bought_name" type="text">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">¿Qué te compraron?</label>
                            <input class="w-full bg-white border border-gray-300 rounded py-2 px-3" id="inst_bought_what" name="beneficiary_inst_bought_what" type="text">
                        </div>
                    </div>

                    <div class="col-span-full md:col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Alguna institución te dio dinero? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="inst_money" name="beneficiary_inst_money" onchange="toggleSection('inst_money', 'inst_money_details', 'inst_money_name')" required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div id="inst_money_details" class="hidden col-span-full md:col-span-1 grid grid-cols-1 gap-4 bg-green-50 p-4 rounded-lg border border-green-100">
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">¿Qué institución?</label>
                            <input class="w-full bg-white border border-gray-300 rounded py-2 px-3" id="inst_money_name" name="beneficiary_inst_money_name" type="text">
                        </div>
                        <div>
                            <label class="block text-gray-700 text-xs font-bold mb-1">¿Cuánto fue?</label>
                            <select class="w-full bg-white border border-gray-300 rounded py-2 px-3" name="beneficiary_inst_money_amount">
                                <option value="" selected>Bs 0</option>
                                <option value="Menos de 1000">Menos de Bs. 1000</option>
                                <option value="Entre 1000 y 2000">Entre Bs. 1000 y Bs. 2000</option>
                                <option value="Mas de 2000">Más de Bs. 2000</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Compraste algunas cosas por tu cuenta? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full md:w-1/2 bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="self_bought" name="beneficiary_self_bought" onchange="toggleSection('self_bought', 'self_bought_details', 'self_bought_what')" required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div id="self_bought_details" class="hidden col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="self_bought_what">
                            ¿Qué compraste? <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="self_bought_what" name="beneficiary_self_bought_what" type="text" placeholder="Describe qué adquiriste...">
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Qué cosas requieres comprar URGENTEMENTE? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500" name="beneficiary_urgent_needs" required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Bienes">Bienes (Maquinaria, muebles)</option>
                            <option value="Insumos">Insumos (Materia prima)</option>
                            <option value="Otros">Otros</option>
                        </select>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="urgent_specify">
                            Especificar detalle urgente
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="urgent_specify" name="beneficiary_urgent_specify" type="text" placeholder="Detalla qué necesitas...">
                    </div>

                </div>
            </div>

            <div class="mb-8 border-b border-gray-200 pb-6 mt-8">
                <h6 class="text-indigo-600 text-sm font-bold uppercase mb-4 tracking-wide">
                    5. Cambio Climático y Buenas Prácticas Medioambientales
                </h6>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="col-span-full md:col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Conoces las buenas prácticas medioambientales en el emprendimiento? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="env_knowledge" name="beneficiary_env_knowledge" 
                                onchange="toggleSection('env_knowledge', 'env_practices_check_container', 'has_env_practices')" 
                                required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div id="env_practices_check_container" class="hidden col-span-full md:col-span-1 transition-all duration-300">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Tu idea de negocio tiene algunas buenas prácticas medioambientales? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="has_env_practices" name="beneficiary_has_env_practices" 
                                onchange="toggleSection('has_env_practices', 'env_practices_desc_container', 'env_practices_desc')">
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div id="env_practices_desc_container" class="hidden col-span-full transition-all duration-300">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="env_practices_desc">
                            ¿Cuáles? (Describa las prácticas) <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="env_practices_desc" name="beneficiary_env_practices_desc" rows="3" 
                                placeholder="Ej: Uso de materiales reciclados, ahorro de agua, gestión de residuos..."><?= old('env_practices_desc') ?></textarea>
                    </div>

                </div>
            </div>

            <div class="mb-8 border-b border-gray-200 pb-6 mt-8">
                <h6 class="text-indigo-600 text-sm font-bold uppercase mb-4 tracking-wide">
                    6. Costo, Ingreso y Capital
                </h6>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="col-span-full md:col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Haces el cálculo de cuánto te costará producir? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="calc_cost" name="beneficiary_calc_cost" 
                                onchange="toggleSection('calc_cost', 'calc_cost_detail_container', 'calc_cost_detail')" 
                                required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div id="calc_cost_detail_container" class="hidden col-span-full md:col-span-1 transition-all duration-300">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="calc_cost_detail">
                            ¿Cómo haces el cálculo? <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="calc_cost_detail" name="beneficiary_calc_cost_detail" rows="1" placeholder="Explique brevemente..."></textarea>
                    </div>

                    <div class="col-span-full md:col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Llevas un registro contable de tus ingresos y egresos? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="accounting" name="beneficiary_accounting" 
                                onchange="toggleSection('accounting', 'accounting_detail_container', 'accounting_detail')" 
                                required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div id="accounting_detail_container" class="hidden col-span-full md:col-span-1 transition-all duration-300">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="accounting_detail">
                            ¿Cómo haces el registro? <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="accounting_detail" name="beneficiary_accounting_detail" rows="1" placeholder="Cuaderno, Excel, Sistema..."></textarea>
                    </div>

                    <div class="col-span-full border-t border-gray-200 my-2"></div>

                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            ¿Tienes trabajadores contigo? (Familia o ajenos) <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full md:w-1/2 bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="has_workers" name="beneficiary_has_workers" onchange="toggleWorkerFlow(this)" required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si">Sí</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div id="workers_details_container" class="hidden col-span-full grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-5 rounded-lg border border-gray-200">
                        
                        <div class="border-b md:border-b-0 md:border-r border-gray-300 pb-4 md:pb-0 md:pr-4">
                            <h6 class="font-bold text-gray-600 mb-3">Mujeres</h6>
                            <div class="mb-3">
                                <label class="block text-xs font-bold mb-1">¿Cuántas?</label>
                                <input class="w-full bg-white border border-gray-300 rounded py-2 px-3" name="beneficiary_women_count" type="number" min="0" placeholder="0">
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-1">¿De qué edad?</label>
                                <select class="w-full bg-white border border-gray-300 rounded py-2 px-3" name="beneficiary_women_age">
                                    <option value="" selected>Ninguna</option>
                                    <option value="Menor de 18">Menor de 18 años</option>
                                    <option value="18 a 28">De 18 años a 28 años</option>
                                    <option value="Mas de 28">Más de 28 años</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <h6 class="font-bold text-gray-600 mb-3">Hombres</h6>
                            <div class="mb-3">
                                <label class="block text-xs font-bold mb-1">¿Cuántos?</label>
                                <input class="w-full bg-white border border-gray-300 rounded py-2 px-3" name="beneficiary_men_count" type="number" min="0" placeholder="0">
                            </div>
                            <div>
                                <label class="block text-xs font-bold mb-1">¿De qué edad?</label>
                                <select class="w-full bg-white border border-gray-300 rounded py-2 px-3" name="beneficiary_men_age">
                                    <option value="" selected>Ninguna</option>
                                    <option value="Menor de 18">Menor de 18 años</option>
                                    <option value="18 a 28">De 18 años a 28 años</option>
                                    <option value="Mas de 28">Más de 28 años</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-span-full mt-2 pt-2 border-t border-gray-300">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                ¿Reciben una remuneración?
                            </label>
                            <div class="flex gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-indigo-600" name="beneficiary_remuneration" value="Si">
                                    <span class="ml-2">Sí</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio text-indigo-600" name="beneficiary_remuneration" value="No">
                                    <span class="ml-2">No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div id="solo_income_container" class="hidden col-span-full md:col-span-1 transition-all duration-300 bg-yellow-50 p-4 rounded border border-yellow-200">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="monthly_income">
                            ¿Cuánto es tu ingreso mensual aproximado? (Solo del emprendimiento) <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="monthly_income" name="beneficiary_monthly_income">
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Menos de 1000">Menos de Bs. 1000</option>
                            <option value="Entre 1000 y 2000">Entre Bs. 1000 y Bs. 2000</option>
                            <option value="Mas de 2000">Más de Bs. 2000</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="mb-8 border-b border-gray-200 pb-6 mt-8">
                <h6 class="text-indigo-600 text-sm font-bold uppercase mb-4 tracking-wide">
                    7. Conocimiento del Mercado
                </h6>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="col-span-full md:col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="competitors_nearby">
                            ¿Existen otros negocios cerca que ofrecen lo mismo que tú? <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                    id="competitors_nearby" name="beneficiary_competitors_nearby" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="Si" <?= old('competitors_nearby') == 'Si' ? 'selected' : '' ?>>Sí</option>
                                <option value="No" <?= old('competitors_nearby') == 'No' ? 'selected' : '' ?>>No</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full md:col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sales_frequency">
                            ¿Cada cuánto vendes u ofreces tus servicios? <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="sales_frequency" name="beneficiary_sales_frequency" type="text" 
                            placeholder="Ej: Todos los días, Fines de semana, 2 veces al mes..." 
                            value="<?= old('sales_frequency') ?>" required>
                    </div>

                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="value_proposition">
                            ¿Por qué las personas prefieren tus productos o servicios en vez de otros? <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="value_proposition" name="beneficiary_value_proposition" rows="3" 
                                placeholder="Ej: Por la calidad, por el precio, por la atención..." required><?= old('value_proposition') ?></textarea>
                    </div>

                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="business_challenges">
                            ¿Cuáles son los principales desafíos que enfrenta tu negocio actualmente? <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                                id="business_challenges" name="beneficiary_business_challenges" rows="3" 
                                placeholder="Ej: Falta de capital, competencia desleal, falta de insumos..." required><?= old('business_challenges') ?></textarea>
                    </div>

                </div>
            </div>

            <div class="mb-8 border-b border-gray-200 pb-6 mt-8">
                <h6 class="text-indigo-600 text-sm font-bold uppercase mb-4 tracking-wide">
                    8. Conocimiento Legal
                </h6>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="labor_rights_knowledge">
                            ¿Conoces sobre derechos laborales? <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition-colors"
                                    id="labor_rights_knowledge" name="beneficiary_labor_rights_knowledge" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="Si" <?= old('labor_rights_knowledge') == 'Si' ? 'selected' : '' ?>>Sí</option>
                                <option value="No" <?= old('labor_rights_knowledge') == 'No' ? 'selected' : '' ?>>No</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="activity_laws_knowledge">
                            ¿Conoces las leyes que regulan tu actividad económica? <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition-colors"
                                    id="activity_laws_knowledge" name="beneficiary_activity_laws_knowledge" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="Si" <?= old('activity_laws_knowledge') == 'Si' ? 'selected' : '' ?>>Sí</option>
                                <option value="No" <?= old('activity_laws_knowledge') == 'No' ? 'selected' : '' ?>>No</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mb-8 border-b border-gray-200 pb-6 mt-8">
                <h6 class="text-indigo-600 text-sm font-bold uppercase mb-4 tracking-wide">
                    9. Género
                </h6>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="col-span-full md:col-span-1">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="care_children">
                            En tu casa, ¿hay niños a los que debes cuidar? <span class="text-red-500">*</span>
                        </label>
                        <select class="block w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 rounded focus:bg-white focus:border-indigo-500"
                                id="care_children" name="beneficiary_care_children" 
                                onchange="toggleSection('care_children', 'care_children_detail_container', 'care_children_relation')" 
                                required>
                            <option value="" disabled selected>Seleccione...</option>
                            <option value="Si" <?= old('care_children') == 'Si' ? 'selected' : '' ?>>Sí</option>
                            <option value="No" <?= old('care_children') == 'No' ? 'selected' : '' ?>>No</option>
                        </select>
                    </div>

                    <div id="care_children_detail_container" class="hidden col-span-full md:col-span-1 transition-all duration-300">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="care_children_relation">
                            ¿Qué relación tienen contigo? (Hijos, sobrinos, nietos...) <span class="text-red-500">*</span>
                        </label>
                        <input class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500"
                            id="care_children_relation" name="beneficiary_care_children_relation" type="text" 
                            placeholder="Ej: Soy su madre, soy su tía..." value="<?= old('care_children_relation') ?>">
                    </div>

                </div>
            </div>

            <div class="mb-8 border-b border-gray-200 pb-6 mt-8">
                <h6 class="text-indigo-600 text-sm font-bold uppercase mb-4 tracking-wide">
                    10. Expectativas
                </h6>
                
                <div class="grid grid-cols-1 gap-6">
                    
                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="short_term_goal">
                            ¿Cuál es tu principal objetivo a corto plazo para tu negocio? <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition-colors"
                                id="short_term_goal" name="beneficiary_short_term_goal" rows="3" 
                                placeholder="Ej: Aumentar mis ventas en un 20% en los próximos 3 meses..." required><?= old('short_term_goal') ?></textarea>
                    </div>

                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="long_term_goals">
                            ¿Cuáles son tus principales objetivos a largo plazo? <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition-colors"
                                id="long_term_goals" name="beneficiary_long_term_goals" rows="3" 
                                placeholder="Ej: Abrir una sucursal en otra zona y contratar más personal..." required><?= old('long_term_goals') ?></textarea>
                    </div>

                    <div class="col-span-full">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="support_needed">
                            ¿Qué tipo de apoyo o capacitación le gustaría recibir para mejorar su negocio? <span class="text-red-500">*</span>
                        </label>
                        <textarea class="appearance-none block w-full bg-gray-100 text-gray-700 border border-gray-300 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition-colors"
                                id="support_needed" name="beneficiary_support_needed" rows="3" 
                                placeholder="Ej: Marketing digital, contabilidad básica, manejo de inventarios..." required><?= old('support_needed') ?></textarea>
                    </div>

                </div>
            </div>

            <div class="flex items-center justify-end mt-8 border-t border-gray-200 pt-6">
                <button type="submit" class="w-full md:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 transform hover:-translate-y-0.5">
                    Guardar Diagnóstico
                </button>
            </div>

        </form>
    </div>
</section>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        /**
        * Función Maestra para mostrar/ocultar secciones basadas en selección Si/No
        * @param {string} selectId - ID del select (ej: 'has_course')
        * @param {string} containerId - ID del div a mostrar/ocultar
        * @param {string} requiredInputId - ID del input principal dentro del div (opcional)
        */
        function toggleSection(selectId, containerId, requiredInputId = null) {
            const select = document.getElementById(selectId);
            const container = document.getElementById(containerId);
            
            // Si el valor es "Si" (o lo que definas como trigger), mostramos
            if (select.value === 'Si') {
                container.classList.remove('hidden');
                container.classList.add('animate-fade-in'); // Si usas animación
                
                // Si pasamos un ID de input, lo hacemos obligatorio
                if (requiredInputId) {
                    const input = document.getElementById(requiredInputId);
                    if(input) input.setAttribute('required', 'required');
                }
            } else {
                container.classList.add('hidden');
                
                // Quitamos obligatoriedad
                if (requiredInputId) {
                    const input = document.getElementById(requiredInputId);
                    if(input) input.removeAttribute('required');
                    // Opcional: Limpiar valor
                    // if(input) input.value = ''; 
                }
            }
        }
    </script>
    <script>
        /**
         * Maneja la lógica específica de Trabajadores vs Ingresos
         * Si TIENE trabajadores -> Muestra detalles, oculta ingreso.
         * Si NO TIENE trabajadores -> Muestra ingreso, oculta detalles.
         */
        function toggleWorkerFlow(selectElement) {
            const workersContainer = document.getElementById('workers_details_container');
            const incomeContainer = document.getElementById('solo_income_container');
            const incomeInput = document.getElementById('monthly_income');
            
            // Inputs requeridos dentro de trabajadores (para quitarlos si no aplica)
            // Simplificación: Podríamos seleccionar todos los inputs dentro del container
            
            if (selectElement.value === 'Si') {
                // MOSTRAR Trabajadores
                workersContainer.classList.remove('hidden');
                workersContainer.classList.add('animate-fade-in');
                
                // OCULTAR Ingresos
                incomeContainer.classList.add('hidden');
                incomeInput.removeAttribute('required');
                incomeInput.value = "";

            } else {
                // OCULTAR Trabajadores
                workersContainer.classList.add('hidden');
                
                // MOSTRAR Ingresos
                incomeContainer.classList.remove('hidden');
                incomeContainer.classList.add('animate-fade-in');
                incomeInput.setAttribute('required', 'required');
            }
        }
    </script>
    <script>
        function toggleOnlineChannel(selectElement) {
            const container = document.getElementById('online_specify_container');
            const input = document.getElementById('online_specify');
            
            // Si el valor es "Venta por internet", mostramos el campo
            if (selectElement.value === 'Venta por internet') {
                container.classList.remove('hidden');
                input.setAttribute('required', 'required'); // Lo hacemos obligatorio
                
                // Animación suave (Opcional)
                container.classList.add('animate-fade-in');
            } else {
                container.classList.add('hidden');
                input.removeAttribute('required'); // Quitamos la obligatoriedad
                input.value = ''; // Limpiamos el valor para no enviar basura
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Configuración Inicial (Por defecto Cochabamba si falla el GPS)
            const defaultLat = -17.3938; 
            const defaultLng = -66.1569;
            let map, marker;

            // Verificar que Leaflet cargó
            if (typeof L === 'undefined') {
                console.error("Leaflet no cargó correctamente.");
                return;
            }

            // 2. Inicializar el mapa
            map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            // Función auxiliar para mover el marcador y actualizar inputs
            function setLocation(lat, lng) {
                // Actualizar inputs ocultos
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                // Mover o crear marcador
                if (marker) {
                    marker.setLatLng([lat, lng]);
                } else {
                    marker = L.marker([lat, lng], {draggable: true}).addTo(map);
                    
                    // Evento: Al terminar de arrastrar
                    marker.on('dragend', function(e) {
                        var position = marker.getLatLng();
                        document.getElementById('latitude').value = position.lat;
                        document.getElementById('longitude').value = position.lng;
                    });
                }
                
                // Centrar mapa
                map.setView([lat, lng], 16);
            }

            // 3. GEOLOCALIZACIÓN DEL USUARIO
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        // ÉXITO: El usuario dio permiso
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;
                        
                        setLocation(userLat, userLng);
                        document.getElementById('map-status').innerText = "Ubicación detectada exitosamente.";
                        document.getElementById('map-status').className = "text-green-600 font-bold";
                    }, 
                    function(error) {
                        // ERROR: El usuario denegó permiso o falló
                        console.warn("Geolocalización falló o fue denegada:", error);
                        setLocation(defaultLat, defaultLng); // Usar Cochabamba
                        document.getElementById('map-status').innerText = "No se pudo detectar ubicación. Seleccione manualmente.";
                    }
                );
            } else {
                // El navegador no soporta geolocalización
                setLocation(defaultLat, defaultLng);
            }

            // 4. Click manual en el mapa
            map.on('click', function(e) {
                setLocation(e.latlng.lat, e.latlng.lng);
            });

            // Parche visual
            setTimeout(function(){ map.invalidateSize(); }, 500);
        });

        // Tus otras funciones (toggleOtherMunicipality, etc.)
        function toggleOtherMunicipality(selectElement) {
            const otherContainer = document.getElementById('other_municipality_container');
            const otherInput = document.getElementById('other_municipality');
            if (selectElement.value === 'Otro') {
                otherContainer.classList.remove('hidden');
                otherInput.setAttribute('required', 'required');
            } else {
                otherContainer.classList.add('hidden');
                otherInput.removeAttribute('required');
            }
        }
    </script>
<?= $this->endSection() ?>