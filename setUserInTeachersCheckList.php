<?php
require_once 'src/data/init.php';
require_once 'requiresAuth.php';

/**
 * @var mysqli $link Ресурс подключения
 */

$userId = $_GET['id'] ?? 0;
$target = $_GET['target'] ?? 'index';

if ($userId === 0) {
    header('Location: /');
    exit();
}

$sql = "INSERT INTO teachers_check_list (user_id) VALUES (?)";

dbQuery($link, $sql, [$userId]);

header('Location: /' . $target . '.php');
