<?php
require_once 'src/data/init.php';
require_once 'requiresAuth.php';

use Academy\classes\entities\users\User;

/**
 * @var mysqli $link Ресурс подключения
 * @var User $user
 */

$changedUserFivemId = (int)$_GET['fivem_id'] ?? 0;
$newStatus = $_GET['status'] ?? null;
$target = $_GET['target'] ?? 'index';
$act = $_GET['act'] ?? null;

$changedUser = [];

if ($changedUserFivemId > 0) {
    $changedUser = getUserByFivemId($link, $changedUserFivemId);
}

if (empty($changedUser)) {
    header('Location: /');
    exit();
}

$changedUser = $changedUser[0];

if (!$user->canChangeOtherStatus($changedUser['status'])) {
    header('Location: /');
    exit();
}

if (isset($newStatus)) {
    $sql = "UPDATE users SET status = ? WHERE id = ?";

    dbQuery($link, $sql, [$newStatus, $changedUser['id']]);
}

if ($act === 'request') {
    $sql = "DELETE FROM teachers_check_list WHERE user_id = ?";

    dbQuery($link, $sql, [$changedUser['id']]);
}

header('Location: /' . $target . '.php');
