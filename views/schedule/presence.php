<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\models\MarkPresenceForm;
use app\models\User;
use app\models\DayLecture;
use app\models\Formation;

/**
 * @var yii\web\View $this
 * @var MarkPresenceForm $formModel
 * @var DayLecture $dayLecture
 * @var ActiveForm $form
 */

$lecture = $dayLecture->lecture;

$formations = Formation::find()->all();
$students = User::find()
    ->join('LEFT OUTER JOIN', 'formation_user', 'user_id = user.id')
    ->where(['status_id' => 2])
    ->orderBy('formation_user.formation_id ASC')
    ->all();

$items = [];

foreach ($formations as $formation) {
    $studentsItems = [];

    foreach ($students as $student) {
        if ($student->formationUsers[0]->formation->id === $formation->id) {
            $studentsItems[$student->id] = $student->username;
        }
    }

    $items[$formation->name] = $studentsItems;
}

$this->title = 'Vampires Academy | Присутствие студентов';
?>
    <h4 class="mb-4">
        <?= "Присутствие студентов | $lecture->title, $dayLecture->time:00" ?>
    </h4>

<?php $form = ActiveForm::begin([
    'options' => ['class' => 'w-75 m-auto mt-5'],
    'fieldConfig' => [
        'template' => "{label}{input}{error}",
    ],
]); ?>

<?= $form->field($formModel, 'studentsIds')
    ->dropDownList(
        $items,
        [
            'multiple' => true,
            'style' => 'height: 30rem'
        ]
    )
    ->label('Выберите студентов из списка') ?>

<?= Html::submitInput('Отметить', ['class' => 'btn btn-outline-success w-100 p-3 text-uppercase fw-bold']) ?>
<?php ActiveForm::end(); ?>