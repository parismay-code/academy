<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\ChangeScheduleDayForm;
use app\models\ScheduleDay;

/** @var yii\web\View $this
 * @var ChangeScheduleDayForm $model
 * @var ScheduleDay $scheduleDay
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
    'id' => 'change-schedule-day-form',
    'layout' => 'horizontal',
    'options' => ['class' => 'w-75 m-auto mt-5'],
    'fieldConfig' => [
        'template' => "{beginWrapper}{label}{input}{error}{endWrapper}",
        'horizontalCssClasses' => [
            'wrapper' => '',
        ],
    ],
]); ?>

    <div class="form-range"></div>

<?= $form->field($model, 'type')
    ->dropDownList(ScheduleDay::TYPE_MAP)
    ->label('Тип дня') ?>

<?= $form->field($model, 'from')
    ->dropDownList([
        17 => '17:00',
        18 => '18:00',
        19 => '19:00'
    ])
    ->label('Начало дня') ?>

<?= $form->field($model, 'to')
    ->dropDownList([
        20 => '20:00',
        21 => '21:00',
        22 => '22:00'
    ])
    ->label('Конец дня') ?>

<?= Html::submitInput('Изменить', ['class' => 'btn btn-outline-success w-100 p-3']) ?>
<?php ActiveForm::end(); ?>