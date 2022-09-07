<?php

use Academy\classes\entities\users\User;

/**
 * @var User $user Данные о пользователе
 * @var array<User> $teachersRequestList Список преподавателей
 */

?>

<section class="teachers-request">
    <h1 class="main__title">Заявки в преподавательский состав Академии Ночи</h1>
    <div class="teachers-request__list">
        <?php foreach ($teachersRequestList as $_user): ?>
            <div class="teachers-request-user">
                <span class="teachers-request-user__name">
                    <?= $_user->getStatus()['title'] . ' ' . $_user->getName() . ' | ' . $_user->getFormation()['name']?>
                </span>
                <span class="teachers-request-user__id">
                    <?= 'ID: ' . $_user->getFivemId() ?>
                </span>
                <div class="teachers-request-user-contacts">
                    <span class="teachers-request-user-contacts__element">
                        Discord: <b><?= $_user->getDiscord() ?></b>
                    </span>
                </div>
            </div>
            <div class="teachers-request-controls">
                <a
                    class="teachers-request-controls__accept"
                    href="changeUserStatus.php?fivem_id=<?= $_user->getFivemId() ?>&status=<?= User::STATUS_TEACHER ?>&target=teachersRequests&act=request"
                >
                    Принять
                </a>
                <a
                    class="teachers-request-controls__decline"
                    href="changeUserStatus.php?fivem_id=<?= $_user->getFivemId() ?>&status=<?= User::STATUS_STUDENT ?>&target=teachersRequests&act=request"
                >
                    Отклонить
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>
