<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Payment */

$this->title = 'Create Payment';
if(Yii::$app->user->identity->idrole == 1){
	$url = "index";
}else{
	$url = "index-client";
}
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => [$url]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
