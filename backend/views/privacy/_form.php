<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Role;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model backend\models\Privacy */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="privacy-form">

    <?php $form = ActiveForm::begin(); ?>
	
	<?= $form->field($model, 'role')->dropDownList(
						ArrayHelper::map(Role::find()->all(),'idrole', 'role_name'),
						['prompt'=>'- Choose -'])->label("Akses");				 
				?>

	 <?= $form->field($model, 'privacy')->widget(TinyMce::className(), [
    'options' => ['rows' => 6],
    'language' => 'en_GB',
		'clientOptions' => [
			'plugins' => [
				"advlist autolink lists link charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			],
			'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
		]
	]);?>
	
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
