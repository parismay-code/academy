<?php

/**
 * @var array $user Данные о пользователе
 */

?>

<section>
    <div class="user-info">
        <div class="user-info__name">
            <?=
            htmlspecialchars($user->getStatus()['title']) . ' ' .
            htmlspecialchars($user->getName()) .
            ' | ID: ' . htmlspecialchars($user->getFivemId()) .
            ' | Discord: ' . htmlspecialchars($user->getDiscord());
            ?>
        </div>
        <div class="user-info__formation">
            <?= htmlspecialchars($user->getFormation()['name']) ?>
        </div>
    </div>
</section>
