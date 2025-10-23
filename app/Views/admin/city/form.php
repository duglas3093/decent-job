<div class="flex flex-wrap -mx-3 mb-2">
    <?php if (isset($city)): ?>
        <input type="hidden" id="city_id" name="city_id" value="<?= $city['city_id'] ?>">
    <?php endif; ?>
    <div class="w-full md:w-2/2 px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="city_name">
            Nombre
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.city_name') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="city_name" name="city_name" type="text" placeholder="Breve descripción de la empresa" value="<?= old('city_name') ?? (!isset($city) ? "":"{$city['city_name']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.city_name') ?></p>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2 mt-5">
    <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <?= isset($city) ? "Actualizar":"Guardar"?>
        </button>
        <a href="javascript:history.back()" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cancelar
        </a>
    </div>
</div>
