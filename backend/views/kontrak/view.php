<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Kontrak */

$this->title = $model->idkontrak;
$this->params['breadcrumbs'][] = ['label' => 'Kontraks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kontrak-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idkontrak], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idkontrak], [
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
            'idkontrak',
            'nama_event',
            'perwakilan',
            'email:email',
            'telp',
            'tanggal_mulai',
            'tanggal_akhir',
            'jam_mulai',
            'jam_akhir',
            'durasi_kontrak',
            'lokasi',
            'alamat:ntext',
            'jml_spg',                        
            'total_harga',                        
            'tanggal',
        ],
    ]) ?>

</div>
