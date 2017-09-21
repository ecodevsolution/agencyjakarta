<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

	<div class="row">
        <div class="col-md-12 portlets">
            <div class="panel">
				<div class="panel-header panel-controls ">
					<h3><i class="fa fa-building-o"></i><strong>City </strong> | Add City</h3>			
				</div>				
                <div class="panel-content">

					<?php $form = ActiveForm::begin(); ?>

					<?= $form->field($model, 'city_name')->textInput(['maxlength' => 50]) ?>

					<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>

					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
