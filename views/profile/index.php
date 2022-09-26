<?php

use app\models\User;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */

$user = User::findOne(Yii::$app->user->id);

$this->title = 'Vampires Academy | Профиль';
?>

<section>
    <h4 class="mb-3">Профиль <?= Html::encode($user->username) ?></h4>
    <div class="d-flex flex-row align-items-center justify-content-between w-25 mb-3">
        <?=
        Html::a
        (
            'Редактировать',
            ['profile/edit'],
            ['class' => 'btn btn-secondary text-uppercase text-decoration-none fs-5 p-2 px-3 fw-bold']
        );
        ?>
        <?=
        Html::a
        (
            'Удалить',
            ['profile/delete'],
            ['class' => 'btn btn-danger text-uppercase text-decoration-none fs-5 p-2 px-3 fw-bold']
        );
        ?>
    </div>
    <div>

    </div>
</section>
