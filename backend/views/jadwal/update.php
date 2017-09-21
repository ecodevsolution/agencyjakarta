<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Jadwal */

$this->title = 'Update Jadwal: ' . ' ' . $model->idjadwal;
$this->params['breadcrumbs'][] = ['label' => 'Jadwals', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idjadwal, 'url' => ['view', 'id' => $model->idjadwal]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jadwal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'models'=> $models,
		'modeldetail'=>$modeldetail,
    ]) ?>

</div>
