<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Reportes
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('admin/search/script') ?>
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <input type="hidden" value="<?= base_url(); ?>" id="base_url">
    <div class="w-full px-6 py-2 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl ligth:bg-slate-850 ligth:shadow-ligth-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <?php if((session('msg'))): ?>
                            <div class="bg-<?= session('msg.type') ?>-100 border border-<?= session('msg.type') ?>-400 text-<?= session('msg.type') ?>-700 px-4 py-3 rounded relative mb-2" role="alert">
                                <span class="block sm:inline"><?= session('msg.body ') ?></span>
                            </div>
                        <?php endif ?>
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white text-xl">Reporte</h6>
                                <div class="flex justify-center">
                                    <div class="ml-2 mr-2">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area">
                                            Area
                                        </label>
                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="area" id="area" onChange="getReport()">
                                            <option value="0">-- Todas --</option>
                                            <?php foreach ($report_areas as $rarea): ?>
                                            <option value="<?= $rarea['area_id'] ?>"><?= $rarea['area_description'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="ml-2 mr-2">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="vulnerability">
                                            Vulnerabilidades
                                        </label>
                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="vulnerability" id="vulnerability" onChange="getReport()">
                                            <option value="0">-- Todas --</option>
                                            <?php foreach ($vulnerabilities as $vulnerability): ?>
                                            <option value="<?= $vulnerability['vulnerability_id'] ?>"><?= $vulnerability['vulnerability_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="ml-2 mr-2">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="support">
                                            Ayuda
                                        </label>
                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="support" id="support" onChange="getReport()">
                                            <option value="0">-- Todas --</option>
                                            <?php foreach ($supports as $support): ?>
                                            <option value="<?= $support['support_id'] ?>"><?= $support['support_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="ml-2 mr-2">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date_ini">
                                            Fecha ini.
                                        </label>
                                        <input class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="date_ini" id="date_ini" type="date" onChange="getReport()"/>
                                    </div>
                                    <div class="ml-2 mr-2">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date_end">
                                            Fecha fin.
                                        </label>
                                        <input class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="date_end" id="date_end" type="date" onChange="getReport()"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-5 pb-2 mt-16">
                        <div class="p-3 overflow-x-auto">
                            <table id="report" class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table">
                                <thead class="align-bottom">
                                    <tr class="">
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            NOMBRE-edad
                                            ci-ciudad
                                        </th>
                                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            TIPO
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            TIPO/APOLLO
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            ESTADO
                                        </th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none ligth:border-white/40 ligth:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="report_table"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function getReport() {
        let area = document.getElementById('area').value;
        let vulnerability = document.getElementById('vulnerability').value;
        let support = document.getElementById('support').value;
        // let company = document.getElementById('company').value;
        let dateInit = document.getElementById('date_ini').value
        let dateEnd = document.getElementById('date_end').value

        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/get_report`;
        let html = ``;
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                area:area,
                vulnerability:vulnerability,
                support:support,
                dateInit:dateInit,
                dateEnd:dateEnd,
            },
            success: (result)=>{
                let report = JSON.parse(result);
            },
            error: (error)=>{}
        })
    }

    function imprimirDiv(idDiv) {
        // Crea una nueva ventana de impresión
        const ventanaImpresion = window.open('', '_blank');

        // Obtiene el contenido del div que se desea imprimir
        const contenidoDiv = document.getElementById(idDiv).outerHTML;

        // Construye el HTML completo con los estilos de Tailwind CSS
        const contenidoHTML = `
            <html>
            <head>
                <title>Imprimir</title>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
                <style>
                /* Agrega estilos personalizados si es necesario */
                </style>
            </head>
            <body>
                ${contenidoDiv}
            </body>
            </html>
        `;

        // Escribe el contenido HTML en la ventana de impresión
        ventanaImpresion.document.open();
        ventanaImpresion.document.write(contenidoHTML);
        ventanaImpresion.document.close();

        // Espera un momento antes de imprimir para asegurar que los estilos se apliquen correctamente
        setTimeout(function() {
            ventanaImpresion.print();
            ventanaImpresion.close();
        }, 500);
    }

</script>
<?= $this->endSection() ?>