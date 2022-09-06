<?php
/**
 * @var array $user Данные о пользователе
 * @var string $formType Данные о формациях
 * @var string $error Если есть ошибка, то возвращает "password" (неверный логин или пароль), "re_password" (пароли не совпадают)
 */

?>
<section class="auth">
    <?php if (isset($error)): ?>
    <ul class="auth-errors horizontal-list">
        <?php if ($error === 'undefined'): ?>
            <li class="horizontal-list__element error">Произошла ошибка, попробуйте в другой раз</li>
        <?php endif; ?>
        <?php if ($error === 'id'): ?>
            <li class="horizontal-list__element error">Профиль на данный ID уже зарегистрирован</li>
        <?php endif; ?>
        <?php if ($error === 'login'): ?>
            <li class="horizontal-list__element error">Профиль на ваш ID не зарегистрирован</li>
        <?php endif; ?>
        <?php if ($error === 'password'): ?>
        <li class="horizontal-list__element error">Неверный пароль</li>
        <?php endif; ?>
        <?php if ($error === 're_password'): ?>
        <li class="horizontal-list__element error">Пароли не совпадают</li>
        <?php endif; ?>
    </ul>
    <?php endif; ?>
    <?php if ($formType === 'login'): ?>
    <form class="auth-form" name="login" action="../../login.php" method="post">
        <fieldset>
            <legend>Вход в профиль</legend>
            <input type="number" min="1" max="99999" name="fivem_id" placeholder="Ваш ID на сервере" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input style="margin: 0 0 2rem 0;" type="submit" value="Войти">
            <a class="auth-form__redirect" href="?form_type=reg">Еще нет аккаунта?</a>
        </fieldset>
    </form>
    <?php elseif ($formType === 'reg'): ?>
    <form class="auth-form" name="reg" action="../../registration.php" method="post">
        <fieldset>
            <legend>Регистрация</legend>
            <input type="number" min="1" max="99999" name="fivem_id" placeholder="Ваш ID на сервере" required>
            <input type="text" name="name" placeholder="Имя персонажа" required>
            <input type="text" name="discord" placeholder="Ваш дискорд (example#xxxx)" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="password" name="re_password" placeholder="Повторите пароль" required>
            <label>
                В какой из формаций находится Ваш персонаж?
                <select name="formation" required>
                    <option value="Insignis">Insignis</option>
                    <option value="Camarilla">Camarilla</option>
                    <option value="Caedes">Caedes</option>
                    <option value="Sabbat">Sabbat</option>
                    <option value="Gangrel">Gangrel</option>
                </select>
            </label>
            <input style="margin: 0 0 2rem 0;" type="submit" value="Зарегистрироваться">
            <a class="auth-form__redirect" href="?form_type=login">Войти в существующий профиль</a>
        </fieldset>
    </form>
    <?php endif; ?>
</section>
