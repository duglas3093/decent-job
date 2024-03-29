<?= $this->extend('users/layout/main') ?>

<?= $this->section('title') ?>
Formulario de Inscripción
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl ligth:bg-slate-850 ligth:shadow-ligth-xl rounded-2xl bg-clip-border md:mr-20 md:ml-20 md:mt-5">
    <?php if((session('msg'))): ?>
        <div class="bg-<?= session('msg.type') ?>-100 border border-<?= session('msg.type') ?>-400 text-<?= session('msg.type') ?>-700 px-4 py-3 rounded relative mb-2" role="alert">
            <span class="block sm:inline"><?= session('msg.body ') ?></span>
        </div>
    <?php endif ?>
    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
        <div class="relative">
            <div class="absolute left-0 top-0">
                <h2 class="ligth:text-white text-3xl">Formulario de Inscripción Proyecto Trabajo Digno</h2>
            </div><br><br>
            <p>Este formulario es requisito para el apoyo en la Búsqueda de Trabajo o para el apoyo en abrir su propio Negocio y/o Emprendimiento, su información es confidencial solo para fines del Proyecto Trabajo Digno</p>
        </div>
    </div>
    <div class="flex-auto px-0 pt-0 pb-2 mt-8">
        <div class="overflow-x-auto ml-4 pr-8 pl-4 pt-2">
            <form class="w-full"  action="<?= base_url('store_postulant') ?>" method="POST" enctype="multipart/form-data">
                <!-- MultiStep Form -->
                <div id="section1">
                    <div class="pb-6 mb-5 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white text-lg">Informaci&oacute;n Personal</h6>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                            <?php if(isset($beneficiary)): ?><input type="hidden" name="beneficiary_id" id="beneficiary_id" value="<?= $beneficiary['beneficiary_id'] ?>"><?php endif; ?>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_name">
                                Nombre(s)<span class="text-red-600 ">*</span>
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_name') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="beneficiary_name" name="beneficiary_name" type="text" placeholder="Nombre(s)" value="<?= old('beneficiary_name') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_name']}") ?>" required>
                                <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_name') ?></p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_lastname">
                                Apellido(s)<span class="text-red-600 ">*</span>
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_lastname') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="beneficiary_lastname" name="beneficiary_lastname" type="text" placeholder="Apellido(s)" value="<?= old('beneficiary_lastname') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_lastname']}") ?>" required>
                                <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_lastname') ?></p>
                        </div>
                        <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_ci">
                                Carnet de Identidad<span class="text-red-600 ">*</span>
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_ci') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="beneficiary_ci" name="beneficiary_ci" type="number" placeholder="Canet de identidad" value="<?= old('beneficiary_ci') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_ci']}") ?>" required>
                                <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_ci') ?></p>
                        </div>
                        <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_complement">
                                Complemento
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_complement') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="beneficiary_complement" name="beneficiary_complement" type="text" placeholder="Complemento" value="<?= old('beneficiary_complement') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_complement']}") ?>">
                                <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_complement') ?></p>
                        </div>
                        <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0" style="display: flex; align-items: flex-end;">
                            <div>
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_datebirth">
                                    Fecha de nacimiento<span class="text-red-600 ">*</span> 
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_datebirth') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                    id="beneficiary_datebirth" name="beneficiary_datebirth" type="date" placeholder="Complemento" value="<?= old('beneficiary_datebirth') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_datebirth']}") ?>" onchange="calculateAge()" require 
                                    >
                                    <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_datebirth') ?></p>
                            </div>
                            <div class="ml-5">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_datebirth">
                                    Edad
                                </label>
                                <input id="age" name="age" type="text" value="0" disabled style="border:0">
                            </div>
                        </div>
                        <div class="w-full md:w-1/4 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_celphone">
                                Celular
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_beneficiary_celphone') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="beneficiary_celphone" name="beneficiary_celphone" type="number" placeholder="Número de celular" value="<?= old('beneficiary_celphone') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_celphone']}") ?>">
                                <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_celphone') ?></p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-2/4 px-3 mb-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_email">
                                Correo Electronico
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_email') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="beneficiary_email" name="beneficiary_email" type="email" placeholder="Email" value="<?= old('beneficiary_email') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_email']}") ?>" 
                                >
                                <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_email') ?></p>
                        </div>
                        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city_id">
                                Ciudad
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="city_id" name="city_id">
                                    <?php foreach ($cities as $city): ?>
                                    <option value="<?= $city['city_id'] ?>" <?= !isset($beneficiary) ? "": ($beneficiary['city_id'] == $city['city_id'] ? "selected":"") ?>><?= $city['city_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sm_id">
                                Medio por el que nos conocio
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="sm_id" name="sm_id">
                                    <?php foreach ($social_medias as $sm): ?>
                                    <option value="<?= $sm['sm_id'] ?>" <?= !isset($beneficiary) ? "": ($beneficiary['sm_id'] == $sm['sm_id'] ? "selected":"") ?>><?= $sm['sm_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full px-3 mb-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_direction">
                                Dirección
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_direction') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="beneficiary_direction" name="beneficiary_direction" type="text" placeholder="Dirección del beneficiario" value="<?= old('beneficiary_direction') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_direction']}") ?>">
                                <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_direction') ?></p>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="schedule_id">
                                Horario de trabajo
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    id="schedule_id" name="schedule_id">
                                    <?php foreach ($schedules as $schedule): ?>
                                    <option value="<?= $schedule['schedule_id'] ?>" <?= !isset($beneficiary) ? "": ($beneficiary['schedule_id'] == $schedule['schedule_id'] ? "selected":"") ?>><?= $schedule['schedule_description'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_grade">
                                Ultimo grado que curso / Profesion
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_grade') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="beneficiary_grade" name="beneficiary_grade" type="text" placeholder="Dirección del beneficiario" value="<?= old('beneficiary_grade') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_grade']}") ?>">
                                <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_grade') ?></p>
                        </div>
                        <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0 mt-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="schedule_id">
                                Días de trabajo
                            </label>
                            <div class="relative">
                                <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex ligth:bg-gray-700 ligth:border-gray-600 ligth:text-white">
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ligth:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="lunes" name="lunes" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-700 ligth:focus:ring-offset-gray-700 focus:ring-2 ligth:bg-gray-600 ligth:border-gray-500">
                                            <label for="lunes" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">LUNES</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ligth:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="martes" name="martes" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-700 ligth:focus:ring-offset-gray-700 focus:ring-2 ligth:bg-gray-600 ligth:border-gray-500">
                                            <label for="martes" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">MARTES</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ligth:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="miercoles" name="miercoles" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-700 ligth:focus:ring-offset-gray-700 focus:ring-2 ligth:bg-gray-600 ligth:border-gray-500">
                                            <label for="miercoles" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">MIERCOLES</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ligth:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="jueves" name="jueves" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-700 ligth:focus:ring-offset-gray-700 focus:ring-2 ligth:bg-gray-600 ligth:border-gray-500">
                                            <label for="jueves" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">JUEVES</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ligth:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="viernes" name="viernes" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-700 ligth:focus:ring-offset-gray-700 focus:ring-2 ligth:bg-gray-600 ligth:border-gray-500">
                                            <label for="viernes" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">VIERNES</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ligth:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="sabado" name="sabado" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-700 ligth:focus:ring-offset-gray-700 focus:ring-2 ligth:bg-gray-600 ligth:border-gray-500">
                                            <label for="sabado" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">SABADO</label>
                                        </div>
                                    </li>
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ligth:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input id="domingo" name="domingo" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-700 ligth:focus:ring-offset-gray-700 focus:ring-2 ligth:bg-gray-600 ligth:border-gray-500">
                                            <label for="domingo" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">DOMINGO</label>
                                        </div>
                                    </li>
                                    
                                </ul>

                                <!-- <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 ml-2"
                                    id="lunes" name="lunes" type="checkbox">
                                    <label for="lunes">LUNES</label>
                                <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 ml-2"
                                    id="martes" name="martes" type="checkbox">
                                    <label for="martes">MARTES</label> 
                                <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 ml-2"
                                    id="miercoles" name="miercoles" type="checkbox">
                                    <label for="miercoles">MIERCOLES</label> 
                                <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 ml-2"
                                    id="jueves" name="jueves" type="checkbox">
                                    <label for="jueves">JUEVES</label> 
                                <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 ml-2"
                                    id="viernes" name="viernes" type="checkbox">
                                    <label for="viernes">VIERNES</label> 
                                <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 ml-2"
                                    id="sabado" name="sabado" type="checkbox">
                                    <label for="sabado">SABADO</label> 
                                <input class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600 ml-2"
                                    id="domingo" name="domingo" type="checkbox">
                                    <label for="domingo">DOMINGO</label>  -->
                            </div>
                        </div>
                        <div class="w-full md:w-3/3 px-3 mb-6 md:mb-0 mt-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area_id">
                                Area a la que desea ingresar
                            </label>                            
                            <ul class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex ligth:bg-gray-700 ligth:border-gray-600 ligth:text-white">
                                <?php foreach ($areas as $area): ?>
                                <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r ligth:border-gray-600">
                                    <div class="flex items-center pl-3">
                                        <input id="area_<?= $area['area_id'] ?>" name="area_<?= $area['area_id'] ?>" onchange="showCompromise(`area_<?= $area['area_id'] ?>`)" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-700 ligth:focus:ring-offset-gray-700 focus:ring-2 ligth:bg-gray-600 ligth:border-gray-500">
                                        <label for="area_<?= $area['area_id'] ?>" class="w-full py-3 ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300"><?= $area['area_name'] ?></label>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="contactInformation" class="mt-5">
                    <div class="pb-6 mb-5 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white text-lg">Informaci&oacute;n de contacto</h6>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/3 px-3 mb-2 md:mb-0">
                            <?php if(isset($beneficiary)): ?><input type="hidden" name="beneficiary_id" id="beneficiary_id" value="<?= $beneficiary['beneficiary_id'] ?>"><?php endif; ?>
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name_contact">
                                Nombre <span class="text-red-600 ">*</span>
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_name') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="name_contact" name="name_contact" type="text" placeholder="Nombre completo" value="" required>
                                <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_name') ?></p>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-2">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone_contact">
                                Celular<span class="text-red-600 ">*</span>
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.phone_contact') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
                                id="phone_contact" name="phone_contact" type="number" placeholder="Numero de contacto" value="" required>
                                <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_lastname') ?></p>
                        </div>
                    </div>
                </div>
                <hr class="mt-5 mb-5">
                <div id="section2" style="display: none">
                    <div class="pb-6 pb-0 mb-5 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white text-lg">Compromiso con la fundación</h6>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                            <h4 class="text-xl text-center text-bold"><?= $compromises[0]['compromise_name'] ?></h4>
                            <p class="text-justify"><?= $compromises[0]['compromise_description'] ?></p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-2">
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    ¿Está usted de acuerdo con el compromiso de Emprendimiento?
                                </label>
                                <div class="flex items-center mb-4">
                                    <input id="default-radio-1" type="radio" value="1" name="beneficiary_entrepreneurship" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-800 focus:ring-2 ligth:bg-gray-700 ligth:border-gray-600">
                                    <label for="" class="ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">
                                        Si, estoy deacuerdo.
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input checked id="default-radio-2" type="radio" value="2" name="beneficiary_entrepreneurship" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-800 focus:ring-2 ligth:bg-gray-700 ligth:border-gray-600">
                                    <label for="" class="ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">
                                        No estoy deacuerdo.
                                    </label>
                                </div>
                            </div>
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_skills">
                                    Indique que habilidades tiene
                                </label>
                                <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 focus:border-gray-500 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white" id="beneficiary_skills" name="beneficiary_skills"  rows="4" placeholder="Habilidades"></textarea>
                            </div>
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_business">
                                    Explique su idea de negocio
                                </label>
                                <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_business') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white" id="beneficiary_business" name="beneficiary_business" placeholder="Idea de negocio" rows="4" ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-5 mb-5">
                <div id="section3" style="display:none">
                    <div class="pb-6 pb-0 mb-5 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="relative">
                            <div class="absolute left-0 top-0">
                                <h6 class="ligth:text-white text-lg">Compromiso con la fundación</h6>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
                            <h4 class="text-xl text-center text-bold"><?= $compromises[1]['compromise_name'] ?></h4>
                            <p class="text-justify"><?= $compromises[1]['compromise_description'] ?></p>
                        </div>
                        <div class="w-full md:w-1/2 px-3 mb-2">
                            <div class="w-full px-3 mb-3 md:mb-2">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                                    ¿Está usted de acuerdo con el compromiso de Empleabilidad?
                                </label>
                                <div class="flex items-center mb-4">
                                    <input id="default-radio-1" type="radio" value="1" name="beneficiary_job" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-800 focus:ring-2 ligth:bg-gray-700 ligth:border-gray-600">
                                    <label for="" class="ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">
                                        Si, estoy deacuerdo.
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input checked id="default-radio-2" type="radio" value="2" name="beneficiary_job" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 ligth:focus:ring-blue-600 ligth:ring-offset-gray-800 focus:ring-2 ligth:bg-gray-700 ligth:border-gray-600">
                                    <label for="" class="ml-2 text-sm font-medium text-gray-900 ligth:text-gray-300">
                                        No estoy deacuerdo.
                                    </label>
                                </div>
                            </div>
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_experience">
                                    ¿Cuál es su experiencia laboral? ¿Dónde trabajo y por cuánto tiempo en cada trabajo?
                                </label>
                                <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_experience') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white" id="beneficiary_experience" name="beneficiary_experience" placeholder="Experiencia laboral" rows="4"></textarea>
                            </div>
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_workarea">
                                    En qué áreas está buscando y que tipo de trabajo (especifique)
                                </label>
                                <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_workarea') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white" id="beneficiary_workarea" name="beneficiary_workarea" type="date" placeholder="Busco trabajo en las areas de ..." rows="4"></textarea>
                            </div>
                            <div class="w-full px-3 mb-3 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_notworkarea">
                                    En que áreas no le gustaría trabajar (especifique)
                                </label>
                                <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_notworkarea') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white" id="beneficiary_notworkarea" name="beneficiary_notworkarea" type="date" placeholder="No me gustaria trabajar en las areas de ... " rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="section4">
                    <div class="flex flex-wrap -mx-3 mb-2 mt-5 place-items-center">
                        <input type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded items-center" value="Enviar Formulario de Inscripción"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
    function changeView(ofView, forView){
        document.getElementById(ofView).style.display = 'none';
        document.getElementById(forView).style.display ='block';v                                       
    }

    function calculateAge(){
        let date = new Date(Date.now());
        let dateOfBirth = document.getElementById("beneficiary_datebirth").value
        let currentYear = date.getFullYear();
        let currentMonth = date.getMonth();
        let currentDay = date.getDay();
        let currentDate = `${currentYear}-${currentMonth}-${currentDay}`
        
        var date1 = moment(currentDate)
        var date2 = moment(dateOfBirth)

        document.getElementById("age").value = date1.diff(date2,'years')
    }

    function showCompromise(area) {
        let check = document.getElementById(area).checked
        switch (area) {
            case "area_2":
                document.getElementById("section3").style.display = check ? "block" : "none"
                break;

            case "area_3":
                document.getElementById("section2").style.display = check ? "block" : "none"
                break;
        
            default:
                break;
        }
    }

    window.onLoad = ()=>{
        calculateAge()
        showCompromise('area_2')
        showCompromise('area_3')
    }
</script>
<script src="http://momentjs.com/downloads/moment.min.js"></script>
<!-- /.MultiStep Form -->
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<?= $this->endSection() ?>