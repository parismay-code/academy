<?php
require_once 'src/data/init.php';

$fivemId = $_COOKIE['user_fivem_id'] ?? null;
$password = $_COOKIE['user_password'] ?? null;

$data = $_POST;

if (!empty($data['fivem_id']) && !empty($data['password'])) {
    $fivemId = (int)$data['fivem_id'];
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $expires = strtotime('+1 month', time());

    setUserDataCookies($fivemId, $password, $expires);
}

header("Location: /");
exit();
