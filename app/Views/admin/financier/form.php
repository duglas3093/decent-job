<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-2/2 px-3 mb-2 md:mb-0">
        <?php if(isset($financier)): ?><input type="hidden" name="financier_id" id="financier_id" value="<?= $financier['financier_id'] ?>"><?php endif; ?>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="financier_project">
            Financiador
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.financier_project') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="financier_project" name="financier_project" type="text" placeholder="Financiador" value="<?= old('financier_project') ?? (!isset($financier) ? "":"{$financier['financier_project']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.financier_project') ?></p>
    </div>
    <div class="w-full md:w-2/2 px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="financier_description">
            Descripción
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.financier_description') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="financier_description" name="financier_description" type="text" placeholder="Descripción" value="<?= old('financier_description') ?? (!isset($financier) ? "":"{$financier['financier_description']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.financier_description') ?></p>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <?php if (isset($financier)): ?>
    <div class="w-full md:w-1/3 px-3 mb-2 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="status_id">
            Estado
        </label>
        <div class="relative">
            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="status_id" name="status_id">
                <?php foreach ($status as $state): ?>
                <option value="<?= $state['status_id'] ?>" <?= $financier['status_id'] == $state['status_id'] ? "selected":"" ?>><?= $state['status_name'] ?></option>
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
            <?= isset($financier) ? "Actualizar":"Guardar"?>
        </button>
        <a href="javascript:history.back()" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cancelar
        </a>
    </div>
</div>
