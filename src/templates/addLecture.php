<?php

use Academy\classes\entities\users\User;

/**
 * @var User $user
 */

?>

<section class="add-lecture">
    <h1 class="main__title">Добавление новой лекции</h1>
    <form class="add-lecture-form" name="new_lecture" action="addLecture.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Новая лекция</legend>
            <input type="text" name="title" maxlength="100" placeholder="Название" required>
            <input type="file" name="files" multiple>
            <textarea name="details" placeholder="Материал" required></textarea>
            <input type="submit" value="Добавить">
        </fieldset>
    </form>
</section>
