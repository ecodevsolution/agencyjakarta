<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DownPayment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="down-payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idkontrak')->textInput() ?>

    <?= $form->field($model, 'nominal')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
