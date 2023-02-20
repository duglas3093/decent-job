<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full md:w-1/2 px-3 mb-2 md:mb-0">
        <?php if(isset($user)): ?><input type="hidden" name="user_id" id="user_id" value="<?= $user['user_id'] ?>"><?php endif; ?>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
            Nombre(s)
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.user_name') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="user_name" name="user_name" type="text" placeholder="Nombre(s)" value="<?= old('user_name') ?? (!isset($user) ? "":"{$user['user_name']})") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.user_name') ?></p>
    </div>
    <div class="w-full md:w-1/2 px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
            Apellido(s)
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.user_lastname') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="user_lastname" name="user_lastname" type="text" placeholder="Apellido(s)" value="<?= old('user_lastname') ?? (!isset($user) ? "":"{$user['user_lastname']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.user_lastname') ?></p>
    </div>
    <div class="w-full md:w-1/2 px-3 mb-3 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
            Carnet de Identidad
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.user_ci') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="user_ci" name="user_ci" type="text" placeholder="Canet de identidad" value="<?= old('user_ci') ?? (!isset($user) ? "":"{$user['user_ci']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.user_ci') ?></p>
    </div>
    <div class="w-full md:w-1/2 px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
            Celular
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.user_user_celphone') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="user_celphone" name="user_celphone" type="number" placeholder="Número de celular" value="<?= old('user_celphone') ?? (!isset($user) ? "":"{$user['user_celphone']}") ?>">
            <p class="text-red-500 text-xs italic"><?= session('errors.user_celphone') ?></p>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <div class="w-full px-3 mb-2">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Email
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.user_email') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="user_email" name="user_email" type="email" placeholder="Email" value="<?= old('user_email') ?? (!isset($user) ? "":"{$user['user_email']}") ?>" required>
            <p class="text-red-500 text-xs italic"><?= session('errors.user_email') ?></p>
    </div>
    <?php if (!isset($user)): ?>
    <div class="w-full px-3">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Contraseña
        </label>
        <input
            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-<?= session('errors.user_password') ? "red-500 mb-3":"gray-200 focus:border-gray-500" ?> rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white"
            id="user_password" name="user_password" type="password" placeholder="******************">
            <p class="text-red-500 text-xs italic"><?= session('errors.user_password') ?></p>
        <!-- <p class="text-gray-600 text-xs italic">Make it as long and as crazy as you'd like</p> -->
    </div>
    <?php endif; ?>
</div>
<div class="flex flex-wrap -mx-3 mb-2">
    <?php if (isset($user)): ?>
    <div class="w-full md:w-1/3 px-3 mb-2 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            Estado
        </label>
        <div class="relative">
            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="status_id" name="status_id">
                <?php foreach ($status as $state): ?>
                <option value="<?= $state['status_id'] ?>" <?= $user['status_id'] == $state['status_id'] ?? "selected" ?>><?= $state['status_name'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
            Rol
        </label>
        <div class="relative">
            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                id="rol_id" name="rol_id">
                <?php foreach ($rols as $rol): ?>
                <option value="<?= $rol['rol_id'] ?>" <?= !isset($user) ? "": ($user['rol_id'] == $rol['rol_id'] ?? "selected") ?>><?= $rol['rol_description'] ?></option>
                <?php endforeach; ?>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-wrap -mx-3 mb-2 mt-5">
    <div class="w-full md:w-1/4 px-3 mb-3 md:mb-0">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <?= isset($user) ? "Actualizar":"Guardar"?>
        </button>
        <button class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cancelar
        </button>
    </div>
</div>
