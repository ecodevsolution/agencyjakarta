<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model backend\models\UserExperience */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Sales Promotion Girls: ' . ' ' . $models->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Experience', 'url' =>['update-experience', 'id' => $models->id]];
$this->params['breadcrumbs'][] = ['label' => $models->first_name];
?>

<div class="user-experience-form">

    <?php $form = ActiveForm::begin(); ?>
	<?= $form->field($model, 'deskripsi')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'advanced'
    ]) ?>
	
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
