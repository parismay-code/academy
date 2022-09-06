<?php
require_once 'src/data/init.php';

use Academy\classes\entities\users\User;

/**
 * @var mysqli $link Ресурс подключения
 */

$data = $_POST;

if (empty($data)) {
    header("Location: /");
    exit();
}

if (getUserByFivemId($link, $data['fivem_id'])) {
    header("Location: /index.php?form_type=reg&error=id");
    exit();
}

if ($data['password'] !== $data['re_password']) {
    header("Location: /index.php?form_type=reg&error=re_password");
    exit();
}

$formation = getFormationByName($link, $data['formation']);

if (empty($formation)) {
    header("Location: /index.php?form_type=reg&error=undefined");
    exit();
}

$formation = $formation[0];

$sql = "INSERT INTO users (username, fivem_id, discord, password, formation_id, status, registration_date) VALUES (?, ?, ?, ?, ?, ?, NOW())";

$result = dbQuery($link, $sql, [
    $data['name'],
    $data['fivem_id'],
    $data['discord'],
    $data['password'],
    $formation['id'],
    User::STATUS_STUDENT
]);

$expires = strtotime('+1 month', time());
setUserDataCookies($data['fivem_id'], password_hash($data['password'], PASSWORD_DEFAULT), $expires);

header("Location: /");
exit();
