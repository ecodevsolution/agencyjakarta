<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SeragamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uniforms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seragam-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Uniforms', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'deskripsi_seragam',
           //'harga',
			[
				'label' => 'Biaya',
				'attribute' =>'harga',				
				'format'=>['decimal',2]
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
