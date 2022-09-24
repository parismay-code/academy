<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\ChangeDayLectureForm;
use app\models\ScheduleDay;
use app\models\DayLecture;
use app\models\Lecture;
use app\models\User;
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
$teachers = User::findAll([
    'status' => [
        User::STATUS_ASSISTANT,
        User::STATUS_TEACHER,
        User::STATUS_MASTER,
        User::STATUS_DEAN,
        User::STATUS_VICE_RECTOR,
        User::STATUS_RECTOR,
    ]
]);

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
        'horizontalCssClasses' => [
            'wrapper' => '',
        ],
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

<?= Html::submitInput('Изменить', ['class' => 'btn btn-outline-success w-100 p-3']) ?>
<?php ActiveForm::end(); ?>