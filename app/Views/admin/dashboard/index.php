<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1 -->
            <div class="flex flex-wrap -mx-3">
                <!-- card1 -->
                <div class="w-full max-w-full px-1 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/5">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl Light:bg-slate-850 Light:shadow-Light-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                            <p class="mb-0 font-sans text-xs font-semibold leading-normal uppercase Light:text-white Light:opacity-60">Beneficiarios</p>
                            <h5 class="mb-2 font-bold Light:text-white"><span id="total_beneficiaries"><?= $beneficiary['total_beneficiaries'] ?></span> </h5>
                            <!-- <p class="mb-0 Light:text-white Light:opacity-60">
                                <span class="text-xs font-bold leading-normal text-emerald-500">+55%</span>
                                since yesterday
                            </p> -->
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                <i class="leading-none fa-solid fa-users text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- card2 -->
                <div class="w-full max-w-full px-1 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/5">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl Light:bg-slate-850 Light:shadow-Light-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                            <p class="mb-0 font-sans text-xs font-semibold leading-normal uppercase Light:text-white Light:opacity-60">No asignados</p>
                            <h5 class="mb-2 font-bold Light:text-white"><span id="notAssigned"><?= $beneficiary['total_beneficiaries'] - $beneficiary['one_area'] - $beneficiary['two_areas'] - $beneficiary['more_two_areas'] ?></span></h5>
                            <!-- <p class="mb-0 Light:text-white Light:opacity-60">
                                <span class="text-xs font-bold leading-normal text-emerald-500">+3%</span>
                                since last week
                            </p> -->
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-gray-600 to-white-600">
                            <i class="leading-none fa-solid fa-user text-lg relative top-3.5 text-white"></i>
                            <i class=""></i>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="w-full max-w-full px-1 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/5">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl Light:bg-slate-850 Light:shadow-Light-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                            <p class="mb-0 font-sans text-xs font-semibold leading-normal uppercase Light:text-white Light:opacity-60">En una area</p>
                            <h5 class="mb-2 font-bold Light:text-white"><span id="one_area"><?= $beneficiary['one_area'] ?></span></h5>
                            <!-- <p class="mb-0 Light:text-white Light:opacity-60">
                                <span class="text-xs font-bold leading-normal text-emerald-500">+3%</span>
                                since last week
                            </p> -->
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                            <i class="leading-none fa-solid fa-user text-lg relative top-3.5 text-white"></i>
                            <i class=""></i>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- card3 -->
                <div class="w-full max-w-full px-1 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/5">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl Light:bg-slate-850 Light:shadow-Light-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-xs font-semibold leading-normal uppercase Light:text-white Light:opacity-60">En 2 Areas</p>
                                        <h5 class="mb-2 font-bold Light:text-white"><span id="two_areas"><?= $beneficiary['two_areas'] ?></span></h5>
                                        <!-- <p class="mb-0 Light:text-white Light:opacity-60">
                                            <span class="text-xs font-bold leading-normal text-red-600">-2%</span>
                                            since last quarter
                                        </p> -->
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                    <i class="leading-none fa-solid fa-user-group text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/5">
                    <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl Light:bg-slate-850 Light:shadow-Light-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                    <p class="mb-0 font-sans text-xs font-semibold leading-normal uppercase Light:text-white Light:opacity-60">Más de 2 areas</p>
                                    <h5 class="mb-2 font-bold Light:text-white"><span id="more_two_areas"><?= $beneficiary['more_two_areas'] ?></span></h5>
                                    <!-- <p class="mb-0 Light:text-white Light:opacity-60">
                                        <span class="text-xs font-bold leading-normal text-emerald-500">+5%</span>
                                        than last month
                                    </p> -->
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                                    <i class="leading-none fa-solid fa-user-plus text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full max-w-full px-3 mt-0 lg:w-12/12 lg:flex-none">
                    <div class="border-black/12.5 Light:bg-slate-850 Light:shadow-Light-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                        <p class="mb-0 font-sans text-md font-semibold leading-normal uppercase Light:text-white Light:opacity-60">Beneficiarios</p>
                    </div>
                    <div class="flex-auto p-4">
                        <div id="contenedor" style="width: 100%; height: 300px;">
                        <canvas id="grafico"></canvas>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </main>    

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contenedor = document.getElementById('contenedor');
            const canvas = document.getElementById('grafico');
            const ctx = canvas.getContext('2d');
            let grafico;

            
            let oneArea = document.getElementById('one_area').innerText;
            let twoArea = document.getElementById('two_areas').innerText;
            let moreTwoArea = document.getElementById('more_two_areas').innerText;
            let totalBeneficiaries = document.getElementById('total_beneficiaries').innerText;
            let notAssigned = document.getElementById('notAssigned').innerText;

            // console.log(notAssigned)

            function actualizarTamanio() {
                canvas.width = contenedor.clientWidth;
                canvas.height = contenedor.clientHeight;
                grafico.update();
            }

            function crearGrafico() {
                const datos = {
                labels: ['No asignados','En una area', 'En dos areas', 'En más de 2 areas'],
                datasets: [{
                    data: [notAssigned,oneArea, twoArea, moreTwoArea],
                    backgroundColor: ['#bbb','#ff6384', '#36a2eb', '#ffce56']
                }]
                };

                const opciones = {
                    // Asegura que el gráfico se ajuste automáticamente al tamaño del contenedor
                    responsive: true,

                    // Mantén el aspect ratio del gráfico
                    maintainAspectRatio: false
                };

                grafico = new Chart(ctx, {
                type: 'pie',
                data: datos,
                options: opciones
                });

                actualizarTamanio();
            }

            window.addEventListener('resize', actualizarTamanio);
            crearGrafico();
        });

    </script>
    
<?= $this->endSection() ?>