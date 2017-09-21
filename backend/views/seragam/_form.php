<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Seragam */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
        <div class="col-md-12 portlets">
            <div class="panel">
				<div class="panel-header panel-controls ">
					<h3><i class="fa fa-tag"></i><strong>Uniform </strong> | Add Uniform</h3>			
				</div>				
                <div class="panel-content">

					<?php $form = ActiveForm::begin(); ?>

					<?= $form->field($model, 'deskripsi_seragam')->textArea(['rows'=>5,'maxlength' => true]) ?>

					<?= $form->field($model, 'harga')->textInput() ?>

					<div class="form-group">
						<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
					</div>

					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
