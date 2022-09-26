<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\ChangeDayLectureForm;
use app\models\ScheduleDay;
use app\models\DayLecture;
use app\models\Lecture;
use app\models\User;
use app\models\Status;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this
 * @var ChangeDayLectureForm $model
 * @var ScheduleDay $scheduleDay
 * @var DayLecture $dayLecture
 * @var ActiveForm $form
 */

$this->title = 'Vampires Academy | Изменение расписания';

$dayData = ScheduleDay::DAYS_MAP[$scheduleDay->id];

$title = $dayData['ru'];
$timestamp = strtotime($dayData['en']);

if ($timestamp > strtotime('Sunday')) {
    $timestamp = strtotime('-1 week', $timestamp);
}

$date = date('d.m.Y', $timestamp);

$lectures = Lecture::findAll(['status' => Lecture::STATUS_SUBMITTED]);

$teacherStatusMap = Status::findAll(['name' => Status::TEACHER_STATUS_MAP]);

$teacherStatusIdMap = [];

foreach ($teacherStatusMap as $teacherStatus) {
    $teacherStatusIdMap[] = $teacherStatus->id;
}

$teachers = User::find()
    ->where(['status_id' => $teacherStatusMap])
    ->join('LEFT OUTER JOIN', 'status', 'status.id = user.status_id')
    ->orderBy('status.level')
    ->all();

foreach ($lectures as $lecture) {
    $lecture->title = "Лекция $lecture->id. $lecture->title";
}

$lectureItems = ArrayHelper::map($lectures, 'id', 'title');
$teacherItems = ArrayHelper::map($teachers, 'id', 'username');
?>
    <h4 class="mb-4">Изменения расписания | <?= "$title, $date" ?></h4>

<?php $form = ActiveForm::begin([
    'id' => 'change-schedule-lecture-form',
    'options' => ['class' => 'w-75 m-auto mt-5'],
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}",
    ],
]); ?>

<?=
$form->field($model, 'lectureId')
    ->dropDownList($lectureItems)
    ->label('Лекция');
?>

<?=
$form->field($model, 'teacherId')
    ->dropDownList($teacherItems)
    ->label('Преподаватель');
?>

<div class="custom-checkbox"></div>

<?=
$form->field($model, 'isFree')
    ->checkbox(['class' => 'form-check-input'])
    ->label('Лекция не назначена');
?>

<?= Html::submitInput('Изменить', ['class' => 'btn btn-outline-success w-100 p-3 text-uppercase fw-bold']) ?>
<?php ActiveForm::end(); ?>