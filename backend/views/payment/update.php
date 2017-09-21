<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Payment */

$this->title = 'Update Payment: ' . ' ' . $model->idpayment;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idpayment, 'url' => ['view', 'id' => $model->idpayment]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
