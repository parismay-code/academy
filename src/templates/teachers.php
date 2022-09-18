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
            <a class="teachers__request"
               href="setUserInTeachersCheckList.php?id=<?= $user->getId(); ?>&target=teachers">
                Подать заявку
            </a>
        <?php elseif ($user->canChangeOtherStatus(User::STATUS_STUDENT)): ?> |
            <a class="teachers__request" href="teachersRequests.php">Просмотреть заявки</a>
        <?php endif; ?>
    </h1>
    <div class="teachers-list">
        <?php foreach ($teachersList as $key => $teacher): ?>
            <div class="teachers-list__wrapper">
                <div
                    class="teachers-list__teacher teacher teacher_<?= htmlspecialchars($teacher->getStatus()['name']) ?> <?= $teacher->getId() === $user->getId() ? ' teacher_active' : '' ?>">
                <span class="teacher__name">
                    <?= $teacher->getStatus()['title'] . ' ' . htmlspecialchars($teacher->getName()) . ' | ' . $teacher->getFormation()['name'] ?>
                </span>
                    <span class="teacher__id">
                <?= 'ID: ' . htmlspecialchars($teacher->getFivemId()) ?>
                </span>
                    <div class="teacher-contacts">
                    <span class="teacher-contacts__element">
                        Discord: <b><?= htmlspecialchars($teacher->getDiscord()) ?></b>
                    </span>
                    </div>
                </div>
                <?php if ($user->canChangeOtherStatus($teacher->getStatus()['name'])): ?>
                    <div class="teachers-controls">
                        <div class="teachers-controls__title" onclick="changeControls(<?= $key ?>)">
                            Изменить статус
                        </div>
                        <ul class="teachers-controls-list change-status" id="<?= $key ?>">
                            <?php foreach (User::CHANGE_STATUS_MAP[$user->getStatus()['name']] as $status): ?>
                                <li class="change-status__element">
                                    <a href="changeUserStatus.php?target=teachers&fivem_id=<?= htmlspecialchars($teacher->getFivemId()) ?>&status=<?= $status ?>">
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
<script>
    const changeControls = (id) => {
        let el = document.getElementById(id);

        el.classList.toggle('teachers-controls-list_active');
    }
</script>
