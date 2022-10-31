<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\ScheduleDay;
use app\models\ScheduleDayLecture;
use app\models\Lecture;
use app\models\User;
use app\models\Status;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this
 * @var ScheduleDay $schedule
 * @var ScheduleDayLecture $dayLecture
 * @var ActiveForm $form
 */

$this->title = 'Vampires Academy | Изменение расписания';

$dayData = ScheduleDay::DAYS_MAP[$schedule->id];

$title = $dayData['ru'];
$timestamp = strtotime($dayData['en']);

if ($timestamp > strtotime('Sunday')) {
    $timestamp = strtotime('-1 week', $timestamp);
}

$date = date('d.m.Y', $timestamp);

$lectures = Lecture::findAll(['status' => Lecture::STATUS_SUBMITTED]);

$teacherStatusMap = Status::findAll(['name' => Status::TEACHER_STATUS_MAP]);

$teacherStatusIdMap = [];

foreach ($teacherStatusMap as $status) {
    $teacherStatusIdMap[] = $status->id;
}

$teachers = User::find()
    ->where(['status_id' => $teacherStatusIdMap])
    ->joinWith('status')
    ->orderBy('status.level DESC')
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
$form->field($dayLecture, 'lecture_id')
    ->dropDownList($lectureItems)
    ->label('Лекция');
?>
<?=
$form->field($dayLecture, 'teacher_id')
    ->dropDownList($teacherItems)
    ->label('Преподаватель');
?>

<?= Html::submitInput('Назначить', ['class' => 'btn btn-outline-success w-100 p-3 text-uppercase fw-bold']) ?>

<?php if (!$dayLecture->is_free): ?>
    <?=
    Html::a
    (
        'Освободить',
        ['schedule/vacate', 'id' => $dayLecture->id],
        ['class' => 'btn btn-outline-secondary w-100 p-3 mb-3 mt-3 text-uppercase fw-bold']
    );
    ?>
<?php endif; ?>

<?php ActiveForm::end(); ?>