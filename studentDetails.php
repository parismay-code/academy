<?php
require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';
require_once 'requiresAuth.php';

use Academy\classes\entities\users\User;

/**
 * @var mysqli $link Ресурс подключения
 * @var User $user Данные о пользователе
 */

$content = includeTemplate('studentDetails.php', [
    'user' => $user,
]);

$layout = includeTemplate('layout.php', [
    'user' => $user,
    'content' => $content,
    'title' => 'Vampires Academy | Student Info',
    'target' => ''
]);

print($layout);
