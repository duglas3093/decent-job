<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Edición de beneficiario
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-0 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <input type="hidden" id="base_url" value="<?= base_url() ?>">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl ligth:bg-slate-850 ligth:shadow-ligth-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap items-start justify-between">
                            <h6 class="ligth:text-white text-xl mb-4 md:mb-0">Informaci&oacute;n</h6>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <?php if($beneficiary['status_id'] == 9 ): ?>
                                    <button onclick="showVulnerabilities(<?= $beneficiary['beneficiary_id'] ?>)" title="Vulnerabilidad" style="display: none;" class="inline-block px-4 py-2.5 bg-amber-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-amber-500"
                                                data-te-toggle="modal"
                                                    data-te-target="#vulnerability_participant"
                                                    data-te-ripple-init
                                                    data-te-ripple-color="light"
                                                    >
                                        <i class="fa-solid fa-user-injured"></i> 
                                        <span class="hidden sm:inline">Vulnerabilidades</span>
                                    </button>
                                    <a href="<?= base_url("admin/approve_postulant/{$beneficiary['beneficiary_id']}"); ?>" class="inline-block px-4 py-2.5 bg-green-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-500">
                                        <i class="fa-solid fa-check"></i> 
                                        <span class="hidden sm:inline">Aceptar</span>
                                    </a>
                                    <a href="<?= base_url("admin/drop_postulant/{$beneficiary['beneficiary_id']}"); ?>" class="inline-block px-4 py-2.5 bg-red-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-red-500">
                                        <i class="fa-solid fa-times"></i> 
                                        <span class="hidden sm:inline">Rechazar</span>
                                    </a>
                                <?php else: ?>
                                    <button onclick="exportToXlsx()" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-bold uppercase rounded shadow hover:shadow-md transition-all">
                                        <i class="fa-solid fa-file-excel mr-2"></i> Excel
                                    </button>
                                    <button onclick="printKardex('imprimir')" class="inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-800 text-white text-xs font-bold uppercase rounded shadow hover:shadow-md transition-all">
                                        <i class="fa-solid fa-print mr-2"></i> Imprimir
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- ---------------------------------------------------------------------------------------------------- -->
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8" >
                        <div class="overflow-x-auto ml-4 pr-8 pl-4 pt-4 pb-4">
                            <div class="bg-white rounded-lg shadow-lg border border-gray-200" id="imprimir">
                                
                                <div class="px-8 py-6 bg-gray-50 border-b border-gray-200">
                                    <div class="flex flex-wrap justify-between items-start">
                                        <div>
                                            <h6 class="font-bold text-2xl text-indigo-700 mb-1">
                                                <?= strtoupper("{$beneficiary['beneficiary_names']} {$beneficiary['beneficiary_lastnames']}") ?>
                                            </h6>
                                            <p class="text-gray-500 text-sm">
                                                <i class="fas fa-id-card mr-1"></i> 
                                                C.I.: <?= "{$beneficiary['beneficiary_ci']} {$beneficiary['beneficiary_ci_extension']}" ?>
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">
                                                Gestión <?= $beneficiary['beneficiary_financier_year'] ?>
                                            </span>
                                            <p class="text-sm font-bold text-gray-600 mt-1">
                                                <?= isset($beneficiary['financier_name']) ? $beneficiary['financier_name'] : 'Financiador: ' . $beneficiary['financier_project'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6 grid grid-cols-2 md:grid-cols-5 gap-4 text-sm">
                                        <div>
                                            <span class="block text-gray-500 text-xs font-bold uppercase">Edad</span>
                                            <span class="font-medium text-gray-900">
                                                <?= ((new DateTime(date("Y-m-d")))->diff(new DateTime($beneficiary['beneficiary_birthdate'])))->y ?> Años
                                            </span>
                                        </div>
                                        <div>
                                            <span class="block text-gray-500 text-xs font-bold uppercase">Genero</span>
                                            <span class="font-medium text-gray-900"><?= $beneficiary['beneficiary_gender'] ?></span>
                                        </div>
                                        <div>
                                            <span class="block text-gray-500 text-xs font-bold uppercase">Celular</span>
                                            <span class="font-medium text-gray-900"><?= $beneficiary['beneficiary_cellphone'] ?></span>
                                        </div>
                                        <div>
                                            <span class="block text-gray-500 text-xs font-bold uppercase">Municipio</span>
                                            <span class="font-medium text-gray-900">
                                                <?= $beneficiary['beneficiary_municipality'] === 'Otro' ? $beneficiary['beneficiary_other_municipality'] : $beneficiary['beneficiary_municipality'] ?>
                                            </span>
                                        </div>
                                        <div>
                                            <span class="block text-gray-500 text-xs font-bold uppercase">Fecha Registro</span>
                                            <span class="font-medium text-gray-900">
                                                <?= date('d/m/Y', strtotime($beneficiary['beneficiary_created_at'])) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-8 py-6 space-y-8">

                                    <section>
                                        <h5 class="text-indigo-600 font-bold uppercase text-xs tracking-wider border-b border-gray-200 pb-2 mb-4">
                                            1. Ubicación y Contacto
                                        </h5>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div>
                                                <p class="mb-2"><span class="font-bold text-gray-600 text-xs block">Referencia Personal:</span> <?= $beneficiary['beneficiary_ref_name'] ?? 'N/A' ?> (<?= $beneficiary['beneficiary_ref_phone'] ?? 'S/N' ?>)</p>
                                                <p class="mb-2"><span class="font-bold text-gray-600 text-xs block">Coordenadas:</span> <?= $beneficiary['beneficiary_latitude'] ?>, <?= $beneficiary['beneficiary_longitude'] ?></p>
                                            </div>
                                            <div class="h-40 w-full rounded-lg overflow-hidden border border-gray-300 z-0">
                                                <div id="map-readonly" style="height: 100%; width: 100%;"></div>
                                            </div>
                                        </div>
                                    </section>

                                    <section>
                                        <h5 class="text-indigo-600 font-bold uppercase text-xs tracking-wider border-b border-gray-200 pb-2 mb-4">
                                            2. Datos del Emprendimiento
                                        </h5>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                            <div>
                                                <span class="font-bold text-gray-600 text-xs block">Rubro:</span>
                                                <?= $beneficiary['beneficiary_entrepreneurship_type'] ?>
                                            </div>
                                            <div>
                                                <span class="font-bold text-gray-600 text-xs block">Canal de Venta:</span>
                                                <?= $beneficiary['beneficiary_sales_channel'] ?>
                                                <?php if($beneficiary['beneficiary_sales_channel'] == 'Venta por internet'): ?>
                                                    <span class="text-xs text-gray-500 block">(<?= $beneficiary['beneficiary_online_specify'] ?>)</span>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <span class="font-bold text-gray-600 text-xs block">Dirección de Venta:</span>
                                                <?= $beneficiary['beneficiary_sales_address'] ?>
                                            </div>
                                            <div class="col-span-full">
                                                <span class="font-bold text-gray-600 text-xs block">Descripción:</span>
                                                <p class="text-gray-800 bg-gray-50 p-3 rounded text-sm mt-1">
                                                    <?= $beneficiary['beneficiary_entrepreneurship_description'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </section>

                                    <section>
                                        <h5 class="text-indigo-600 font-bold uppercase text-xs tracking-wider border-b border-gray-200 pb-2 mb-4">
                                            3. Formación y Experiencia
                                        </h5>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                                            <p><span class="font-bold text-gray-600">Tiempo del negocio:</span> <?= $beneficiary['beneficiary_business_age'] ?></p>
                                            <p><span class="font-bold text-gray-600">Horario estudio:</span> <?= $beneficiary['beneficiary_study_schedule'] ?></p>
                                            
                                            <div class="col-span-full">
                                                <span class="font-bold text-gray-600 block">Motivación:</span> 
                                                <?= $beneficiary['beneficiary_start_motivation'] ?>
                                            </div>

                                            <div>
                                                <span class="font-bold text-gray-600">¿Tiene Cursos?:</span> 
                                                <?= $beneficiary['beneficiary_has_course'] ?>
                                                <?php if($beneficiary['beneficiary_has_course'] == 'Si'): ?>
                                                    <span class="text-gray-500 italic"> - <?= $beneficiary['beneficiary_course_name'] ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <div>
                                                <span class="font-bold text-gray-600">¿Experiencia Previa?:</span> 
                                                <?= $beneficiary['beneficiary_has_experience'] ?>
                                                <?php if($beneficiary['beneficiary_has_experience'] == 'Si'): ?>
                                                    <span class="text-gray-500 italic"> - <?= $beneficiary['beneficiary_experience_source'] ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="col-span-full">
                                                <span class="font-bold text-gray-600">Otras Actividades:</span>
                                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded ml-2">
                                                    <?= $beneficiary['beneficiary_other_activities'] ?? 'Ninguna' ?>
                                                </span>
                                            </div>
                                        </div>
                                    </section>

                                    <section>
                                        <h5 class="text-indigo-600 font-bold uppercase text-xs tracking-wider border-b border-gray-200 pb-2 mb-4">
                                            4. Financiamiento y Activos
                                        </h5>
                                        <div class="overflow-x-auto">
                                            <table class="min-w-full text-sm text-left text-gray-500">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                    <tr>
                                                        <th class="px-4 py-2">Concepto</th>
                                                        <th class="px-4 py-2">Respuesta</th>
                                                        <th class="px-4 py-2">Detalle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="border-b">
                                                        <td class="px-4 py-2 font-medium">Institución compró algo</td>
                                                        <td class="px-4 py-2"><?= $beneficiary['beneficiary_inst_bought'] ?></td>
                                                        <td class="px-4 py-2"><?= $beneficiary['beneficiary_inst_bought'] == 'Si' ? "{$beneficiary['beneficiary_inst_bought_name']} ({$beneficiary['beneficiary_inst_bought_what']})" : '-' ?></td>
                                                    </tr>
                                                    <tr class="border-b">
                                                        <td class="px-4 py-2 font-medium">Institución dio dinero</td>
                                                        <td class="px-4 py-2"><?= $beneficiary['beneficiary_inst_money'] ?></td>
                                                        <td class="px-4 py-2"><?= $beneficiary['beneficiary_inst_money'] == 'Si' ? "{$beneficiary['beneficiary_inst_money_name']} - {$beneficiary['beneficiary_inst_money_amount']}" : '-' ?></td>
                                                    </tr>
                                                    <tr class="border-b">
                                                        <td class="px-4 py-2 font-medium">Inversión Propia</td>
                                                        <td class="px-4 py-2"><?= $beneficiary['beneficiary_self_bought'] ?></td>
                                                        <td class="px-4 py-2"><?= $beneficiary['beneficiary_self_bought'] == 'Si' ? $beneficiary['beneficiary_self_bought_what'] : '-' ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-4 bg-yellow-50 p-3 rounded border border-yellow-100 text-sm">
                                            <span class="font-bold text-yellow-800">Necesidad Urgente:</span> 
                                            <?= $beneficiary['beneficiary_urgent_needs'] ?> - <?= $beneficiary['beneficiary_urgent_specify'] ?>
                                        </div>
                                    </section>

                                    <section>
                                        <h5 class="text-indigo-600 font-bold uppercase text-xs tracking-wider border-b border-gray-200 pb-2 mb-4">
                                            5. Economía y Personal
                                        </h5>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <p><span class="font-bold text-gray-600">Calcula Costos:</span> <?= $beneficiary['beneficiary_calc_cost'] ?></p>
                                                <?php if($beneficiary['beneficiary_calc_cost'] == 'Si'): ?>
                                                    <p class="text-xs text-gray-500 pl-2"><?= $beneficiary['beneficiary_calc_cost_detail'] ?></p>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <p><span class="font-bold text-gray-600">Lleva Contabilidad:</span> <?= $beneficiary['beneficiary_accounting'] ?></p>
                                                <?php if($beneficiary['beneficiary_accounting'] == 'Si'): ?>
                                                    <p class="text-xs text-gray-500 pl-2"><?= $beneficiary['beneficiary_accounting_detail'] ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="mt-4 p-4 rounded bg-gray-50 border border-gray-200">
                                            <?php if($beneficiary['beneficiary_has_workers'] == 'Si'): ?>
                                                <h6 class="font-bold text-gray-700 mb-2 border-b pb-1">Cuenta con Trabajadores:</h6>
                                                <div class="grid grid-cols-2 gap-4 text-sm">
                                                    <div>
                                                        <p><strong>Mujeres:</strong> <?= $beneficiary['beneficiary_women_count'] ?> (<?= $beneficiary['beneficiary_women_age'] ?>)</p>
                                                    </div>
                                                    <div>
                                                        <p><strong>Hombres:</strong> <?= $beneficiary['beneficiary_men_count'] ?> (<?= $beneficiary['beneficiary_men_age'] ?>)</p>
                                                    </div>
                                                    <div class="col-span-full">
                                                        <p><strong>Reciben Remuneración:</strong> <?= $beneficiary['beneficiary_remuneration'] ?></p>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="flex items-center text-sm">
                                                    <span class="font-bold text-gray-700 mr-2">No tiene trabajadores.</span>
                                                    <span>Ingreso Mensual Aprox: <strong class="text-green-600"><?= $beneficiary['beneficiary_monthly_income'] ?></strong></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </section>

                                    <section>
                                        <h5 class="text-indigo-600 font-bold uppercase text-xs tracking-wider border-b border-gray-200 pb-2 mb-4">
                                            6. Análisis y Expectativas
                                        </h5>
                                        <div class="grid grid-cols-1 gap-4 text-sm">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                <div><span class="font-bold text-gray-600">Competencia Cerca:</span> <?= $beneficiary['beneficiary_competitors_nearby'] ?></div>
                                                <div><span class="font-bold text-gray-600">Frecuencia Venta:</span> <?= $beneficiary['beneficiary_sales_frequency'] ?></div>
                                            </div>
                                            
                                            <div>
                                                <span class="font-bold text-gray-600 block">Propuesta de Valor:</span>
                                                <p class="text-gray-800"><?= $beneficiary['beneficiary_value_proposition'] ?></p>
                                            </div>
                                            <div>
                                                <span class="font-bold text-gray-600 block">Desafíos Actuales:</span>
                                                <p class="text-gray-800"><?= $beneficiary['beneficiary_business_challenges'] ?></p>
                                            </div>
                                            
                                            <div class="mt-2 pt-2 border-t border-dashed border-gray-300">
                                                <div class="mb-2">
                                                    <span class="font-bold text-indigo-700 block text-xs uppercase">Meta Corto Plazo</span>
                                                    <?= $beneficiary['beneficiary_short_term_goal'] ?>
                                                </div>
                                                <div class="mb-2">
                                                    <span class="font-bold text-indigo-700 block text-xs uppercase">Meta Largo Plazo</span>
                                                    <?= $beneficiary['beneficiary_long_term_goals'] ?>
                                                </div>
                                                <div>
                                                    <span class="font-bold text-indigo-700 block text-xs uppercase">Apoyo Solicitado</span>
                                                    <?= $beneficiary['beneficiary_support_needed'] ?>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                    
                                    <section class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                                        <div>
                                            <h5 class="text-indigo-600 font-bold uppercase text-xs tracking-wider border-b border-gray-200 pb-2 mb-2">Legal</h5>
                                            <ul class="list-disc pl-5">
                                                <li>Derechos Laborales: <strong><?= $beneficiary['beneficiary_labor_rights_knowledge'] ?></strong></li>
                                                <li>Leyes Económicas: <strong><?= $beneficiary['beneficiary_activity_laws_knowledge'] ?></strong></li>
                                            </ul>
                                        </div>
                                        <div>
                                            <h5 class="text-indigo-600 font-bold uppercase text-xs tracking-wider border-b border-gray-200 pb-2 mb-2">Género</h5>
                                            <p><span class="font-bold">Cuidado de niños:</span> <?= $beneficiary['beneficiary_care_children'] ?></p>
                                            <?php if($beneficiary['beneficiary_care_children'] == 'Si'): ?>
                                                <p class="text-gray-500 italic">Relación: <?= $beneficiary['beneficiary_care_children_relation'] ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        </div>
                    </div>

                    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
                    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Obtenemos coordenadas de PHP
                            const lat = <?= $beneficiary['beneficiary_latitude'] ?? 0 ?>;
                            const lng = <?= $beneficiary['beneficiary_longitude'] ?? 0 ?>;

                            if (lat != 0 && lng != 0) {
                                var map = L.map('map-readonly', {
                                    center: [lat, lng],
                                    zoom: 15,
                                    dragging: false,       // Desactivar arrastre
                                    touchZoom: false,      // Desactivar zoom táctil
                                    scrollWheelZoom: false,// Desactivar scroll
                                    doubleClickZoom: false,// Desactivar doble click
                                    boxZoom: false,
                                    zoomControl: false     // Ocultar controles de zoom
                                });

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; OpenStreetMap'
                                }).addTo(map);

                                L.marker([lat, lng]).addTo(map);
                            } else {
                                document.getElementById('map-readonly').innerHTML = '<div class="flex items-center justify-center h-full bg-gray-100 text-gray-400 text-xs">Sin ubicación registrada</div>';
                            }
                        });
                    </script>

                    <style>
                        @media print {
                            body * {
                                visibility: hidden;
                            }
                            #imprimir, #imprimir * {
                                visibility: visible;
                            }
                            #imprimir {
                                position: absolute;
                                left: 0;
                                top: 0;
                                width: 100%;
                                margin: 0;
                                padding: 0;
                            }
                            /* Ajuste para que el mapa se vea al imprimir */
                            .leaflet-container {
                                width: 100% !important;
                                height: 200px !important;
                            }
                        }
                    </style>                    
                    <!-- ---------------------------------------------------------------------------------------------------- -->
                </div>
            </div>
        </div>
    </div>
    
    <div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="vulnerability_participant" tabindex="-1" aria-labelledby="titleModal" aria-modal="true" role="dialog">
        <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px]">
            <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none ligth:bg-neutral-600">
            <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 ligth:border-opacity-50">
                <h5 class="text-xl font-medium leading-normal text-neutral-800 ligth:text-neutral-200">Vulnerabilidades</h5>
                <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                </button>
            </div>
            <div class="relative p-4">
                <div class="grid justify-items-end ...">
                    <button class="bg-amber-500 hover:bg-amber-700 text-white py-1 px-3 rounded mr-0" onclick="viewForm()" title="Agregar Vulnerabilidad">
                        <i class="fa-solid fa-plus"></i> Agregar Vulnerabilidad
                    </button>
                </div>
                <div id="newVulnerabilityForBeneficiary" style="display: none;">
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-3/8 px-3 mb-2 md:mb-0">
                            <input type="hidden" name="bevu_id" id="bevu_id" value="">
                            <input type="hidden" name="beneficiary_id" id="beneficiary_id" value="">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area_id">
                                VULNERABILIDAD<span class="text-red-600 ">*</span>
                            </label>
                            <select
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.area_id') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="vulnerability_id" name="vulnerability_id">
                                <?php foreach ($vulnerabilities as $vulnerability):?>
                                    <option value="<?= $vulnerability['vulnerability_id'] ?>"><?= $vulnerability['vulnerability_name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-red-500 text-xs italic"></p>
                        </div>
                        <div class="w-full md:w-3/8 px-3 mb-2 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area_id">
                                OBSERVACION<span class="text-red-600 ">*</span>
                            </label>
                            <input type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.area_id') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white" id="vulnerability_observation">
                            <p class="text-red-500 text-xs italic"></p>
                        </div>
                        <div class="w-full md:w-1/8 px-3 mb-2 md:mb-0 md:mt-6">
                            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-0" onclick="saveVulnerabilityBeneficiary()" title="Guardar">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-0" onclick="viewForm()" title="Cancelar">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table">
                    <thead class="align-bottom">
                        <tr class="">
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                VULNERABILIDADES
                            </th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                OBSERVACION
                            </th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                        </tr>
                    </thead>
                    <tbody id="vulnerabilityBeneficiaryTable"></tbody>
                </table>
            </div>
                <div class="flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md border-t-2 border-neutral-100 border-opacity-100 p-4 ligth:border-opacity-50">
                    <button type="button" class="inline-block rounded bg-primary-100 px-6 pt-2.5 pb-2 text-xs font-medium uppercase leading-normal text-primary-700 transition duration-150 ease-in-out hover:bg-primary-accent-100 focus:bg-primary-accent-100 focus:outline-none focus:ring-0 active:bg-primary-accent-200" data-te-modal-dismiss data-te-ripple-init data-te-ripple-color="light">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    // --- LÓGICA DE IMPRESIÓN CORREGIDA ---
    function printKardex(idDiv) {
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

    // --- LÓGICA DE MAPA (Igual que antes) ---
    document.addEventListener('DOMContentLoaded', function() {
        const lat = <?= $beneficiary['beneficiary_latitude'] ?? 0 ?>;
        const lng = <?= $beneficiary['beneficiary_longitude'] ?? 0 ?>;

        if (lat != 0 && lng != 0) {
            var map = L.map('map-readonly', {
                center: [lat, lng],
                zoom: 15,
                dragging: false,
                touchZoom: false,
                scrollWheelZoom: false,
                doubleClickZoom: false,
                boxZoom: false,
                zoomControl: false,
                attributionControl: false // Ocultar marca de agua para limpiar vista
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(map);

            L.marker([lat, lng]).addTo(map);
            
            // Reajuste final para asegurar que el mapa renderice bien al cargar
            setTimeout(() => { map.invalidateSize(); }, 200);
        } else {
            document.getElementById('map-readonly').innerHTML = '<div class="flex items-center justify-center h-full bg-gray-100 text-gray-400 text-xs py-10">Sin ubicación registrada</div>';
        }
    });

    function showVulnerabilities(beneficiary){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/get_vulnerabilities`
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                beneficiary:beneficiary,
            },
            success: (result)=>{
                document.getElementById('beneficiary_id').value = beneficiary
                let vulnerabilities = JSON.parse(result)
                let html = ``
                if (vulnerabilities.length > 0) {
                    vulnerabilities.map( vulnerability => {
                        html += `
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    ${vulnerability.vulnerability_name}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent content-end">
                                    <div class="grid justify-items-center">${vulnerability.bevu_observation}</div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    <button title="Editar Vulnerabilidad" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" onClick="editVulnerability(${vulnerability.bevu_id})">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button title="Borrar Vulnerabilidad" class="inline-block px-2 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" onClick="deleteVulnerability(${vulnerability.bevu_id})">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                        `
                    })
                }else{
                    html += `
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent content-end">
                                    No se agregaron vulnerabilidades
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    
                                </td>
                            </tr>
                        `
                }
                $('#vulnerabilityBeneficiaryTable').html(html);
            },
            error: (error)=>{}
        })
    }

    function viewForm(){
        // clearInputs()
        let newVulnerabilityForBeneficiary = document.getElementById('newVulnerabilityForBeneficiary').style.display;
        document.getElementById('newVulnerabilityForBeneficiary').style.display = newVulnerabilityForBeneficiary == 'none' ? 'block' : 'none';
    }

    function saveVulnerabilityBeneficiary(){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/save_vulnerabilities`
        let beneficiary = document.getElementById('beneficiary_id').value;
        let bevu = document.getElementById('bevu_id').value;
        let vulnerability = document.getElementById('vulnerability_id').value;
        let observation = document.getElementById('vulnerability_observation').value;
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                beneficiary:beneficiary,
                vulnerability:vulnerability,
                observation:observation,
                bevu:bevu
            },
            success: (result)=>{
                showVulnerabilities(beneficiary);
                viewForm()
                document.getElementById('beneficiary_id').value = "";
                document.getElementById('vulnerability_id').value = "";
                document.getElementById('bevu_id').value = "";
                document.getElementById('vulnerability_observation').value = "";
            },
            error: (error)=>{}
        })
    }

    function editVulnerability(bevu_id){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/edit_vulnerabilitie`
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                bevu_id:bevu_id
            },
            success: (result)=>{
                let vulnerability = JSON.parse(result)
                viewForm()
                document.getElementById('beneficiary_id').value = vulnerability.beneficiary_id;
                document.getElementById('vulnerability_id').value = vulnerability.vulnerability_id;
                document.getElementById('bevu_id').value = vulnerability.bevu_id;
                document.getElementById('vulnerability_observation').value = vulnerability.bevu_observation;

                var selectElement = document.getElementById("vulnerability_id");

                // Valor que deseas seleccionar
                var valorASeleccionar = vulnerability.vulnerability_id;

                // Itera a través de las opciones para encontrar la que coincide con el valor
                for (var i = 0; i < selectElement.options.length; i++) {
                    if (selectElement.options[i].value === valorASeleccionar) {
                        selectElement.options[i].selected = true;
                        break; // Termina el bucle una vez que se haya encontrado la opción
                    }
                }
            },
            error: (error)=>{}
        })
    }
    
    function deleteVulnerability(bevu_id){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/delete_vulnerabilitie`
        let beneficiary = document.getElementById('beneficiary_id').value;
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                bevu_id:bevu_id
            },
            success: (result)=>{
                showVulnerabilities(beneficiary);
                // viewForm()
                document.getElementById('beneficiary_id').value = "";
                document.getElementById('vulnerability_id').value = "";
                document.getElementById('vulnerability_observation').value = "";
            },
            error: (error)=>{}
        })
    }
</script>
<?= $this->endSection() ?>