<?php

use Academy\classes\entities\users\User;
use Academy\classes\entities\Lecture;

/**
 * @var User $user
 * @var Lecture $lecture
 */

?>

<section class="lecture-details">
    <h1 class="main__title">
        Лекция <?= $lecture->getId() ?>. <?= $lecture->getTitle() ?>
        <?php if ($user->isActionAvailable(User::ACTION_CHANGE_LECTURE)): ?> |
        <a class="lecture-details__edit" href="lectureDetails.php?id=<?= $lecture->getId() ?>&changing=true">
            Редактировать
        </a>
        <?php endif; ?>
    </h1>
    <div class="lecture-details-files">
        <?php foreach ($lecture->getFiles() as $file): ?>
            <?= $file['url'] ?>
        <?php endforeach; ?>
    </div>
    <pre class="lecture-details__content">
<?= $lecture->getDetails() ?>
    </pre>
</section>
