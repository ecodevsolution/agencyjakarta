<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserFormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idrole') ?>

    <?= $form->field($model, 'idposition') ?>

    <?= $form->field($model, 'idcity') ?>

    <?= $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'first_name') ?>

    <?php // echo $form->field($model, 'Last_name') ?>

    <?php // echo $form->field($model, 'high') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'language') ?>

    <?php // echo $form->field($model, 'face') ?>

    <?php // echo $form->field($model, 'kelengkapan') ?>

    <?php // echo $form->field($model, 'company_name') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
