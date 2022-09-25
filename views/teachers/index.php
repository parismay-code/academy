<?php

use app\models\User;
use app\models\FormationUser;
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
        <?php if ($user->status === User::STATUS_VISITOR && !$isUserInQueue): ?>
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
    <div class="teachers-list">
        <?php foreach ($models as $model): ?>
            <?php
            $formation = FormationUser::findOne(['user_id' => $model->id])->formation;
            ?>
            <div class="teachers-list__wrapper">
                <div
                    class="
                    teachers-list__teacher
                    teacher
                    teacher_<?= $model->status ?>
                    <?= $model->id === $user->id ? 'teacher_active' : '' ?>
                    "
                >
                    <span class="teacher__name">
                        <?=
                        User::STATUS_MAP[$model->status]['name'] .
                        ' ' . Html::encode($model->username) .
                        ' | ' . Html::encode($formation->name)
                        ?>
                    </span>
                    <span class="teacher__id">
                        <?= 'ID: ' . Html::encode($model->fivem_id) ?>
                    </span>
                    <div class="teacher-contacts">
                        <span class="teacher-contacts__element">
                            Discord: <b><?= Html::encode($model->discord) ?></b>
                        </span>
                    </div>
                </div>
                <?php if ($user->isChangeUserStatusAvailable($model->status)): ?>
                    <div class="user-select-none">
                        <div
                            class="fs-5 link-secondary text-uppercase fw-bold mb-3"
                            onclick="changeTeachersControls(<?= "teacher$model->id" ?>)"
                        >
                            Изменить статус
                        </div>
                        <ul
                            class="invisible"
                            id="teacher<?= $model->id ?>"
                        >
                            <?php foreach ($user->getAvailableToChangeStatusList() as $status): ?>
                                <?php if ($status['name'] !== User::STATUS_MAP[$model->status]['name']): ?>
                                    <li class="">
                                        <?=
                                        Html::a
                                        (
                                            $status['name'],
                                            ['teachers/change', 'id' => $model->id, 'newStatus' => $status['label']],
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
