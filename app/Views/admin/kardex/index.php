<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Kardex de NOMBRE_DEL_BENEFICIARIO
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <div class="w-full px-6 py-0 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl ligth:bg-slate-850 ligth:shadow-ligth-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white text-xl">KARDEX DE <?= strtoupper("{$beneficiary['beneficiary_name']} {$beneficiary['beneficiary_lastname']}") ?></h6>
                            </div>
                            <div class="absolute top-0 right-0">
                                <button onclick="printKardex('imprimir')" class="inline-block px-6 py-2.5 bg-slate-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-slate-500 hover:shadow-lg focus:bg-slate-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-slate-600 active:shadow-lg transition duration-150 ease-in-out" title="Imprimir">
                                    <i class="fa-solid fa-print"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <div class="overflow-x-auto ml-4 pr-8 pl-4 pt-4 pb-4" >
                            <div class=" rounded overflow-hidden shadow-lg">
                                <div class="px-6 py-4" id="imprimir">
                                    <div class="grid grid-cols-12 gap-0">
                                        <div class="col-start-1 col-end-8">
                                            <h6 class="font-bold text-xl mb-2"><?= strtoupper("{$beneficiary['beneficiary_name']} {$beneficiary['beneficiary_lastname']}") ?></h6>
                                        </div>
                                        <div class="col-start-9 col-end-12 ...">
                                            <span class="font-bold text-md">Edad: </span>
                                            <?= ((new DateTime(date("Y-m-d")))->diff(new DateTime($beneficiary['beneficiary_datebirth'])))->y ?> Años
                                        </div>
                                        <div class="col-start-1 col-span-8 ">
                                            <span class="font-bold text-md">C.I.: </span>
                                            <?= "{$beneficiary['beneficiary_ci']} {$beneficiary['beneficiary_complement']}" ?>
                                        </div>
                                        <!-- <div class="col-start-9 col-end-12 ">
                                            <span class="font-bold text-md">REF: </span>
                                            ...
                                        </div> -->
                                        <div class="col-start-1 col-span-12 ">
                                            <span class="font-bold text-md">CEL.: </span>
                                            <?= $beneficiary['beneficiary_celphone'] ?>
                                        </div>
                                        <div class="col-start-1 col-end-12 ">
                                            <span class="font-bold text-md">FECHA DE INGRESO: </span>
                                            <?= date('d-m-Y', strtotime($beneficiary['created_at'])) ?>
                                        </div>
                                        <div class="col-start-1 col-end-9 ">
                                            <span class="font-bold text-md">CORREO: </span>
                                            <?= $beneficiary['beneficiary_email'] ?>
                                        </div>
                                        <div class="col-start-9 col-end-12 ">
                                            <span class="font-bold text-md">CIUDAD: </span>
                                            <?= $beneficiary['city_name'] ?>
                                        </div>
                                        <div class="col-start-9 col-end-12 ">
                                            <span class="font-bold text-md">DIRECCION: </span>
                                            <?= $beneficiary['beneficiary_direction'] ?>
                                        </div>
                                        <div class="col-start-9 col-end-12 ">
                                            <span class="font-bold text-md">HORARIO: </span>
                                            <?= $beneficiary['schedule_description'] ?>
                                        </div>
                                        <div class="col-start-9 col-end-12 ">
                                            <span class="font-bold text-md">DIAS DE TRABAJO: </span>
                                            <?php 
                                                $diasSemana = $beneficiary['beneficiary_days'];

                                                $reemplazo = array(
                                                    '1' => 'lunes',
                                                    '2' => 'martes',
                                                    '3' => 'miércoles',
                                                    '4' => 'jueves',
                                                    '5' => 'viernes',
                                                    '6' => 'sabado',
                                                    '7' => 'domingo',
                                                );
                                                
                                                $diasSemana = str_replace(array_keys($reemplazo), $reemplazo, $diasSemana);
                                                
                                                $diasSemana = rtrim($diasSemana, ',');
                                                
                                                echo $diasSemana;
                                            ?>
                                        </div>
                                        <div class="col-start-2 col-end-12 ">
                                            <span class="font-bold text-md">QUIERE: </span>
                                            <?= $beneficiary['beneficiary_entrepreneurship'] == 1 ? "Ayuda con su emprendimiento<br>":"" ?>
                                            <?= $beneficiary['beneficiary_job'] == 1 ? "Ayuda a buscar trabajo":"" ?>
                                        </div>
                                        <?php if($beneficiary['beneficiary_entrepreneurship'] == 1): ?>
                                            <div class="col-start-2 col-end-12 ">
                                                <span class="font-bold text-md">IDEA DE NEGOCIO: </span>
                                                <?= $beneficiary['beneficiary_business'] ?>
                                            </div>
                                            <div class="col-start-2 col-end-12 ">
                                                <span class="font-bold text-md">HABILIDADES: </span>
                                                <?= $beneficiary['beneficiary_skills'] ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($beneficiary['beneficiary_job'] == 1): ?>
                                            <div class="col-start-2 col-end-12 ">
                                                <span class="font-bold text-md">EXPERIENCIA LABORAL: </span>
                                                <?= $beneficiary['beneficiary_experience'] ?>
                                            </div>
                                            <div class="col-start-2 col-end-12 ">
                                                <span class="font-bold text-md">DESEO: </span>
                                                <?= $beneficiary['beneficiary_workarea'] ?>
                                            </div>
                                            <div class="col-start-2 col-end-12 ">
                                                <span class="font-bold text-md">NO DESEO: </span>
                                                <?= $beneficiary['beneficiary_notworkarea'] ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-start-2 col-end-12 ">
                                            <span class="font-bold text-md">ULTIMO GRADO/PROFESION: </span>
                                            <?= $beneficiary['beneficiary_grade'] ?>
                                        </div>
                                        </div>
                                        <!-- <div class="col-start-2 col-end-12 ">
                                            <span class="font-bold text-md">OBSERVACIONES: </span>
                                            ...
                                        </div> -->
                                        <div class="col-start-2 col-end-12 ">
                                            <span class="font-bold text-md">MEDIO POR EL QUE CONOCIO EL PROYECTO: </span>
                                            <?= $beneficiary['sm_name'] ?>
                                        </div>
                                    </div>
                                    <div class="grid gap-0 mt-5 mb-5">
                                        <div class="col-start-1 col-end-12">
                                            <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-gray-500 order-table table ">
                                                <thead>
                                                    <tr>
                                                        <th class="px-3 py-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-gray-400 opacity-70">
                                                            #
                                                        </th>
                                                        <th class="px-6 py-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-gray-400 opacity-70">
                                                            AREA
                                                        </th>
                                                        <th class="px-6 py-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-gray-400 opacity-70">
                                                            FECHA
                                                        </th>
                                                        <th class="px-6 py-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-gray-400 opacity-70">
                                                            ACTIVIDAD
                                                        </th>
                                                        <th class="px-6 py-2 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-gray-400 opacity-70">
                                                            DESCRIPCIÓN
                                                        </th>
                                                        <th class="px-6 py-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-gray-400 opacity-70">
                                                            ESTADO
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $cont = 1;
                                                        foreach ($activities as $activity): 
                                                    ?>
                                                    <tr>
                                                        <td class="align-middle bg-transparent border-b shadow-transparent whitespace-normal">
                                                            <?= $cont ?>
                                                        </td>
                                                        <td class="align-middle bg-transparent border-b shadow-transparent whitespace-normal">
                                                            <?= $activity['area_name'] ?>
                                                        </td>
                                                        <td class="align-middle bg-transparent border-b shadow-transparent">
                                                            <?= $created = date('d-m-Y', strtotime($activity['created_at'])) ?>
                                                        </td>
                                                        <td class="align-middle bg-transparent border-b shadow-transparent whitespace-normal">
                                                            <?= $activity['support_name'] ?>
                                                        </td>
                                                        <td class="align-middle bg-transparent border-b shadow-transparent whitespace-normal">
                                                            <?= $activity['detkar_description'] ?>
                                                        </td>
                                                        <td class="align-middle bg-transparent border-b shadow-transparent whitespace-normal">
                                                            <?= $activity['status_name'] ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        $cont++; 
                                                        endforeach; 
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function printKardex(idDiv) {
        const printWindow = window.open('', '_blank');
        const contentDiv = document.getElementById(idDiv).outerHTML
        const contentHTML = `
                            <html>
                                <head>
                                <title>Imprimir</title>
                                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
                                <style>
                                    /* Agrega estilos personalizados si es necesario */
                                </style>
                                </head>
                                <body>
                                ${contentDiv}
                                </body>
                            </html>
                            `;

        printWindow.document.open();
        printWindow.document.write(contentHTML);
        printWindow.document.close();

        setTimeout(function() {
            printWindow.print();
            printWindow.close();
        }, 500);
    }
</script>
<?= $this->endSection() ?>