<?php
$db = require_once 'db.php';

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

if (!$link) {
    $error = mysqli_connect_error();
    print($error);
    die();
}

mysqli_set_charset($link, "utf8mb4");
