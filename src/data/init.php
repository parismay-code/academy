<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'src/helpers/dbHelpers.php';

$db = require_once 'db.php';

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

if (!$link) {
    $error = mysqli_connect_error();
    print($error);
    die();
}

mysqli_set_charset($link, "utf8mb4");

$user = [];
$fivemId = $_COOKIE['user_fivem_id'] ?? '';
$password = $_COOKIE['user_password'] ?? '';

$sql = "SELECT * FROM users WHERE fivem_id = ?";

$user = dbQuery($link, $sql, [$fivemId]);

if (count($user) === 1) {
    $user = $user[0];

    if (!password_verify($user['password'], $password)) {
        setUserDataCookies("", "", time() - 3600);
        header("Location: /");
        exit();
    }
}
