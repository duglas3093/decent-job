<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Beneficiarios
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
                                <!-- <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-<?= session('msg.type') ?>-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </span> -->
                            </div>
                        <?php endif ?>
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white text-xl">Beneficiarios: <?= count($beneficiaries) ?></h6>
                            </div>
                            <div class="absolute top-0 right-0">
                                <a href="<?= base_url("admin/add_beneficiary"); ?>" class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">
                                    <i class="fa-solid fa-plus"></i> 
                                    Agregar Beneficiario 
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
                        <?= $this->include('admin/search/input') ?>
                        <div class="p-3 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table">
                                <thead class="align-bottom">
                                    <tr class="">
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            NOMBRE
                                        </th>
                                        <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            CI
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            EDAD
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            ESTADO
                                        </th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            CIUDAD
                                        </th>
                                        <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-collapse border-solid shadow-none ligth:border-white/40 ligth:text-white tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    
                                    <?php foreach($beneficiaries as $beneficiary): ?>
                                    <tr class="uppercase">
                                        <td
                                            class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <!-- <div>
                                                    <img src="../assets/img/team-2.jpg"
                                                        class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl"
                                                        alt="user1" />
                                                </div> -->
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal ligth:text-white">
                                                        <?= $beneficiary['beneficiary_lastname'] ?> <?= $beneficiary['beneficiary_name'] ?>
                                                    </h6>
                                                    <p class="mb-0 text-xs leading-tight ligth:git text-black ligth:opacity-80 text-slate-400">
                                                        <?= $beneficiary['beneficiary_celphone'] ?> <a class="text-green-500" href="https://wa.me/+591<?= $beneficiary['beneficiary_celphone'] ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80">
                                                <?= $beneficiary['beneficiary_ci'] ?>
                                            </p>
                                        </td>
                                        <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80 text-slate-400">
                                                <?= ((new DateTime(date("Y-m-d")))->diff(new DateTime($beneficiary['beneficiary_datebirth'])))->y ?> Años
                                            </span>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="bg-gradient-to-tl <?= $beneficiary['status_name'] == 'Activo' ? "from-emerald-500 to-teal-400":"from-red-500 to-red-400" ?> px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                <?= $beneficiary['status_name'] ?>
                                            </span>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight ligth:text-white ligth:opacity-80 text-slate-400">
                                                <?= $beneficiary['city_name'] ?>
                                            </span>    
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                            <button onclick="beneficiaryArea(<?= $beneficiary['beneficiary_id'] ?>,'<?= $beneficiary['beneficiary_lastname'] ?> <?= $beneficiary['beneficiary_name'] ?>')" title="Asignar area" class="inline-block px-2 py-1.5 bg-amber-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-amber-700 hover:shadow-lg focus:bg-amber-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-amber-800 active:shadow-lg transition duration-150 ease-in-out"
                                            data-te-toggle="modal"
                                                data-te-target="#assingArea"
                                                data-te-ripple-init
                                                data-te-ripple-color="light"
                                                >
                                                <i class="fa-solid fa-circle-user"></i>
                                            </button> 
                                            <a href="<?= base_url("admin/edit_beneficiary/{$beneficiary['beneficiary_id']}") ?>" title="Editar Beneficiario" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a> 
                                            <button onclick="loadData(<?= $beneficiary['beneficiary_id'] ?>,'<?= $beneficiary['beneficiary_lastname'] ?> <?= $beneficiary['beneficiary_name'] ?>')" title="Contacto" class="inline-block px-2 py-1.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out"
                                            data-te-toggle="modal"
                                                data-te-target="#contactModal"
                                                data-te-ripple-init
                                                data-te-ripple-color="light"
                                                >
                                                <i class="fa-solid fa-address-book"></i>
                                            </button> <br>
                                            <a href="<?= base_url("admin/view_kardex_beneficiary/{$beneficiary['beneficiary_id']}") ?>" title="Ver Kardex" class="mt-1 inline-block px-2 py-1.5 bg-cyan-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-cyan-700 hover:shadow-lg focus:bg-cyan-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-cyan-800 active:shadow-lg transition duration-150 ease-in-out">
                                                <i class="fa-solid fa-book"></i>
                                            </a>
                                            <button onclick="showVulnerabilities(<?= $beneficiary['beneficiary_id'] ?>)" title="Vulnerabilidad" class="mt-1 inline-block px-2 py-1.5 bg-yellow-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-yellow-700 hover:shadow-lg focus:bg-yellow-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-yellow-800 active:shadow-lg transition duration-150 ease-in-out"
                                                        data-te-toggle="modal"
                                                            data-te-target="#vulnerability_participant"
                                                            data-te-ripple-init
                                                            data-te-ripple-color="light"
                                                            >
                                                <!-- <i class="fa-solid fa-plus"></i>  -->
                                                <i class="fa-solid fa-user-injured"></i>
                                            </button>
                                            <button onclick="inactivePostulants(<?= $beneficiary['beneficiary_id'] ?>)" title="Cambiar a estado a inactivo" class="mt-1 inline-block px-2 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">
                                                <!-- <i class="fa-solid fa-plus"></i>  -->
                                                <i class="fa-solid fa-user-slash"></i>
                                                <!-- <i class="fa-solid fa-user-injured"></i> -->
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="contactModal" tabindex="-1" aria-labelledby="titleModal" aria-modal="true" role="dialog">
    <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px]">
        <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none ligth:bg-neutral-600">
        <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 ligth:border-opacity-50">
            <h5 class="text-xl font-medium leading-normal text-neutral-800 ligth:text-neutral-200" id="titleModal"></h5>
            <!-- <button class="bg-amber-500 hover:bg-amber-700 text-white font-bold py-1 px-3 rounded mr-0" onclick="viewFormContact()" title="Nuevo contacto">
                <i class="fa-solid fa-address-book"></i>
            </button> -->
            <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            </button>
        </div>
        <div class="relative p-4">
            <div class="grid justify-items-end ...">
                <button class="bg-amber-500 hover:bg-amber-700 text-white py-1 px-3 rounded mr-0" onclick="viewFormContact()" title="Nuevo contacto">
                    <i class="fa-solid fa-address-book"></i> Nuevo contacto
                </button>
            </div>
            <div id="newContact" style="display: none;">
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-2/4 px-3 mb-2 md:mb-0">
                        <input type="hidden" name="beneficiary_id" id="beneficiary_id" value="">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_name">
                            Nombre completo<span class="text-red-600 ">*</span>
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.contact_name') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                            id="contact_name" name="contact_name" type="text" placeholder="Nombre completo" value="">
                            <p class="text-red-500 text-xs italic"></p>
                    </div>
                    <div class="w-full md:w-1/4 px-3 mb-2 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contact_phone">
                            Telefono<span class="text-red-600 ">*</span>
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.contact_phone') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                            id="contact_phone" name="contact_phone" type="number" placeholder="Numero de telefono" value="">
                            <p class="text-red-500 text-xs italic"></p>
                    </div>
                    <div class="w-full md:w-1/4 px-3 mb-2 md:mb-0 md:mt-6">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-0" onclick="saveContact()" title="Guardar contacto">
                            <i class="fa-solid fa-check"></i>
                        </button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-0" onclick="viewFormContact()" title="Cancelar">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
            <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table">
                <thead class="align-bottom">
                    <tr class="">
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            NOMBRE
                        </th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            TELEFONO
                        </th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                    </tr>
                </thead>
                <tbody id="contactTable"></tbody>
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

<div data-te-modal-init class="fixed top-0 left-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none" id="assingArea" tabindex="-1" aria-labelledby="titleModal" aria-modal="true" role="dialog">
    <div data-te-modal-dialog-ref class="pointer-events-none relative w-auto translate-y-[-50px] opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:max-w-[500px] min-[992px]:max-w-[800px]">
        <div class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none ligth:bg-neutral-600">
        <div class="flex flex-shrink-0 items-center justify-between rounded-t-md border-b-2 border-neutral-100 border-opacity-100 p-4 ligth:border-opacity-50">
            <h5 class="text-xl font-medium leading-normal text-neutral-800 ligth:text-neutral-200" id="titleModalArea"></h5>
            <button type="button" class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none" data-te-modal-dismiss aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            </button>
        </div>
        <div class="relative p-4">
            <div class="grid justify-items-end ...">
                <button class="bg-amber-500 hover:bg-amber-700 text-white py-1 px-3 rounded mr-0" onclick="viewFormArea()" title="Nuevo contacto">
                    <i class="fa-solid fa-plus"></i> Asignar Area
                </button>
            </div>
            <div id="newAreaForBeneficiary" style="display: none;">
                <div class="flex fle x-wrap -mx-3 mb-2">
                    <div class="w-full md:w-2/4 px-3 mb-2 md:mb-0">
                        <input type="hidden" name="beneficiary_id_area" id="beneficiary_id_area" value="">
                        <input type="hidden" name="last_area" id="last_area" value="">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area_id">
                            AREAS<span class="text-red-600 ">*</span>
                        </label>
                        <select
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.area_id') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                            id="area_id" name="area_id">
                            <?php foreach ($areas as $area):?>
                                <option value="<?= $area['area_id'] ?>"><?= $area['area_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                            <p class="text-red-500 text-xs italic"></p>
                    </div>
                    <div class="w-full md:w-1/4 px-3 mb-2 md:mb-0 md:mt-6">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-0" id="saveButton" onclick="saveAreaBeneficiary()" title="Guardar area">
                            <i class="fa-solid fa-check"></i>
                        </button>
                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mr-0" onclick="viewFormArea()" title="Cancelar">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
            <table class="items-center w-full mb-0 align-top border-collapse ligth:border-white/40 text-slate-500 order-table table">
                <thead class="align-bottom">
                    <tr class="">
                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            AREA
                        </th>
                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none ligth:border-white/40 ligth:text-white text-xs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70"></th>
                    </tr>
                </thead>
                <tbody id="AreaBeneficiaryTable"></tbody>
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

<script>
    function beneficiaryArea(beneficiary,beneficiaryName) {
        $('#AreaBeneficiaryTable').html("");
        let url = document.getElementById("base_url").value;
        document.getElementById("beneficiary_id_area").value = beneficiary;
        let controller = `${url}/admin/area_beneficiary`
        $.ajax({
            type: "POST",
            url: controller,
            data: {beneficiary:beneficiary},
            success: (result)=>{
                let data = JSON.parse(result)
                let beneficiaryAreas = data.areas;
                document.getElementById('titleModalArea').innerHTML = beneficiaryName.toUpperCase()
                let html;
                if(beneficiaryAreas.length > 0){
                    beneficiaryAreas.map(beneficiaryArea => {
                        html += `
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    ${beneficiaryArea.area_name}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    <button title="Editar area" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" onclick="editArea(${beneficiaryArea.area_id})">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button title="Borrar area" class="inline-block px-2 py-1.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" onclick="deleteArea(${beneficiaryArea.area_id},${data.kardex.kardex_id})">
                                        <i class="fa-solid fa-x"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    })
                }else{
                    html += `
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent content-center">
                                    El beneficiario no tiene areas asignadas
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent"></td>
                            </tr>
                        `;
                }
                $('#AreaBeneficiaryTable').html(html);
            },
            error: (error)=>{}
        })
    }

    function loadData(beneficiary,beneficiaryName) {
        $('#contactTable').html("");
        let url = document.getElementById("base_url").value;
        document.getElementById("beneficiary_id").value = beneficiary;
        let controller = `${url}/admin/contact_beneficiary`
        $.ajax({
            type: "POST",
            url: controller,
            data: {beneficiary:beneficiary},
            success: (result)=>{
                let contacts = JSON.parse(result)
                document.getElementById('titleModal').innerHTML = beneficiaryName.toUpperCase()
                let html;
                if(contacts.length > 0){
                    contacts.map(contact => {
                        html += `
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    ${contact.contact_name}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent content-end">
                                    <div class="grid justify-items-center"><div></div>${contact.contact_phone}</div></div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent">
                                    <button title="Editar Beneficiario" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    })
                }else{
                    html += `
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent"></td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent content-center">
                                    El beneficiario no tiene contactos de referencia
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b ligth:border-white/40 whitespace-nowrap shadow-transparent"></td>
                            </tr>
                        `;
                }
                $('#contactTable').html(html);
            },
            error: (error)=>{}
        })
    }

    function viewFormArea(){
        clearInputs()
        let newAreaForBeneficiary = document.getElementById('newAreaForBeneficiary').style.display;
        document.getElementById('newAreaForBeneficiary').style.display = newAreaForBeneficiary == 'none' ? 'block' : 'none';
    }

    function viewFormContact(){
        clearInputs()
        let newContact = document.getElementById('newContact').style.display;
        document.getElementById('newContact').style.display = newContact == 'none' ? 'block' : 'none';
    }

    function clearInputs(){
        // document.getElementById('beneficiary_id').value = "";
        document.getElementById('contact_name').value = "";
        document.getElementById('contact_phone').value = "";
    }

    function saveContact(){
        let beneficiary = document.getElementById('beneficiary_id').value;
        console.log(beneficiary)
        let name = document.getElementById('contact_name').value;
        console.log(name)
        let phone = document.getElementById('contact_phone').value;
        console.log(phone)
        $('#contactTable').html("");
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/store_contact`
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                beneficiary:beneficiary,
                name:name,
                phone:phone,
            },
            success: (result)=>{
                let name = document.getElementById('titleModal').innerHTML;
                loadData(beneficiary,name);
                viewFormContact();
                clearInputs();
            },
            error: (error)=>{}
        })
    }

    function closeModal() {
        // Obtén una referencia al modal
        var modal = document.getElementById("miModal");

        // Función para cerrar el modal
        function cerrarModal() {
            modal.classList.add("hidden");
        }

        // Cierra el modal después de cierto tiempo (por ejemplo, 3 segundos)
        setTimeout(cerrarModal, 3000); // Cambia el valor a la cantidad de milisegundos que desees

    }

    function saveAreaBeneficiary(){
        let beneficiary = document.getElementById('beneficiary_id_area').value;
        let area = document.getElementById('area_id').value;
        let last_area = document.getElementById('last_area').value;
        $('#AreaBeneficiaryTable').html("");
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/save_area_beneficiary`
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                beneficiary:beneficiary,
                area:area,
                last_area:last_area
            },
            success: (result)=>{
                let name = document.getElementById('titleModalArea').innerHTML;
                beneficiaryArea(beneficiary,name);
                viewFormArea();
                // document.getElementById('beneficiary_id_area').value = "";
                document.getElementById('last_area').value = "";
                document.getElementById('assingArea').checked = true;
            },
            error: (error)=>{}
        })
    }

    function editArea(area){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/edit_area_beneficiary`
        let beneficiary = document.getElementById("beneficiary_id_area").value

        document.getElementById("last_area").value = area
        document.getElementById("area_id").value = area
        viewFormArea()
        let selectElement = document.getElementById("area_id");

        for (let i = 0; i < selectElement.options.length; i++) {
            if (selectElement.options[i].value === area) {
                selectElement.options[i].selected = true;
                break; 
            }
        }
    }
    
    function deleteArea(area,kBeneficiary){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/delete_area_beneficiary`

        let beneficiary = document.getElementById('beneficiary_id_area').value;
        if (confirm("¿Esta seguro qué quiere borrar esta area?")) {
            $.ajax({
                type: "POST",
                url: controller,
                data: {
                    area:area,
                    beneficiary:beneficiary,
                    kBeneficiary:kBeneficiary
                },
                success: (result)=>{
                    let name = document.getElementById('titleModalArea').innerHTML;
                    beneficiaryArea(beneficiary,name);
                },
                error: (error)=>{}
            })
        }
    }
</script>
<script>
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
                                    <button title="Editar Beneficiario" class="inline-block px-2 py-1.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                        <i class="fa-solid fa-pencil"></i>
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
        let vulnerability = document.getElementById('vulnerability_id').value;
        let observation = document.getElementById('vulnerability_observation').value;
        $.ajax({
            type: "POST",
            url: controller,
            data: {
                beneficiary:beneficiary,
                vulnerability:vulnerability,
                observation:observation
            },
            success: (result)=>{
                showVulnerabilities(beneficiary);
                viewForm()
                document.getElementById('beneficiary_id').value = "";
                document.getElementById('vulnerability_id').value = "";
                document.getElementById('vulnerability_observation').value = "";
            },
            error: (error)=>{}
        })
    }

    function inactivePostulants(beneficiary){
        let url = document.getElementById("base_url").value;
        let controller = `${url}/admin/change_inactive`
        let message = 'Se cambiara el estado a inactivo del postulante, ¿Desea continuar?'
        if (confirm(message)) {
            $.ajax({
                type: "POST",
                url: controller,
                data: {beneficiary:beneficiary},
                success: (result)=>{
                    location.reload()
                },
                error: (error)=>{}
            })
        }
    }
</script>
<?= $this->endSection() ?>