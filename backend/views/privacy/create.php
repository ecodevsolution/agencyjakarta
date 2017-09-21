<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Privacy */

$this->title = 'Create Privacy';
$this->params['breadcrumbs'][] = ['label' => 'Privacies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="privacy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
