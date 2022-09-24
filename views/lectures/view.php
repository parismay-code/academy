<?php

use app\models\User;
use app\models\Lecture;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var Lecture $model
 */

$user = User::findOne(Yii::$app->user->id);

$this->title = "Vampires Academy | Лекция $model->id. " . Html::encode($model->title);
?>

<section>
    <h4 class="mb-5"><?= "Лекция $model->id. " . Html::encode($model->title) ?></h4>
    <ul class="d-flex flex-row text-uppercase fs-5">
        <li class="mx-3">
            <?php if ($model->status === Lecture::STATUS_NEW && $user->isActionAvailable(User::ACTION_SUBMIT_LECTURE)): ?>
                <?=
                Html::a
                (
                    'Утвердить материал',
                    ['lectures/submit', 'id' => $model->id],
                    ['class' => 'link-secondary text-decoration-none font-weight-bold']
                )
                ?>
            <?php elseif ($model->status === Lecture::STATUS_SUBMITTED && $user->isActionAvailable(User::ACTION_SUBMIT_LECTURE)): ?>
                <?=
                Html::a
                (
                    'Архивировать',
                    ['lectures/zip', 'id' => $model->id],
                    ['class' => 'link-secondary text-decoration-none font-weight-bold']
                )
                ?>
            <?php elseif ($model->status === Lecture::STATUS_ARCHIVED && $user->isActionAvailable(User::ACTION_SUBMIT_LECTURE)): ?>
                <?=
                Html::a
                (
                    'Разархивировать',
                    ['lectures/submit', 'id' => $model->id],
                    ['class' => 'link-secondary text-decoration-none font-weight-bold']
                )
                ?>
            <?php endif; ?>
        </li>
        <li class="mx-3">
            <?=
            Html::a
            (
                'Изменить',
                ['lectures/delete', 'id' => $model->id],
                ['class' => 'link-success text-decoration-none font-weight-bold']
            )
            ?>
        </li>
        <li class="mx-3">
            <?=
            Html::a
            (
                'Удалить',
                ['lectures/delete', 'id' => $model->id],
                ['class' => 'link-danger text-decoration-none font-weight-bold']
            )
            ?>
        </li>
    </ul>
    <div class="lecture-details-files">
        <?php foreach ($model->lectureFiles as $file): ?>
            <?= $file['url'] ?>
        <?php endforeach; ?>
    </div>
    <pre class="pre-scrollable text-white fs-5">
<?= Html::encode($model->details) ?>
    </pre>
</section>