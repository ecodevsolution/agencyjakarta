<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KontrakSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kontrak';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kontrak-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kontrak', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idkontrak',
            'perwakilan',
            'email:email',
            'telp',
            // 'tanggal_mulai',
            // 'tanggal_akhir',
            // 'jam_mulai',
            // 'jam_akhir',
            // 'durasi_kontrak',
            // 'lokasi',
            // 'alamat:ntext',
            // 'jumlah_pramuniaga',
            // 'status_rekomendasi',
            // 'pramuniaga_rekomendasi',
            // 'budget',
            // 'status_kontrak',
            // 'status_pembayaran',
            // 'tanggal',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
