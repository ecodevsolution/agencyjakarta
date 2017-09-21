<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Seragam */

$this->title = 'Update Seragam: ' . ' ' . $model->idseragam;
$this->params['breadcrumbs'][] = ['label' => 'Seragams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idseragam, 'url' => ['view', 'id' => $model->idseragam]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="seragam-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
