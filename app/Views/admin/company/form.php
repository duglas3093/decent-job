<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-2/2 px-3 mb-2 md:mb-0">
        <?php if(isset($company)): ?><input type="hidden" name="company_id" id="company_id" value="<?= $company['company_id'] ?>"><?php endif; ?>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="company_name">
            Nombre de la empresa
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.company_name') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="company_name" name="company_name" type="text" placeholder="Nombre de la empresa" value="<?= old('company_name') ?? (!isset($company) ? "":"{$company['company_name']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.company_name') ?></p>
    </div>
    <div class="w-full md:w-2/2 px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="company_description">
            Descripción
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.company_description') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="company_description" name="company_description" type="text" placeholder="Breve descripción de la empresa" value="<?= old('company_description') ?? (!isset($company) ? "":"{$company['company_description']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.company_description') ?></p>
    </div>
    <div class="w-full md:w-2/2 px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="company_phone">
            Teléfono
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.company_phone') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="company_phone" name="company_phone" type="number" placeholder="Teléfono de referencia" value="<?= old('company_phone') ?? (!isset($company) ? "":"{$company['company_phone']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.company_phone') ?></p>
    </div>
    <div class="w-full md:w-2/2 px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="company_direction">
            Dirección
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.company_direction') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="company_direction" name="company_direction" type="text" placeholder="Dirección de la empresa" value="<?= old('company_direction') ?? (!isset($company) ? "":"{$company['company_direction']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.company_direction') ?></p>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2 mt-5">
    <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <?= isset($company) ? "Actualizar":"Guardar"?>
        </button>
        <a href="javascript:history.back()" class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cancelar
        </a>
    </div>
</div>
