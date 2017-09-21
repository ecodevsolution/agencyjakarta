<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Support */

$this->title = 'Update Support: ' . ' ' . $model->idsupport;
$this->params['breadcrumbs'][] = ['label' => 'Supports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idsupport, 'url' => ['view', 'id' => $model->idsupport]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="support-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
