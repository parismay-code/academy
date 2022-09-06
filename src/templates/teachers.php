<?php

use Academy\classes\entities\users\User;

/**
 * @var User $user Данные о пользователе
 * @var array<User> $teachersList Список преподавателей
 * @var bool $isInTeacherCheckList Находится ли пользователь в списке кандидатов в преподаватели
 * @var int|false $activeControls Активное меню редактирования
 */

?>

<section class="teachers">
    <h1 class="main__title">
        Преподавательский состав Академии Ночи
        <?php if ($user->getStatus()['name'] === User::STATUS_STUDENT && !$isInTeacherCheckList): ?> |
            <a class="teachers__request" href="setUserInTeachersCheckList.php?id=<?= $user->getId(); ?>&target=teachers">
                Подать заявку
            </a>
        <?php elseif ($user->canChangeOtherStatus(User::STATUS_STUDENT)): ?> |
            <a class="teachers__request" href="teachersRequests.php">Просмотреть заявки</a>
        <?php endif; ?>
    </h1>
    <div class="teachers-list">
        <?php foreach ($teachersList as $teacher): ?>
            <div class="teachers-list__wrapper">
                <div
                    class="teachers-list__teacher teacher teacher_<?= $teacher->getStatus()['name'] ?> <?= $teacher->getId() === $user->getId() ? ' teacher_active' : '' ?>">
                <span class="teacher__name">
                    <?= $teacher->getStatus()['title'] . ' ' . $teacher->getName() ?>
                </span>
                    <span class="teacher__id">
                <?= 'ID: ' . $teacher->getFivemId() ?>
                </span>
                    <div class="teacher-contacts">
                    <span class="teacher-contacts__element">
                        Discord: <b><?= $teacher->getDiscord() ?></b>
                    </span>
                    </div>
                </div>
                <?php if ($user->canChangeOtherStatus($teacher->getStatus()['name'])): ?>
                    <div class="teachers-controls">
                        <a class="teachers-controls__title" href="?controls=<?= $teacher->getId() ?>">
                            Изменить статус
                        </a>
                        <ul class="teachers-controls-list change-status <?= $activeControls === $teacher->getId() ? 'teachers-controls-list_active' : '' ?>">
                            <?php foreach (User::CHANGE_STATUS_MAP[$user->getStatus()['name']] as $status): ?>
                                <li class="change-status__element">
                                    <a href="changeUserStatus.php?target=teachers&fivem_id=<?= $teacher->getFivemId() ?>&status=<?= $status ?>">
                                        <?= User::STATUS_MAP[$status] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
