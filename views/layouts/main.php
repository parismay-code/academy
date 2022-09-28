<?php

/**
 * @var yii\web\View $this
 * @var string $content
 */

use yii\helpers\Url;
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;
use app\models\User;

$route = Yii::$app->requestedRoute;

Yii::$app->language = 'ru-RU';
Yii::$app->user->loginUrl = ['auth/index'];

$user = User::findOne(Yii::$app->user->id);
$userLevel = $user->status->level ?? -1;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag([
    'name' => 'viewport',
    'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no'
]);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>

<header class="p-4 shadow user-select-none sticky-top">
    <nav class="d-flex flex-row align-items-center justify-content-around">
        <a
                class="link-light text-decoration-none text-uppercase text-center d-flex flex-column"
                href="<?= Url::to(['auth/index'], true) ?>"
        >
            <h3 class="m-0 fw-bolder">Vampires Academy</h3>
            <?php if ($route === 'auth/index' || $route === 'auth/registration'): ?>
                <h4>Авторизация</h4>
            <?php endif; ?>
        </a>
        <?php if (!Yii::$app->user->isGuest): ?>
            <?php
            $links = [
                ['title' => 'Расписание', 'path' => 'schedule/index', 'level' => 0],
                ['title' => 'Лекции', 'path' => 'lectures/index', 'level' => 2],
                ['title' => 'Преподаватели', 'path' => 'teachers/index', 'level' => 0],
                ['title' => 'Студенты', 'path' => 'students/index', 'level' => 4],
                ['title' => 'Пользователи', 'path' => 'users/index', 'level' => 5],
                ['title' => 'Профиль', 'path' => 'profile/index', 'level' => 0],
                ['title' => 'Выход', 'path' => 'auth/logout', 'level' => 0, 'classParams' => 'link-danger'],
            ];
            ?>
            <div class="d-flex flex-row align-items-center justify-content-between text-uppercase fw-bold">
                <?php foreach ($links as $link): ?>
                    <?php
                    $isLinkActive = $link['path'] === Yii::$app->requestedRoute;

                    if ($isLinkActive) {
                        $link['classParams'] = 'link-success';
                    }

                    $params = [
                        $link['classParams'] ?? 'link-secondary',
                    ];
                    ?>
                    <?php if ($userLevel >= $link['level']): ?>
                        <?=
                        Html::a
                        (
                            $link['title'],
                            [$link['path']],
                            ['class' => 'text-decoration-none fw-bolder mx-lg-2' . ' ' . implode(' ', $params)]
                        )
                        ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </nav>
</header>

<main class="container-md">
    <?= Alert::widget() ?>
    <?= $content ?>
</main>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
