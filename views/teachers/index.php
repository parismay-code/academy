<?php

use app\models\User;
use app\models\ScheduleDay;
use app\models\Status;
use yii\helpers\Html;
use app\helpers\MainHelper;

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
            $formation =$model->formationUsers[0]->formation;
            ?>
            <div class="users-list__wrapper">
                <div class="users-list__user user <?= $model->id === $user->id ? 'user_active' : '' ?>">
                    <div>
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
                    <div class="user-performance mt-3 invisible" id="performance<?= $model->id ?>">
                        <table class="table table-bordered table-striped table-hover table-dark">
                            <thead>
                            <tr>
                                <?php for ($i = 1; $i <= 7; $i++): ?>
                                    <?php
                                    if (ScheduleDay::findOne($i)->type === ScheduleDay::TYPE_VACATION) {
                                        continue;
                                    }

                                    $dayData = ScheduleDay::DAYS_MAP[$i];

                                    $title = $dayData['ru'];
                                    $timestamp = strtotime($dayData['en']);

                                    if ($timestamp > strtotime('Sunday')) {
                                        $timestamp = strtotime('-1 week', $timestamp);
                                    }

                                    $date = date('d.m.Y', $timestamp);
                                    ?>
                                    <th class="fs-6 col-1 text-center"><?= "$date <br> $title" ?></th>
                                <?php endfor; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php for ($i = 1; $i <= 7; $i++): ?>
                                    <?php
                                    if (ScheduleDay::findOne($i)->type === ScheduleDay::TYPE_VACATION) {
                                        continue;
                                    }

                                    $hours = 0;

                                    $dayData = ScheduleDay::DAYS_MAP[$i];
                                    $timestamp = strtotime($dayData['en']);

                                    if ($timestamp > strtotime('Sunday')) {
                                        $timestamp = strtotime('-1 week', $timestamp);
                                    }

                                    $date = date('Y-m-d', $timestamp);

                                    foreach ($user->teacherActivities as $activity) {
                                        $activityDate = date("Y-m-d", strtotime($activity->date));

                                        if ($date === $activityDate) {
                                            $hours += match ($activity->type) {
                                                ScheduleDay::TYPE_LECTURE => 1,
                                                ScheduleDay::TYPE_ATTESTATION => 4,
                                                ScheduleDay::TYPE_EXAMINATION => 6,
                                                default => 0
                                            };
                                        }
                                    }
                                    ?>
                                    <td class="fs-6 col-1 text-center">
                                        <?= $hours . ' ' . MainHelper::getNounPluralForm($hours, 'час', 'часа', 'часов') ?>
                                    </td>
                                <?php endfor; ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="users-list-control">
                    <?php if ($user->status->level >= 4): ?>
                        <div class="user-select-none">
                            <div
                                    class="fs-5 link-secondary text-uppercase fw-bold mb-3"
                                    onclick="changeControls(<?= "performance$model->id" ?>)"
                            >
                                Статистика
                            </div>
                        </div>
                    <?php endif; ?>
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
            </div>
        <?php endforeach; ?>
    </div>
</section>
