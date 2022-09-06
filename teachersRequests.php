<?php
require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';
require_once 'requiresAuth.php';

use Academy\classes\entities\users\User;
use Academy\classes\entities\users\lowLevel\UserStudent;

/**
 * @var mysqli $link Ресурс подключения
 * @var User $user Данные о пользователе
 */

$teachersRequestList = [];

$sql = "SELECT * FROM teachers_check_list";
$checkList = dbQuery($link, $sql);

$sql = "SELECT * FROM users WHERE id = ?";

if (!empty($checkList)) {
    foreach ($checkList as $el) {
        $_user = dbQuery($link, $sql, [$el['user_id']]);

        if (empty($_user)) {
            break;
        }

        $_user = $_user[0];

        $userData = [
            $link,
            $_user['id'],
            $_user['username'],
            $_user['fivem_id'],
            $_user['discord'],
            $_user['status'],
            $_user['formation_id'],
            $_user['registration_date']
        ];

        $teachersRequestList[] = new UserStudent(...$userData);
    }
}

$content = includeTemplate('teachersRequests.php', [
    'user' => $user,
    'teachersRequestList' => $teachersRequestList
]);

$layout = includeTemplate('layout.php', [
    'user' => $user,
    'content' => $content,
    'title' => 'Vampires Academy | Teachers Requests',
    'target' => ''
]);

print($layout);
