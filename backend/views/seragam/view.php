<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Seragam */

$this->title = $model->idseragam;
$this->params['breadcrumbs'][] = ['label' => 'Seragams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seragam-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idseragam], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idseragam], [
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
            'idseragam',
            'deskripsi_seragam',
            'harga',
        ],
    ]) ?>

</div>
