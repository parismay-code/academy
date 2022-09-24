<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\ChangeLectureForm;
use app\models\ScheduleDay;
use app\models\DayLecture;

/** @var yii\web\View $this
 * @var ChangeLectureForm $model
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
?>
    <h4 class="mb-4">Изменения расписания | <?= "$title, $date" ?></h4>

<?php $form = ActiveForm::begin([
    'id' => 'change-schedule-lecture-form',
    'layout' => 'horizontal',
    'options' => ['class' => 'w-75 m-auto mt-5'],
    'fieldConfig' => [
        'template' => "{beginWrapper}{label}{input}{error}{endWrapper}",
        'horizontalCssClasses' => [
            'wrapper' => '',
        ],
    ],
]); ?>

<?= Html::submitInput('Изменить', ['class' => 'btn btn-outline-success w-100 p-3']) ?>
<?php ActiveForm::end(); ?>