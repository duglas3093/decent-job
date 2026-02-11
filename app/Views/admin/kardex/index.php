<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Kardex: <?= $beneficiary['beneficiary_names'] ?> <?= $beneficiary['beneficiary_lastnames'] ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
    // ID Fijo del Cuestionario de Seguimiento Emprendedor
    $questionnaire_id_to_fill = 4;
?>

<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">

        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border" id="imprimir">

            <div class="p-6 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <div>
                        <h5 class="font-bold text-slate-700 text-xl">KARDEX DE BENEFICIARIO</h5>
                        <p class="text-sm text-slate-500">Historial de Seguimiento a Emprendedores</p>
                    </div>
                    <div class="flex gap-2 print:hidden"> <button onclick="printKardex('imprimir')" class="inline-flex items-center px-4 py-2 bg-slate-700 text-white font-bold text-xs uppercase rounded-lg shadow hover:bg-slate-800 transition duration-150">
                            <i class="fa-solid fa-print mr-2"></i> Imprimir Ficha
                        </button>
                        <a href="<?= base_url("admin/questionnaire/fill/{$beneficiary['beneficiary_id']}/{$questionnaire_id_to_fill}"); ?>"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-bold text-xs uppercase rounded-lg shadow hover:bg-blue-700 transition duration-150">
                            <i class="fa-solid fa-plus mr-2"></i> Nuevo Seguimiento
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6 border-b border-gray-100 bg-slate-50/50"> <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-1 flex justify-center md:justify-start">
                        <div class="w-16 h-16 rounded-full bg-white border-2 border-blue-100 flex items-center justify-center text-blue-500 text-2xl shadow-sm">
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>

                    <div class="md:col-span-7">
                        <h6 class="font-bold text-xl text-slate-800 mb-2">
                            <?= strtoupper("{$beneficiary['beneficiary_names']} {$beneficiary['beneficiary_lastnames']}") ?>
                        </h6>
                        <div class="flex flex-wrap gap-4 text-sm text-slate-600">
                            <span class="flex items-center bg-white px-3 py-1 rounded-full border border-gray-200">
                                <i class="fa-regular fa-id-card mr-2 text-blue-400"></i> <?= $beneficiary['beneficiary_ci'] ?> <?= $beneficiary['beneficiary_ci_extension'] ?>
                            </span>
                            <span class="flex items-center bg-white px-3 py-1 rounded-full border border-gray-200">
                                <i class="fa-solid fa-cake-candles mr-2 text-blue-400"></i> <?= ((new DateTime(date("Y-m-d")))->diff(new DateTime($beneficiary['beneficiary_birthdate'])))->y ?> Años
                            </span>
                            <span class="flex items-center bg-white px-3 py-1 rounded-full border border-gray-200">
                                <i class="fa-solid fa-phone mr-2 text-green-500"></i> <?= $beneficiary['beneficiary_cellphone'] ?>
                            </span>
                        </div>
                    </div>

                    <div class="md:col-span-4 md:text-right flex flex-col justify-center items-center md:items-end">
                        <span class="text-xs font-bold text-slate-400 uppercase">Fecha de Ingreso</span>
                        <span class="text-sm font-semibold text-slate-700 mb-2">
                            <i class="fa-regular fa-calendar-check mr-1"></i>
                            <?= date('d/m/Y', strtotime($beneficiary['beneficiary_created_at'])) ?>
                        </span>
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                            ACTIVO
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <h6 class="font-bold text-slate-700 mb-6 flex items-center text-lg">
                    <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded flex items-center justify-center mr-3">
                        <i class="fa-solid fa-list-check"></i>
                    </span>
                    Historial de Evaluaciones Realizadas
                </h6>

                <?php if(empty($submissions)): ?>
                    <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                        <i class="fa-solid fa-folder-open text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500 mb-4 font-medium">No se han registrado seguimientos para este beneficiario.</p>
                        <a href="<?= base_url("admin/questionnaire/fill/{$beneficiary['beneficiary_id']}/{$questionnaire_id_to_fill}"); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-bold text-sm rounded-lg hover:bg-blue-700 transition">
                            <i class="fa-solid fa-plus mr-2"></i> Iniciar primer seguimiento
                        </a>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50/80 border-b border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4 w-16 text-center font-bold">#</th>
                                    <th scope="col" class="px-6 py-4 font-bold">Detalle del Seguimiento</th>
                                    <th scope="col" class="px-6 py-4 w-48 font-bold">Fecha de Realización</th>
                                    <th scope="col" class="px-6 py-4 w-40 text-center font-bold print:hidden">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                <?php $cont = 1; foreach ($submissions as $submission): ?>
                                <tr class="hover:bg-blue-50/30 transition-colors">
                                    <td class="px-6 py-4 text-center font-bold text-blue-600">
                                        <?= $cont ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-800 text-[15px]">
                                            <?= esc($submission['questionnaire_title']) ?>
                                        </div>
                                        <span class="text-xs text-gray-400 flex items-center mt-1">
                                            <i class="fa-solid fa-check-circle text-green-500 mr-1"></i> Seguimiento completado
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center font-medium text-gray-700">
                                            <i class="fa-regular fa-calendar-days mr-2 text-blue-400"></i>
                                            <?= date('d-m-Y', strtotime($submission['submitted_at'])) ?>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center print:hidden">
                                        <div class="flex justify-center gap-2">
                                            <a href="<?= base_url("admin/submission/view/{$submission['submission_id']}"); ?>"
                                               class="inline-flex items-center justify-center w-9 h-9 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 hover:scale-105 transition-all"
                                               title="Ver Detalles" data-bs-toggle="tooltip">
                                                <i class="fa-solid fa-eye text-[15px]"></i>
                                            </a>
                                            <a href="<?= base_url("admin/submission/edit/{$submission['submission_id']}"); ?>"
                                               class="inline-flex items-center justify-center w-9 h-9 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 hover:scale-105 transition-all"
                                               title="Editar / Corregir" data-bs-toggle="tooltip">
                                                <i class="fa-solid fa-pen-to-square text-[15px]"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $cont++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</main>

<style>
    @media print {
        .print\:hidden {
            display: none !important;
        }
        body {
            background-color: white !important;
        }
        main {
            margin-left: 0 !important;
            padding: 0 !important;
        }
        .shadow-xl {
            box-shadow: none !important;
            border: 1px solid #eee !important;
        }
    }
</style>

<script>
    function printKardex(idDiv) {
        const content = document.getElementById(idDiv).innerHTML;
        const iframe = document.createElement('iframe');
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
                    <title>Kardex - <?= esc($beneficiary['beneficiary_names']) ?> <?= esc($beneficiary['beneficiary_lastnames']) ?></title>
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
                    <script src="https://cdn.tailwindcss.com"><\/script>
                    <style>
                        body { background: white; padding: 20px; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
                        .print\\:hidden { display: none !important; }
                        .bg-slate-50\\/50 { background-color: #f8fafc !important; }
                    </style>
                </head>
                <body>
                    ${content}
                </body>
            </html>
        `);
        doc.close();

        iframe.contentWindow.onload = function() {
            setTimeout(() => {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
                document.body.removeChild(iframe);
            }, 1000); // Esperar un poco más para asegurar carga de estilos/iconos
        };
    }
</script>

<?= $this->endSection() ?>