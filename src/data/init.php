<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'src/helpers/dbHelpers.php';
$db = require_once 'db.php';

use Academy\classes\entities\users\User;
use Academy\classes\entities\users\lowLevel\UserStudent;
use Academy\classes\entities\users\mediumLevel\UserAssistant;
use Academy\classes\entities\users\mediumLevel\UserTeacher;
use Academy\classes\entities\users\highLevel\UserMaster;
use Academy\classes\entities\users\highLevel\UserDean;
use Academy\classes\entities\users\highLevel\UserViceRector;
use Academy\classes\entities\users\highLevel\UserRector;

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);

if (!$link) {
    $error = mysqli_connect_error();
    print($error);
    die();
}

mysqli_set_charset($link, "utf8mb4");

$user = [];
$result = [];
$fivemId = $_COOKIE['user_fivem_id'] ?? null;
$password = $_COOKIE['user_password'] ?? '';

if (isset($fivemId)) {
    $sql = "SELECT * FROM users WHERE fivem_id = ?";

    $result = dbQuery($link, $sql, [$fivemId]);

    if (!$result) {
        setUserDataCookies(0, "", time() - 3600);
        header("Location: /index.php?form_type=login&error=login");
        exit();
    }
}

if (count($result) === 1) {
    $result = $result[0];

    $data = [
        $link,
        $result['id'],
        $result['username'],
        $result['fivem_id'],
        $result['discord'],
        $result['status'],
        $result['formation_id'],
        $result['registration_date']
    ];

    $user = match ($result['status']) {
        User::STATUS_ASSISTANT => new UserAssistant(...$data),
        User::STATUS_TEACHER => new UserTeacher(...$data),
        User::STATUS_MASTER => new UserMaster(...$data),
        User::STATUS_DEAN => new UserDean(...$data),
        User::STATUS_VICE_RECTOR => new UserViceRector(...$data),
        User::STATUS_RECTOR => new UserRector(...$data),
        default => new UserStudent(...$data)
    };

    if (isset($password) && !password_verify($result['password'], $password)) {
        setUserDataCookies(0, "", time() - 3600);
        header("Location: /index.php?form_type=login&error=password");
        exit();
    }
}
