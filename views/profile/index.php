<?php

require_once Yii::$app->basePath . '/helpers/mainHelper.php';

use app\models\User;
use app\models\Lecture;
use app\models\StudentVisit;
use app\models\ScheduleDay;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */

$user = User::findOne(Yii::$app->user->id);

$lectures = Lecture::findAll(['status' => Lecture::STATUS_SUBMITTED]);

$this->title = 'Vampires Academy | Профиль';
?>

<section>
    <h4 class="mb-3">Профиль <?= Html::encode($user->username) ?></h4>
    <div class="d-flex flex-row align-items-center justify-content-between w-25 mb-5">
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
    <div
            class="d-flex flex-row align-items-start justify-content-between p-4"
            style="background-color:#00000080; border-radius: 1rem;"
    >
        <div>
            <div class="mb-4">
                <h5>Имя персонажа:</h5>
                <h4 class="fw-normal"><?= $user->username ?></h4>
            </div>
            <div class="mb-4">
                <h5>ID на сервере:</h5>
                <h4 class="fw-normal"><?= $user->fivem_id ?></h4>
            </div>
            <div class="mb-4">
                <h5>Дискорд:</h5>
                <h4 class="fw-normal"><?= $user->discord ?></h4>
            </div>
            <div class="mb-4">
                <h5>Формация:</h5>
                <h4 class="fw-normal"><?= $user->formationUsers[0]->formation->name ?></h4>
                <h4 class="fw-normal">
                    Глава формации:
                    <span class="fw-semibold">
                        <?= $user->formationUsers[0]->formation->leader_name ?>
                    </span>
                </h4>
                <h4 class="fw-normal">
                    Первый заместитель:
                    <span class="fw-semibold">
                        <?= $user->formationUsers[0]->formation->deputy_leader_name ?>
                    </span>
                </h4>
                <h4 class="fw-normal">
                    Второй заместитель:
                    <span class="fw-semibold">
                        <?= $user->formationUsers[0]->formation->lawyer_name ?>
                    </span>
                </h4>
            </div>
            <div class="mb-4">
                <h5>Статус:</h5>
                <h4 class="fw-normal"><?= $user->status->label ?></h4>
            </div>
            <div class="mb-4">
                <h5>Дата регистрации:</h5>
                <h4 class="fw-normal"><?= date('d.m.Y в H:i:s', strtotime($user->registration_date)) ?></h4>
            </div>
        </div>
        <?php
        $userVisit = StudentVisit::findOne(['student_id' => $user->id]);
        ?>
        <div>
            <?php if ($user->status->level === 1): ?>
                <h5>Успеваемость:</h5>
                <table class="table text-white">
                    <thead>
                    <tr>
                        <th class="col-3 fs-5">Лекция</th>
                        <th class="col-1 text-center fs-5">Статус</th>
                        <th class="col-1 text-center fs-5">Дата</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($lectures as $lecture): ?>
                        <?php
                        $visitedLecture = $user->isLectureVisited($lecture->id);

                        $status = $visitedLecture ? 'Посещена' : 'Не посещена';

                        if ($visitedLecture && $visitedLecture->is_individual) {
                            $status = 'Индивидуально';
                        }
                        ?>
                        <tr>
                            <td class="col-3 fs-5"><?= Html::encode("$lecture->id. $lecture->title") ?></td>
                            <td class="col-1 text-center fs-5">
                                <?= $status ?>
                            </td>
                            <td class="col-1 text-center fs-5">
                                <?php if ($visitedLecture): ?>
                                    <?= date('d.m.Y', strtotime($visitedLecture->date)) ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php elseif ($user->status->level >= 2 && $user->status->name !== 'admin'): ?>
                <h5>Отработанные часы:</h5>
                <table class="table table-bordered text-white">
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
                            <th class="fs-5 text-center"><?= "$date <br> $title" ?></th>
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
                            <td class="text-center">
                                <?= $hours . ' ' . getNounPluralForm($hours, 'час', 'часа', 'часов') ?>
                            </td>
                        <?php endfor; ?>
                    </tr>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</section>
