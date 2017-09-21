<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Terms */

$this->title = 'Update Terms: ' . ' ' . $model->idterms;
$this->params['breadcrumbs'][] = ['label' => 'Terms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idterms, 'url' => ['view', 'id' => $model->idterms]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="terms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
