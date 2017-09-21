<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */

$this->title = 'Register Client';
$this->params['breadcrumbs'][] = ['label' => 'Client Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'modelAddress'=>$modelAddress,
		'modelContact'=>$modelContact,
    ]) ?>

</div>
