<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Terms */

$this->title = $model->idterms;
$this->params['breadcrumbs'][] = ['label' => 'Terms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="terms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idterms], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idterms], [
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
            'idterms',
            'role',
            'termsofuse:ntext',
        ],
    ]) ?>

</div>
