<?php

use app\models\User;
use app\models\UserFormation;
use app\models\Status;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var User[] $models
 */

$user = User::findOne(Yii::$app->user->id);

$isUserInQueue = !empty($user->teacherQueues);

$this->title = 'Vampires Academy | Преподаватели';
?>

<section>
    <h4 class="mb-3">Преподавательский состав Академии Ночи</h4>
    <h5 class="mb-3">
        <?php if ($user->status->level === 1 && !$isUserInQueue): ?>
            <?=
            Html::a
            (
                'Подать заявку',
                ['teachers/request', 'id' => $user->id],
                ['class' => 'link-secondary text-decoration-none fw-bold']
            );
            ?>
        <?php elseif ($user->isActionAvailable(User::ACTION_CHANGE_ASSISTANT)): ?>
            <?=
            Html::a
            (
                'Просмотреть заявки',
                ['teachers/queue'],
                ['class' => 'link-secondary text-decoration-none fw-bold']
            );
            ?>
        <?php endif; ?>
    </h5>
    <div class="users-list">
        <?php foreach ($models as $model): ?>
            <?php
            $formation = UserFormation::findOne(['user_id' => $model->id])->formation;
            ?>
            <div class="users-list__wrapper">
                <div class="users-list__user user <?= $model->id === $user->id ? 'user_active' : '' ?>">
                    <span class="user__name">
                        <?= Html::encode($model->status->label . " $model->username | $formation->name"); ?>
                    </span>
                    <span class="user__id">
                        <?= 'ID: ' . Html::encode($model->fivem_id) ?>
                    </span>
                    <div class="user-contacts">
                        <span class="user-contacts__element">
                            Discord: <b><?= Html::encode($model->discord) ?></b>
                        </span>
                    </div>
                </div>
                <?php if ($user->status->level > $model->status->level): ?>
                    <div class="user-select-none">
                        <div
                                class="fs-5 link-secondary text-uppercase fw-bold mb-3"
                                onclick="changeControls(<?= "user$model->id" ?>)"
                        >
                            Изменить статус
                        </div>
                        <ul
                                class="invisible"
                                id="user<?= $model->id ?>"
                        >
                            <?php foreach (Status::find()->all() as $status): ?>
                                <?php if ($status->id !== $model->status->id && $status->level < $user->status->level): ?>
                                    <li class="">
                                        <?=
                                        Html::a
                                        (
                                            $status->label,
                                            ['teachers/change', 'id' => $model->id, 'newStatusId' => $status->id],
                                            ['class' => 'link-secondary text-decoration-none fs-5']
                                        )
                                        ?>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
