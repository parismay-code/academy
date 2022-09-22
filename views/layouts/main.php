<?php

/**
 * @var yii\web\View $this
 * @var string $content
 */

use yii\helpers\Url;
use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Html;

$route = Yii::$app->requestedRoute;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag([
    'name' => 'viewport',
    'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no'
]);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '@web/favicon.ico']);
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

<header class="shadow user-select-none sticky-top d-flex flex-row align-items-center justify-content-around">
    <nav>
        <a
                class="link-light text-decoration-none text-uppercase text-center d-flex flex-column"
                href="<?= Url::to(['auth/index'], true) ?>"
        >
            <h3>Vampires Academy</h3>
            <?php if ($route === 'auth/index' || $route === 'auth/registration'): ?>
                <h4>Авторизация</h4>
            <?php endif; ?>
        </a>
        <?php if (!Yii::$app->user->isGuest): ?>
            123
        <?php endif; ?>
    </nav>
</header>

<?= Alert::widget() ?>
<?= $content ?>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
