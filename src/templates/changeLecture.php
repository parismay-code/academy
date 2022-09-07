<?php

use Academy\classes\entities\Lecture;
use Academy\classes\entities\users\User;

/**
 * @var User $user
 * @var Lecture $lecture
 */

?>

<section class="add-lecture">
    <h1 class="main__title">Редактирование лекции</h1>
    <form class="add-lecture-form" name="changed_lecture" action="addLecture.php?id=<?= $lecture->getId() ?>&act=change"
          method="post" enctype="multipart/form-data">
        <fieldset>
            <legend><?= 'Лекция ' . $lecture->getId() . '. ' . $lecture->getTitle() ?></legend>
            <input type="text" name="title" maxlength="100" placeholder="Новое название" required>
            <input type="file" name="files">
            <textarea name="details" placeholder="Материал" required>
<?= $lecture->getDetails() ?>
            </textarea>
            <input type="submit" value="Изменить">
        </fieldset>
    </form>
</section>
