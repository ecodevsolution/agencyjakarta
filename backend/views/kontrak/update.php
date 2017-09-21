<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Kontrak */

$this->title = 'Update Kontrak: ' . ' ' . $model->idkontrak;
$this->params['breadcrumbs'][] = ['label' => 'Kontraks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idkontrak, 'url' => ['view', 'id' => $model->idkontrak]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kontrak-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'detail' => $detail,
    ]) ?>

</div>
