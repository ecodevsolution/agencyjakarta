<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserExperienceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-experience-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idexperience') ?>

    <?= $form->field($model, 'iduser') ?>

    <?= $form->field($model, 'deskripsi') ?>

    <?= $form->field($model, 'tahun') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
