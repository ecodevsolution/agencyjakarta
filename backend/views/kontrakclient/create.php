<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Kontrak */

$this->title = 'Create Kontrak';
$this->params['breadcrumbs'][] = ['label' => 'Kontrak', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kontrak-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'detail' => $detail,

    ]) ?>

</div>
