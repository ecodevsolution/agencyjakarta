<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */

$this->title = 'Sales Promotion Girls: ' . ' ' . $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Personal Info', 'url' =>['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => $model->first_name];
?>
<div class="user-form-update">

    <?= $this->render('_form', [
        'model' => $model,
		'modelsContact' => (empty($modelsContact)) ? [new UserContact] : $modelsContact,
    ]) ?>

</div>
