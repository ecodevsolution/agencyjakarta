<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Position;
use backend\models\City;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form-form">
		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'username')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'first_name')->textInput(['maxlength' => 50]) ?>

		<?= $form->field($model, 'Last_name')->textInput(['maxlength' => 100]) ?>
		
		<label for="position">Position</label>
		<?= $form->field($model, 'idposition')->dropDownList(
				ArrayHelper::map(Position::find()->all(),'idposition', 'position_name'),
				['prompt'=>'- Choose -']
			) ->label(false)
		?>
		<label for="city">City</label>
		<?= $form->field($model, 'idcity')->dropDownList(
				ArrayHelper::map(City::find()->all(),'idcity', 'city_name'),
				['prompt'=>'- Choose -']
			)  ->label(false)
		?>
		
		<label for="password">Password</label>
		<?= $form->field($model, 'password_hash')->textInput(['maxlength' => 255]) ->label(false)?>

		<?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>

		<div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>
          
    </div>