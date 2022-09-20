<?php
use Academy\classes\entities\users\User;

/**
 * @var string $title
 * @var string $content
 * @var User $user
 * @var string $target
 */

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="src/css/main.css">
</head>
<body>
<header class="header">
    <div class="header__wrapper <?= empty($user) ? 'header__wrapper_login' : '' ?>">
        <a class="header__logo" href="index.php">VAMPIRES ACADEMY</a>
        <?php if (!empty($user)): ?>
        <nav class="header-navigation">
            <ul class="header-list vertical-list">
                <!-- SCHEDULE REDIRECT -->
                <li class="vertical-list__element <?= $target === 'schedule' ? 'vertical-list__element_active' : '' ?>">
                    <a href="schedule.php">Расписание</a>
                </li>

                <!-- LECTURES REDIRECT -->
                <?php if ($user->isActionAvailable(User::ACTION_TAKE_LESSON)): ?>
                <li class="vertical-list__element <?= $target === 'lectures' ? 'vertical-list__element_active' : '' ?>">
                    <a href="lectures.php">Лекции</a>
                </li>
                <?php endif; ?>

                <!-- TEACHERS REDIRECT -->
                <li class="vertical-list__element <?= $target === 'teachers' ? 'vertical-list__element_active' : '' ?>">
                    <a href="teachers.php">Преподаватели</a>
                </li>

                <!-- PROFILE REDIRECT -->
                <li class="vertical-list__element <?= $target === 'profile' ? 'vertical-list__element_active' : '' ?>">
                    <a href="profile.php">Профиль</a>
                </li>

                <!-- STUDENTS REDIRECT -->
                <li class="vertical-list__element <?= $target === 'students' ? 'vertical-list__element_active' : '' ?>">
                    <a href="students.php">Студенты</a>
                </li>

                <!-- LOGOUT REDIRECT -->
                <li class="vertical-list__element">
                    <a href="logout.php">Выход</a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</header>

<main class="main">
    <div class="main__wrapper">
        <?= $content ?>
    </div>
</main>

<footer class="footer">
</footer>
</body>
</html>
