<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FaceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faces';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="face-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Face', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idface',
            'face',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
