<?php

use app\models\User;
use app\models\Lecture;
use yii\helpers\Html;
use app\models\ChangeLectureForm;

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

</section>