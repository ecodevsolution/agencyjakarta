<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserExperience */

$this->title = 'Create User Experience';
$this->params['breadcrumbs'][] = ['label' => 'User Experiences', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-experience-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
