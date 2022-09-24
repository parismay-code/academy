<?php

use app\models\User;
use app\models\Lecture;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var Lecture[] $models
 */

$user = User::findOne(Yii::$app->user->id);

$this->title = 'Vampires Academy | Лекции';
?>

<section>
    <h4 class="mb-3">Лекционный материал Академии ночи</h4>
    <div class="list-group text-center text-uppercase">
        <?=
        Html::a
        (
            'Добавить материал',
            ['lectures/create'],
            ['class' => 'btn btn-success text-white text-decoration-none font-weight-bold fs-5 fw-bold p-3']
        )
        ?>
    </div>
    <ul class="list-group list">
        <?php foreach ($models as $model): ?>
            <?php
                $status = match ($model->status) {
                    Lecture::STATUS_NEW => '(не утверждена)',
                    Lecture::STATUS_ARCHIVED => '(архивирована)',
                    default => ''
                }
            ?>
            <li style="background-color:#00000080; color: #ffffff;" class="list-group-item fs-5 p-3">
                <?=
                Html::a
                (
                    "Лекция $model->id. $model->title $status",
                    ['lectures/view', 'id' => $model->id],
                    ['class' => 'link-secondary text-decoration-none']
                );
                ?>
            </li>
        <?php endforeach; ?>
    </ul>
</section>