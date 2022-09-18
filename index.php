<?php
require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';

use Academy\classes\entities\users\User;

/**
 * @var mysqli $link Ресурс подключения
 * @var User $user Данные о пользователе
 */

$formType = $_GET['form_type'] ?? 'login';
$error = $_GET['error'] ?? null;

$content = includeTemplate('auth.php', [
    'user' => $user,
    'formType' => $formType,
    'error' => $error
]);

if (!empty($user)) {
    header('Location: /schedule.php');
}

$layout = includeTemplate('layout.php', [
    'user' => $user,
    'content' => $content,
    'title' => 'Vampires Academy | Authorization',
    'target' => 'auth'
]);

print($layout);
