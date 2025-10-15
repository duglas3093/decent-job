<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3 mb-6 md:mb-0">
        <?php if(isset($area)): ?><input type="hidden" name="area_id" value="<?= $area['area_id'] ?>"><?php endif; ?>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area_name">
            Nombre del Área <span class="text-red-500">*</span>
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.area_name') ? "red-500" : "gray-200" ?> rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="area_name" name="area_name" type="text" placeholder="Ej: Empleabilidad" value="<?= old('area_name') ?? (isset($area) ? $area['area_name'] : '') ?>">
        <p class="text-red-500 text-xs italic"><?= session('errors.area_name') ?></p>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="area_description">
            Descripción <span class="text-red-500">*</span>
        </label>
        <textarea
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.area_description') ? "red-500" : "gray-200" ?> rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="area_description" name="area_description" rows="4" placeholder="Breve descripción del área"><?= old('area_description') ?? (isset($area) ? $area['area_description'] : '') ?></textarea>
        <p class="text-red-500 text-xs italic"><?= session('errors.area_description') ?></p>
    </div>
</div>

<?php if (isset($area)): ?>
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status_id">
            Estado
        </label>
        <div class="relative">
            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="status_id" name="status_id">
                <?php foreach ($status as $state): ?>
                <option value="<?= $state['status_id'] ?>" <?= $area['status_id'] == $state['status_id'] ? "selected" : "" ?>><?= $state['status_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="flex flex-wrap -mx-3 mt-6">
    <div class="w-full px-3">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
            <?= isset($area) ? "Actualizar" : "Guardar" ?>
        </button>
        <a href="javascript:history.back()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2 sm:mt-0 sm:ml-2 w-full sm:w-auto inline-block text-center">
            Cancelar
        </a>
    </div>
</div>