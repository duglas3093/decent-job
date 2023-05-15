<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-2/2 px-3 mb-2 md:mb-0">
        <?php if(isset($activity)): ?><input type="hidden" name="activity_id" id="activity_id" value="<?= $activity['activity_id'] ?>"><?php endif; ?>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="activity_name">
            Actividad
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.activity_name') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="activity_name" name="activity_name" type="text" placeholder="Nombre(s)" value="<?= old('activity_name') ?? (!isset($activity) ? "":"{$activity['activity_name']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.activity_name') ?></p>
    </div>
    <div class="w-full md:w-2/2 px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="activity_description">
            Descripción
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.activity_description') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="activity_description" name="activity_description" type="text" placeholder="Descripción del area" value="<?= old('activity_description') ?? (!isset($activity) ? "":"{$activity['activity_description']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.activity_description') ?></p>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <?php if (isset($activity)): ?>
    <div class="w-full md:w-1/3 px-3 mb-2 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status_id">
            Estado
        </label>
        <div class="relative">
            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="status_id" name="status_id">
                <?php foreach ($status as $state): ?>
                <option value="<?= $state['status_id'] ?>" <?= $activity['status_id'] == $state['status_id'] ? "selected":"" ?>><?= $state['status_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
</div>
<div class="flex flex-wrap -mx-3 mb-2 mt-5">
    <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <?= isset($activity) ? "Actualizar":"Guardar"?>
        </button>
        <a href="javascript:history.back()" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cancelar
        </a>
    </div>
</div>
