<?php
require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';
require_once 'requiresAuth.php';

use Academy\classes\entities\users\User;

/**
 * @var mysqli $link Ресурс подключения
 * @var User $user Данные о пользователе
 */

$content = includeTemplate('profile.php', [
    'user' => $user,
]);

$layout = includeTemplate('layout.php', [
    'user' => $user,
    'content' => $content,
    'title' => 'Vampires Academy | Profile',
    'target' => 'profile'
]);

print($layout);
