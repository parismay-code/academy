<?php
/**
 * @var string $title
 * @var string $content
 * @var array $user
 */

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body class="page">
<header class="header">
</header>

<?= $content ?>

<footer class="footer">
</footer>
</body>
</html>
