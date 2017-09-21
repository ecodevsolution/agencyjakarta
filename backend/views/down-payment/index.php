<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DownPaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Down Payments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="down-payment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Down Payment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'iddownpayment',
            'idkontrak',
            'nominal',
            'keterangan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
