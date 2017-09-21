<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\City */

$this->title = 'Update City: ' . ' ' . $model->idcity;
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idcity, 'url' => ['view', 'id' => $model->idcity]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
