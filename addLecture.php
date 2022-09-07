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

$act = $_GET['act'] ?? null;
$data = $_POST;
$files = $_FILES['files'] ?? [];

$lectureId = $_GET['id'] ?? 0;

$isChanged = $act === 'change';

if ($isChanged && !empty($data)) {
    $sql = "UPDATE lectures SET title = ?, details = ?, status = ? WHERE id = ?";

    dbQuery($link, $sql, [$data['title'], $data['details'], Lecture::STATUS_NEW, $lectureId]);

    header('Location: /lectureDetails.php?id=' . $lectureId);
    exit();
}

function addFile(mysqli $link, array $file): array|false
{
    $name = $file['name'];
    $mime = $file['mime'];
    $tmp_name = $file['tmp_name'];
    $url = 'uploads/' . $name;

    move_uploaded_file($tmp_name, $url);

    $sql = "INSERT INTO files (url, type) VALUES (?, ?)";

    return dbQuery($link, $sql, [$url, $mime]);
}

if (!empty($data)) {
    $sql = "INSERT INTO lectures (status, creation_date, title, details)"
        . " VALUES (?, NOW(), ?, ?)";

    dbQuery($link, $sql, [Lecture::STATUS_NEW, $data['title'], $data['details']]);

    $sql = "SELECT * FROM lectures";

    $result = dbQuery($link, $sql);

    $lectureId = count($result);
}

if (isset($files[0])) {
    foreach ($files as $file) {
        $fileId = 0;

        addFile($link, $file);

        $sql = "SELECT * FROM files";

        $result = dbQuery($link, $sql);

        $fileId = count($result);

        $sql = "INSERT INTO lecture_files (lecture_id, file_id) VALUES (?, ?)";

        if ($lectureId > 0 && $fileId > 0) {
            dbQuery($link, $sql, [$lectureId, $fileId]);
        }
    }
}

if ($lectureId > 0) {
    header('Location: /lectureDetails.php?id=' . $lectureId);
    exit();
}

$content = includeTemplate('addLecture.php', [
    'user' => $user,
]);

$layout = includeTemplate('layout.php', [
    'user' => $user,
    'content' => $content,
    'title' => 'Vampires Academy | New Lecture',
    'target' => ''
]);

print($layout);
