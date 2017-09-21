<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */

$this->title = 'Sales Promotion Girls';
$this->params['breadcrumbs'][] = ['label' => 'SPG Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'modelsImage' => (empty($modelsImage)) ? [new UserImage] : $modelsImage,
		'modelsDoc' => (empty($modelsDoc)) ? [new UserDocument] : $modelsDoc,
		'modelContact' => (empty($modelContact)) ? [new UserContact] : $modelContact,
    ]) ?>

</div>
