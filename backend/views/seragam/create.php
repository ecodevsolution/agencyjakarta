<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Seragam */

$this->title = 'Create Seragam';
$this->params['breadcrumbs'][] = ['label' => 'Seragams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seragam-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
