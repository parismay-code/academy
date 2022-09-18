<?php

use Academy\classes\entities\users\User;

/**
 * @var User $user
 * @var array $lectures
 */

?>

<section class="lectures">
    <h1 class="main__title">
        Лекционный материал Академии ночи
        <?php if ($user->isActionAvailable(User::ACTION_CHANGE_LECTURE)): ?> |
            <a class="teachers__request" href="addLecture.php?target=lectures">
                Добавить лекцию
            </a>
        <?php endif; ?>
    </h1>
    <ul class="lectures-list">
        <?php foreach ($lectures as $lecture): ?>
        <li class="lectures-list__element">
            <a href="lectureDetails.php?id=<?= $lecture['id'] ?>" target="_blank">
                <?= 'Лекция ' . $lecture['id'] . '. ' . htmlspecialchars($lecture['title']) ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</section>
