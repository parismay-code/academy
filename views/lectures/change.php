<?php

use app\models\ChangeLectureForm;
use app\models\User;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/**
 * @var yii\web\View $this
 * @var ChangeLectureForm $model
 * @var string $title
 */

$user = User::findOne(Yii::$app->user->id);

$this->title = "Vampires Academy | $title";
?>

<section>
    <h4 class="mb-5"><?= $title ?></h4>
    <?php $form = ActiveForm::begin([
        'id' => 'change-lecture-form',
        'options' => ['class' => 'w-75 m-auto'],
        'fieldConfig' => [
            'template' => "{input}\n{error}",
        ],
    ]); ?>

    <?=
    $form->field($model, 'title')
        ->textInput([
            'placeholder' => 'Название лекции',
            'autofocus' => true,
        ])
    ?>

    <?=
    $form->field($model, 'details')
        ->textarea([
            'placeholder' => 'Лекционный материал',
            'rows' => 7,
        ]);
    ?>

    <?= Html::submitInput('Подтвердить', [
        'class' => 'btn btn-success text-white text-uppercase text-decoration-none font-weight-bold fs-5 p-2 fw-bold w-100',
        'name' => 'submit-button'
    ]) ?>

    <?php ActiveForm::end(); ?>
</section>