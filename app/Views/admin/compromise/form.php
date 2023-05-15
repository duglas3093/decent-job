<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-2/2 px-3 mb-2 md:mb-0">
        <?php if(isset($compromise)): ?><input type="hidden" name="compromise_id" id="compromise_id" value="<?= $compromise['compromise_id'] ?>"><?php endif; ?>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="compromise_name">
            Compromiso
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.compromise_name') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="compromise_name" name="compromise_name" type="text" placeholder="Nombre de la empresa" value="<?= old('compromise_name') ?? (!isset($compromise) ? "":"{$compromise['compromise_name']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.compromise_name') ?></p>
    </div>
    <div class="w-full md:w-2/2 px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="compromise_description">
            Descripción
        </label>
        <textarea class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.compromise_description') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="compromise_description" name="compromise_description" cols="30" rows="15"><?= old('compromise_description') ?? (!isset($compromise) ? "":"{$compromise['compromise_description']}") ?></textarea>
            <p class="text-red-500 text-xs italic"><?= session('errors.compromise_description') ?></p>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2 mt-5">
    <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <?= isset($compromise) ? "Actualizar":"Guardar"?>
        </button>
        <a href="javascript:history.back()" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cancelar
        </a>
    </div>
</div>
