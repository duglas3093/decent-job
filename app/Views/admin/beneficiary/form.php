<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
        <?php if(isset($beneficiary)): ?><input type="hidden" name="beneficiary_id" id="beneficiary_id" value="<?= $beneficiary['beneficiary_id'] ?>"><?php endif; ?>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_name">
            Nombre(s)
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_name') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="beneficiary_name" name="beneficiary_name" type="text" placeholder="Nombre(s)" value="<?= old('beneficiary_name') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_name']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_name') ?></p>
    </div>
    <div class="w-full md:w-1/2 px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_lastname">
            Apellido(s)
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_lastname') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="beneficiary_lastname" name="beneficiary_lastname" type="text" placeholder="Apellido(s)" value="<?= old('beneficiary_lastname') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_lastname']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_lastname') ?></p>
    </div>
    <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_ci">
            Carnet de Identidad
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_ci') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="beneficiary_ci" name="beneficiary_ci" type="number" placeholder="Canet de identidad" value="<?= old('beneficiary_ci') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_ci']}") ?>">
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
    <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_datebirth">
            Fecha de nacimiento
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_datebirth') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="beneficiary_datebirth" name="beneficiary_datebirth" type="date" placeholder="Complemento" value="<?= old('beneficiary_datebirth') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_datebirth']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_datebirth') ?></p>
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
    <div class="w-full px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_email">
            Email
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_email') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="beneficiary_email" name="beneficiary_email" type="email" placeholder="Email" value="<?= old('beneficiary_email') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_email']}") ?>" required>
            <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_email') ?></p>
    </div>
    <div class="w-full px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="beneficiary_direction">
            Dirección
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.beneficiary_direction') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="beneficiary_direction" name="beneficiary_direction" type="text" placeholder="Dirección del beneficiario" value="<?= old('beneficiary_direction') ?? (!isset($beneficiary) ? "":"{$beneficiary['beneficiary_direction']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.beneficiary_direction') ?></p>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
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
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>
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
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
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
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>
    </div>
    <?php if (isset($beneficiary)): ?>
    <div class="w-full md:w-1/3 px-3 mb-2 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status_id">
            Estado
        </label>
        <div class="relative">
            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="status_id" name="status_id">
                <?php foreach ($status as $state): ?>
                <option value="<?= $state['status_id'] ?>" <?= $beneficiary['status_id'] == $state['status_id'] ? "selected":"" ?>><?= $state['status_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
</div>
<div class="flex flex-wrap -mx-3 mb-2 mt-5">
    <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <?= isset($beneficiary) ? "Actualizar":"Guardar"?>
        </button>
        <button class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cancelar
        </button>
    </div>
</div>
