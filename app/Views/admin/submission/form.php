<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3 mb-6 md:mb-0">
        <?php if(isset($financier)): ?><input type="hidden" name="financier_id" value="<?= $financier['financier_id'] ?>"><?php endif; ?>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="financier_project`">
            Nombre del Financiador <span class="text-red-500">*</span>
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.financier_project') ? "red-500" : "gray-200" ?> rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="financier_project" name="financier_project" type="text" placeholder="Financiador" value="<?= old('financier_project') ?? (isset($financier) ? $financier['financier_project'] : '') ?>">
        <p class="text-red-500 text-xs italic"><?= session('errors.financier_project') ?></p>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="financier_description">
            Descripción <span class="text-red-500">*</span>
        </label>
        <textarea
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.financier_description') ? "red-500" : "gray-200" ?> rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            id="financier_description" name="financier_description" rows="4" placeholder="Breve descripción del financiador"><?= old('financier_description') ?? (isset($financier) ? $financier['financier_description'] : '') ?></textarea>
        <p class="text-red-500 text-xs italic"><?= session('errors.financier_description') ?></p>
    </div>
</div>

<div class="flex flex-wrap -mx-3 mt-6">
    <div class="w-full px-3">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full sm:w-auto">
            <?= isset($financier) ? "Actualizar" : "Guardar" ?>
        </button>
        <a href="javascript:history.back()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2 sm:mt-0 sm:ml-2 w-full sm:w-auto inline-block text-center">
            Cancelar
        </a>
    </div>
</div>