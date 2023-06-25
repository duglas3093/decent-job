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
                                            Area<span class="text-red-600">*</span>
                                        </label>
                                        <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="area" id="area">
                                            <option value="0">-- Todas --</option>
                                            <?php foreach ($report_areas as $rarea): ?>
                                            <option value="<?= $rarea['area_id'] ?>"><?= $rarea['area_description'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="ml-2 mr-2">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date_ini">
                                            Fecha ini.<span class="text-red-600">*</span>
                                        </label>
                                        <input class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="date_ini" id="date_ini" type="date"/>
                                    </div>
                                    <div class="ml-2 mr-2">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date_end">
                                            Fecha fin.
                                        </label>
                                        <input class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="date_end" id="date_end" type="date"/>
                                    </div>
                                    <div class="ml-2 mr-2">
                                        <button onclick="getReport()" class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">
                                            <!-- <i class="fa-solid fa-plus"></i>  -->
                                            GENERAR REPORTE 
                                        </button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-5 pb-2 mt-16">
                        <div class="p-3 overflow-x-auto content-end ">
                            <button onclick="exportToXlsx()" class="float-right ml-1 mr-1 inline-block px-6 py-2.5 bg-green-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-500 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-600 active:shadow-lg transition duration-150 ease-in-out" title="Exportar a excel">
                                <i class="fa-solid fa-file-excel"></i>
                            </button>
                            <button onclick="printKardex('imprimir')" class="float-right ml-1 mr-1 inline-block px-6 py-2.5 bg-slate-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-slate-500 hover:shadow-lg focus:bg-slate-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-slate-600 active:shadow-lg transition duration-150 ease-in-out" title="Imprimir">
                                <i class="fa-solid fa-print"></i>
                            </button>
                        </div>
                        <div class="p-3 overflow-x-auto" id="imprimir">
                            <h6 class="ligth:text-white text-xl text-center">REPORTE DE AREA <span id="area_report"></span></h6>
                            <p class="text-center">Desde <span id="report_date_init"></span> al <span id="report_date_end"></span></p>
                            <table id="report" class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table">
                                <thead class="align-bottom">
                                    <tr class="">
                                        <th class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 whitespace-normal">
                                            #
                                        </th>
                                        <th class="px-3 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            NOMBRE
                                        </th>
                                        <th class="px-3 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 whitespace-normal">
                                            TIPO<br>BENEFICIARIO
                                        </th>
                                        <th class="px-3 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 whitespace-normal">
                                            ACTUALIZADO
                                        </th>
                                        <th class="px-3 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 whitespace-normal">
                                            TIPO
                                        </th>
                                        <th class="px-3 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 whitespace-normal">
                                            ESTADO
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
<script src="https://cdn.sheetjs.com/xlsx-0.19.3/package/dist/xlsx.full.min.js"></script>
<script>
    function exportToXlsx(){
        let areaId = document.getElementById('area');

        const tabla = document.getElementById("report");
    
        const workbook = XLSX.utils.table_to_book(tabla);
    
        XLSX.writeFile(workbook, `${areaId.options[areaId.selectedIndex].textContent}.xlsx`); 
    }
</script>
<script>
    function validar(id) {
        if ($(`#${id}`).val().length == 0) {
            alert('Los valores marcados con * deben estar llenos para realizar la consulta');
            return false;
        }else{
            return true;
        }
    }

    function dateFormat(date){
        if(date == ''){
            const newDate = new Date();

            let year = newDate.getFullYear();
            let month = newDate.getMonth() + 1 >= 10 ? newDate.getMonth() + 1 : "0"+(newDate.getMonth() + 1);
            let day = newDate.getDate();

            return `${day}-${month}-${year}`;
        }
        
        const partesFecha = date.split("-");
        let year = partesFecha[0];
        let month = partesFecha[1];
        let day = partesFecha[2];

        return `${day}-${month}-${year}`;
    }

    function getReport() {
        
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/get_report`;
        let html = ``;
        if(validar('date_ini') || validar('area')){
            let areaId = document.getElementById('area'); 
            let area = areaId.value;
            let dateInit = document.getElementById('date_ini').value
            let dateEnd = document.getElementById('date_end').value

            document.getElementById('area_report').textContent = " - "+areaId.options[areaId.selectedIndex].textContent;
            document.getElementById('report_date_init').textContent = dateFormat(dateInit);
            document.getElementById('report_date_end').textContent =  dateFormat(dateEnd);

            $.ajax({
                type: "POST",
                url: controller,
                data: {
                    area:area,
                    dateInit:dateInit,
                    dateEnd:dateEnd,
                },
                success: (result)=>{
                    let results = JSON.parse(result);
                    let cont = 1;
                    
                    if (results.length > 0) {
                        results.map( result => {
                            let name = result.beneficiary_name
                            let datesReport = formatDates(result.updated.split('<br>'))
                            html += `
                                <tr>
                                    <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-normal shadow-transparent">
                                        ${cont}
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                        ${(result.beneficiary_name + result.beneficiary_lastname).toUpperCase()} <br>
                                        <p class="mb-0 text-xs leading-tight ligth:git text-black ligth:opacity-80 text-slate-400">
                                            CI:${result.carnet}
                                        </p>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-normal shadow-transparent">
                                        ${result.tbeneficiary}
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-normal shadow-transparent">
                                        ${datesReport}
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-normal shadow-transparent content-end">
                                        <div class="grid justify-items-center">${result.tipo}</div>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-normal shadow-transparent">
                                        ${ result.status }
                                    </td>
                                </tr>
                            `
                            cont++
                        })
                    }else{
                        html += `
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                        
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                        
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent content-end">
                                        No se encontraron datos en ese rango o esa area.
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                        
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                        
                                    </td>
                                </tr>
                            `
                    }
                    $('#report_table').html(html);
                },
                error: (error)=>{}
            })
        }else{
            console.log("no entra");
        }
    }

    function formatDates(dates){
        let newFormatDate = ``;
        for (let i = 0; i < dates.length; i++) {
            let date = new Date(dates[i]);
            let day = date.getDate() >= 10 ? date.getDate() : "0"+date.getDate();
            let month = date.getMonth() + 1 >= 10 ? date.getMonth() + 1 : "0"+(date.getMonth()+1);
            let formattedDate = day + "-" + month + "-" + date.getFullYear();
            newFormatDate += formattedDate + "<br>";
        }
        return newFormatDate;
    }

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