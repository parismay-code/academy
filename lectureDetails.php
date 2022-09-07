<?php
require_once 'src/data/init.php';
require_once 'src/helpers/mainHelpers.php';
require_once 'requiresAuth.php';

use Academy\classes\entities\users\User;
use Academy\classes\entities\Lecture;

/**
 * @var mysqli $link Ресурс подключения
 * @var User $user Данные о пользователе
 */

$lectureId = $_GET['id'] ?? 0;
$isChanging = $_GET['changing'] ?? false;

$lecture = null;
$files = [];

function getFileById($link, $fileId): array|false {
    $sql = "SELECT * FROM files WHERE id = ?";

    return dbQuery($link, $sql, [$fileId]);
}

if ($lectureId === 0) {
    header('Location: /lectures.php');
    exit();
}

$sql = "SELECT * FROM lectures WHERE id = ?";

$result = dbQuery($link, $sql, [$lectureId]);

if (empty($result)) {
    header('Location: /lectures.php');
    exit();
}

$lecture = new Lecture(
    $link,
    $result[0]['id'],
    $result[0]['title'],
    $result[0]['details'],
    $result[0]['status'],
    $result[0]['creation_date'],
    $files
);

$sql = "SELECT * FROM lecture_files WHERE lecture_id = ?";

$result = dbQuery($link, $sql, [$lectureId]);

if (!empty($result)) {
    foreach ($result as $el) {
        $file = getFileById($link, $el['file_id']);

        $files[] = $file[0] ?? null;
    }
}

$content = includeTemplate('lectureDetails.php', [
    'user' => $user,
    'lecture' => $lecture
]);

if ($isChanging) {
    $content = includeTemplate('changeLecture.php', [
        'user' => $user,
        'lecture' => $lecture
    ]);
}

$layout = includeTemplate('layout.php', [
    'user' => $user,
    'content' => $content,
    'title' => 'Vampires Academy | Лекция ' . $lecture->getId() . '. ' . $lecture->getTitle(),
    'target' => ''
]);

print($layout);
