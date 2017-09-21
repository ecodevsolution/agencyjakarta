<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserExperience */

$this->title = 'Update User Experience: ' . ' ' . $model->idexperience;
$this->params['breadcrumbs'][] = ['label' => 'User Experiences', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idexperience, 'url' => ['view', 'id' => $model->idexperience]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-experience-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
