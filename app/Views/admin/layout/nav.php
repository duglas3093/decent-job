<div class="absolute w-full bg-blue-500 Light:hidden min-h-75"></div>
<!-- sidenav  -->
<aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl Light:shadow-none Light:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0" aria-expanded="false">
    <div class="h-19">
        <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times Light:text-white text-slate-400 xl:hidden" sidenav-close></i>
        <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap Light:text-white text-slate-700" href="https://demos.creative-tim.com/argon-dashboard-tailwind/pages/dashboard.html" target="_blank">
        <img src="<?=base_url('img/LOGO-TRABAJO-DIGNO.jpeg')?>" class="inline h-full max-w-full transition-all duration-200 Light:hidden ease-nav-brand max-h-8" alt="main_logo" />
        <!-- <img src="<?=base_url('img/logo-ct.png')?>" class="hidden h-full max-w-full transition-all duration-200 Light:inline ease-nav-brand max-h-8" alt="main_logo" /> -->
        <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Trabajo Digno</span>
        </a>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent Light:bg-gradient-to-r Light:from-transparent Light:via-white Light:to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
            <li class="mt-0.5 w-full">
                <a class="py-2.7 bg-blue-500/13 Light:text-white Light:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="<?= base_url('admin/dashboard') ?>">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-blue-500 ni ni-tv-2"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Dashboard</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" Light:text-white Light:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('admin/beneficiary') ?>">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    <!-- <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-calendar-grid-58"></i>     -->
                    <i class="relative top-0 text-sm leading-normal text-orange-500 fa-solid fa-users"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Beneficiarios</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" Light:text-white Light:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="../pages/billing.html">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current stroke-0 text-center xl:p-2.5 ">
                    <!-- <i class="relative top-0 text-sm leading-normal text-emerald-500 ni ni-credit-card"></i> -->
                    <i class="relative top-0 text-sm leading-normal text-emerald-500 fa-solid fa-person-breastfeeding"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Areas</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" Light:text-white Light:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('admin/report') ?>">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-cyan-500 fa-solid fa-laptop-file"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Reportes</span>
                </a>
            </li>

            <!-- <li class="mt-0.5 w-full">
                <a class=" Light:text-white Light:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="../pages/rtl.html">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-red-600 ni ni-world-2"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">RTL</span>
                </a>
            </li> -->

            <li class="w-full mt-4">
                <h6 class="pl-6 ml-2 text-xs font-bold leading-tight uppercase Light:text-white opacity-60">Configuraci&oacute;n</h6>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" Light:text-white Light:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('admin/areas') ?>">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-cyan-500 ni ni-collection"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Areas</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" Light:text-white Light:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('admin/suport') ?>">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-orange-500 ni ni-single-copy-04"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Apoyo</span>
                </a>
            </li>

            <li class="mt-0.5 w-full">
                <a class=" Light:text-white Light:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors" href="<?= base_url('admin/user') ?>">
                <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                    <i class="relative top-0 text-sm leading-normal text-slate-700 ni ni-single-02"></i>
                </div>
                <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Usuarios</span>
                </a>
            </li>
        </ul>
    </div>

    
</aside>
<!-- end sidenav -->
