<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DownPayment */

$this->title = 'Create Down Payment';
$this->params['breadcrumbs'][] = ['label' => 'Down Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="down-payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
