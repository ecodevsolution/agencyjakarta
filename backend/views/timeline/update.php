<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Timeline */

$this->title = 'Update Timeline: ' . ' ' . $model->idtimeline;
$this->params['breadcrumbs'][] = ['label' => 'Timelines', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idtimeline, 'url' => ['view', 'id' => $model->idtimeline]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="timeline-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
