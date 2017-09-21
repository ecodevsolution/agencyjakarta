<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Face */

$this->title = 'Update Face: ' . ' ' . $model->idface;
$this->params['breadcrumbs'][] = ['label' => 'Faces', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idface, 'url' => ['view', 'id' => $model->idface]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="face-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
