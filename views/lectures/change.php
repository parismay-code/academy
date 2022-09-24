<?php

use app\models\User;
use app\models\Lecture;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var Lecture $model
 */

$user = User::findOne(Yii::$app->user->id);

$this->title = 'Vampires Academy | Обновление материала';
?>

<section>
    <h4 class="mb-5">Обновление лекционного материала</h4>

</section>