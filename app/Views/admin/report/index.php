<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Reporte de Ejecución por Financiador
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $this->include('admin/search/script') ?>

<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <input type="hidden" value="<?= base_url(); ?>" id="base_url">
    
    <div class="w-full px-6 py-4 mx-auto">
        
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                    <div class="p-6 border-b border-gray-100">
                        <h6 class="font-bold text-slate-700 flex items-center">
                            <i class="fa-solid fa-filter mr-2 text-blue-500"></i> Filtros de Reporte
                        </h6>
                    </div>
                    <div class="flex-auto p-6">
                        <?php if((session('msg'))): ?>
                            <div class="bg-<?= session('msg.type') ?>-100 border border-<?= session('msg.type') ?>-400 text-<?= session('msg.type') ?>-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline"><?= session('msg.body') ?></span>
                            </div>
                        <?php endif ?>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="financier">
                                    Financiador <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <select class="block appearance-none w-full bg-gray-50 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-blue-500 transition-colors" name="financier" id="financier">
                                        <option value="0">-- Todos los Financiadores --</option>
                                        <?php foreach ($financiers as $financier): ?>
                                            <option value="<?= $financier['financier_id'] ?>"><?= $financier['financier_project'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date_ini">
                                    Fecha Inicio <span class="text-red-500">*</span>
                                </label>
                                <input class="block appearance-none w-full bg-gray-50 border border-gray-300 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-blue-500 transition-colors" name="date_ini" id="date_ini" type="date"/>
                            </div>

                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date_end">
                                    Fecha Fin
                                </label>
                                <input class="block appearance-none w-full bg-gray-50 border border-gray-300 text-gray-700 py-3 px-4 rounded leading-tight focus:outline-none focus:bg-white focus:border-blue-500 transition-colors" name="date_end" id="date_end" type="date"/>
                            </div>

                            <div>
                                <button onclick="getReport()" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded shadow-md hover:shadow-lg transition-all transform active:scale-95 focus:outline-none">
                                    <i class="fa-solid fa-magnifying-glass mr-2"></i> GENERAR REPORTE
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap -mx-3 hidden" id="results_container">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                    
                    <div class="p-4 border-b border-gray-100 flex justify-end gap-2 bg-gray-50 rounded-t-2xl">
                        <button onclick="exportToXlsx()" class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-xs font-bold uppercase rounded shadow hover:shadow-md transition-all">
                            <i class="fa-solid fa-file-excel mr-2"></i> Excel
                        </button>
                        <button onclick="printKardex('imprimir')" class="inline-flex items-center px-4 py-2 bg-slate-700 hover:bg-slate-800 text-white text-xs font-bold uppercase rounded shadow hover:shadow-md transition-all">
                            <i class="fa-solid fa-print mr-2"></i> Imprimir
                        </button>
                    </div>

                    <div class="p-8" id="imprimir">
                        <div class="text-center mb-8">
                            <h6 class="text-2xl font-bold text-slate-800 uppercase tracking-wide">REPORTE DE EJECUCIÓN</h6>
                            <h3 class="text-lg font-semibold text-blue-600 uppercase mt-1" id="financier_report_title"></h3>
                            <p class="text-sm text-gray-500 mt-2">
                                Periodo: <span class="font-bold text-slate-700" id="report_date_init"></span> al <span class="font-bold text-slate-700" id="report_date_end"></span>
                            </p>
                        </div>

                        <div class="overflow-x-auto">
                            <table id="report_table_dom" class="w-full text-sm text-left text-gray-500 border-collapse">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b-2 border-gray-200">
                                    <tr>
                                        <th class="px-4 py-3 text-center border">#</th>
                                        <th class="px-4 py-3 border">Nombre Completo / CI</th>
                                        <th class="px-4 py-3 text-center border">Género</th>
                                        <th class="px-4 py-3 border">Financiador / Gestión</th>
                                        <th class="px-4 py-3 text-right border">Monto Recibido</th> <th class="px-4 py-3 text-center border">Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="report_table_body">
                                    </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-8 pt-4 border-t border-gray-200 flex justify-between text-xs text-gray-400">
                            <span>Generado por Sistema Kallpa</span>
                            <span>Fecha de impresión: <script>document.write(new Date().toLocaleDateString())</script></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.sheetjs.com/xlsx-0.19.3/package/dist/xlsx.full.min.js"></script>

<script>
    // 1. VALIDACIÓN
    function validar() {
        // Financiador es opcional (value 0 = todos), pero Fechas son obligatorias para el rango
        let dateIni = document.getElementById('date_ini').value;
        
        if (!dateIni) {
            alert('Por favor seleccione al menos una Fecha de Inicio.');
            return false;
        }
        return true;
    }

    // 2. FORMATEO DE FECHA (YYYY-MM-DD a DD-MM-YYYY)
    function dateFormat(dateString){
        if(!dateString) return '---';
        const [year, month, day] = dateString.split("-");
        return `${day}/${month}/${year}`;
    }

    // 3. GENERAR REPORTE (AJAX)
    function getReport() {
        if(!validar()) return;

        let url = document.getElementById("base_url").value;
        // Asegúrate que esta ruta exista en tu Config/Routes.php
        let controller = `${url}/admin/get_report`; 
        
        let financierSelect = document.getElementById('financier');
        let financierId = financierSelect.value;
        let financierName = financierSelect.options[financierSelect.selectedIndex].text;
        
        let dateInit = document.getElementById('date_ini').value;
        let dateEnd = document.getElementById('date_end').value;

        // Mostrar encabezados
        document.getElementById('financier_report_title').textContent = financierId == '0' ? 'TODOS LOS FINANCIADORES' : financierName;
        document.getElementById('report_date_init').textContent = dateFormat(dateInit);
        document.getElementById('report_date_end').textContent = dateEnd ? dateFormat(dateEnd) : 'La fecha actual';

        // Mostrar contenedor de resultados (estaba oculto)
        document.getElementById('results_container').classList.remove('hidden');
        
        // Limpiar tabla y mostrar spinner o mensaje de carga
        let tbody = document.getElementById('report_table_body');
        tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4"><i class="fa-solid fa-circle-notch fa-spin text-blue-500"></i> Cargando datos...</td></tr>';

        $.ajax({
            type: "POST",
            url: controller,
            data: {
                financier_id: financierId, // Enviamos con el nombre correcto
                dateInit: dateInit,
                dateEnd: dateEnd
            },
            dataType: "json", // Esperamos JSON
            success: (results) => {
                let html = ``;
                
                if (results.length > 0) {
                    let cont = 1;
                    results.forEach(result => {
                        
                        // 1. Estilos para el Estado (Activo/Inactivo)
                        let estadoClass = result.status_id == 1 
                            ? 'bg-green-100 text-green-700 border-green-200' 
                            : 'bg-red-100 text-red-700 border-red-200';

                        // 2. Formato de Moneda para el monto (Ej: 500 Bs)
                        let monto = result.monto_recibido;
                        if(monto === '0' || monto === '') {
                            monto = '<span class="text-gray-300">-</span>';
                        } else {
                            monto = `<span class="font-bold text-slate-700">${monto} Bs</span>`;
                        }

                        // 3. Color de fila alternado
                        let rowClass = cont % 2 === 0 ? 'bg-gray-50' : 'bg-white';

                        html += `
                            <tr class="${rowClass} border-b hover:bg-blue-50 transition-colors">
                                
                                <td class="px-4 py-3 text-center font-bold text-slate-500">${cont}</td>
                                
                                <td class="px-4 py-3">
                                    <a href= "${url}/admin/view_kardex_beneficiary/${result.beneficiary_id}" target="_blank">
                                        <div class="font-bold text-slate-700 uppercase">
                                            ${result.beneficiary_lastnames} ${result.beneficiary_names}
                                        </div>
                                        <div class="text-xs text-slate-500 flex items-center mt-1">
                                            <i class="fa-regular fa-id-card mr-1"></i>
                                            ${result.beneficiary_ci} ${result.beneficiary_ci_extension}
                                        </div>
                                    </a>
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <span class="text-sm text-slate-600">${result.beneficiary_gender}</span>
                                </td>

                                <td class="px-4 py-3">
                                    <div class="font-semibold text-blue-600 text-xs uppercase mb-1">
                                        ${result.financier_project}
                                    </div>
                                    <div class="text-xs text-slate-500 border border-gray-200 rounded px-2 py-0.5 inline-block bg-white">
                                        Gestión: ${result.beneficiary_financier_year}
                                    </div>
                                </td>

                                <td class="px-4 py-3 text-right">
                                    ${monto}
                                </td>

                                <td class="px-4 py-3 text-center">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full border ${estadoClass}">
                                        ${result.estado_texto}
                                    </span>
                                </td>
                            </tr>
                        `;
                        cont++;
                    });
                } else {
                    html = `
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                <i class="fa-solid fa-folder-open text-3xl mb-2 text-gray-300"></i><br>
                                No se encontraron beneficiarios con esos filtros.
                            </td>
                        </tr>
                    `;
                }
                // IMPORTANTE: Asegúrate de que el ID coincida con tu HTML (ej: report_table_body)
                document.getElementById('report_table_body').innerHTML = html;
            },
            error: (xhr, status, error) => {
                console.error(error);
                tbody.innerHTML = `<tr><td colspan="6" class="text-center py-4 text-red-500">Ocurrió un error al cargar los datos.</td></tr>`;
                alert("Error en la consulta. Revise la consola.");
            }
        });
    }

    // 4. EXPORTAR A EXCEL
    function exportToXlsx(){
        let table = document.getElementById("report_table_dom");
        let financierSelect = document.getElementById('financier');
        let filename = financierSelect.options[financierSelect.selectedIndex].text.replace(/ /g, "_") + "_Reporte.xlsx";
        
        /* Crear libro de trabajo */
        let wb = XLSX.utils.table_to_book(table, {sheet: "Reporte"});
        
        /* Descargar */
        XLSX.writeFile(wb, filename); 
    }

    // 5. IMPRIMIR (Versión Iframe Robusto)
    function printKardex(idDiv) {
        const content = document.getElementById(idDiv).innerHTML;
        const iframe = document.createElement('iframe');
        
        // Estilos para ocultar el iframe
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
                    <title>Imprimir Reporte</title>
                    <script src="https://cdn.tailwindcss.com"><\/script>
                    <style>
                        body { background: white; padding: 20px; font-family: sans-serif; -webkit-print-color-adjust: exact; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
                        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                        th { background-color: #f3f4f6; font-weight: bold; text-transform: uppercase; text-align: center; }
                        .text-center { text-align: center; }
                        .font-bold { font-weight: bold; }
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
            }, 500);
        };
    }
</script>
<?= $this->endSection() ?>