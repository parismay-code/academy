<?php
/**
 * @var array $user Данные о пользователе
 * @var array $formations Данные о формациях
 */

$formation = [];

if (!empty($user)) {
    $formation = $formations[$user['formation_id'] - 1];
}

?>

<main class="main">
    <?php if (!empty($user)): ?>
        <div class="user-info">
            <div class="user-info__name"><?= $user['username'] . ' [' . $user['fivem_id'] . ']' ?></div>
            <div class="user-info__formation"><?= $formation['name'] ?></div>
            <a class="user-info__logout" href="../../logout.php">Выйти</a>
        </div>
    <?php else: ?>
        <div class="user-not-auth">user not singed in</div>
        <form class="user-auth" name="login" action="../../login.php" method="post">
            <label>
                <input type="number" min="1" max="99999" name="fivem_id" placeholder="Ваш ID на сервере">
            </label>
            <label>
                <input type="password" name="password" placeholder="Пароль">
            </label>
            <input type="submit" value="Войти">
        </form>
    <?php endif; ?>
</main>
