<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\DownPayment */

$this->title = 'Update Down Payment: ' . ' ' . $model->iddownpayment;
$this->params['breadcrumbs'][] = ['label' => 'Down Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddownpayment, 'url' => ['view', 'id' => $model->iddownpayment]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="down-payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
