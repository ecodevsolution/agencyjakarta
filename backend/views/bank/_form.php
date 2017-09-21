<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Bank */
/* @var $form yii\widgets\ActiveForm */
?>

	<div class="row">
        <div class="col-md-12 portlets">
            <div class="panel">
				<div class="panel-header panel-controls ">
					<h3><i class="fa fa-university"></i><strong>Bank </strong> | Add Bank Name</h3>			
				</div>				
                <div class="panel-content">

					<?php $form = ActiveForm::begin(); ?>

					<?= $form->field($model, 'bank_name')->textInput(['maxlength' => 50]) ?>

					<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>

					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
