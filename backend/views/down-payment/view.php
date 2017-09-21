<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\DownPayment */

$this->title = $model->iddownpayment;
$this->params['breadcrumbs'][] = ['label' => 'Down Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="down-payment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->iddownpayment], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->iddownpayment], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'iddownpayment',
            'idkontrak',
            'nominal',
            'keterangan',
        ],
    ]) ?>

</div>
