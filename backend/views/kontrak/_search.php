<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KontrakSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kontrak-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idkontrak') ?>

    <?= $form->field($model, 'idclient') ?>

    <?= $form->field($model, 'perwakilan') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'telp') ?>

    <?php // echo $form->field($model, 'tanggal_mulai') ?>

    <?php // echo $form->field($model, 'tanggal_akhir') ?>

    <?php // echo $form->field($model, 'jam_mulai') ?>

    <?php // echo $form->field($model, 'jam_akhir') ?>

    <?php // echo $form->field($model, 'durasi_kontrak') ?>

    <?php // echo $form->field($model, 'lokasi') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'jumlah_pramuniaga') ?>

    <?php // echo $form->field($model, 'status_rekomendasi') ?>

    <?php // echo $form->field($model, 'pramuniaga_rekomendasi') ?>

    <?php // echo $form->field($model, 'budget') ?>

    <?php // echo $form->field($model, 'status_kontrak') ?>

    <?php // echo $form->field($model, 'status_pembayaran') ?>

    <?php // echo $form->field($model, 'tanggal') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
