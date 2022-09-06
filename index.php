<?php
/**
 * @var mysqli $link Ресурс подключения
 * @var array $user Данные о пользователе
 */

require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';

$formType = $_GET['form_type'] ?? 'login';
$error = $_GET['error'] ?? null;

$content = include_template('auth.php', [
    'user' => $user,
    'formType' => $formType,
    'error' => $error
]);

if (!empty($user)) {
    $content = include_template('main.php', [
        'user' => $user
    ]);
}

$layout = include_template('layout.php', [
    'user' => $user,
    'content' => $content,
    'title' => 'Vampires Academy | Home',
    'target' => 'home'
]);

print($layout);
