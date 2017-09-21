<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Kontrak;
/* @var $this yii\web\View */
/* @var $model backend\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">
	<div class="col-lg-12">
			<div class="tab-content">
				<div class="tab-pane active" id="style">
				<?php $form = ActiveForm::begin(); ?>
				
				<?php
					if($model->isNewRecord){
				?>
				<?= $form->field($model, 'idkontrak')->dropDownList(
						ArrayHelper::map(Kontrak::find()->where(['idclient'=>Yii::$app->user->identity->id])->all(),'idkontrak', 'perwakilan'),
						['prompt'=>'- Choose -']
					)->label('Perwakilan Kontrak')
				?>
					<?php }else{?>
					<?= $form->field($model, 'idkontrak')->dropDownList(
						ArrayHelper::map(Kontrak::find()->all(),'idkontrak', 'perwakilan'),
						['prompt'=>'- Choose -']
					)->label('Perwakilan Kontrak')
				?>
					<?php }?>
				<?= $form->field($model, 'nominal')->textInput() ?>
			
				<?= $form->field($model, 'keterangan')->textArea(['maxlength' => true, 'rows'=>10]) ?>
				
				<?= $form->field($model, 'flag')->dropDownList([ '1' => 'Down Payment', '2' => 'Paid Full'], ['prompt' => '-Choose-'])->label('Type of Payment')?>
				<?php
					if(Yii::$app->user->identity->idrole == 1){
				?>
				<?= $form->field($model, 'status')->dropDownList([ '1' => 'Approve', '2' => 'Reject'], ['prompt' => '-Choose-'])->label('Confirmation Payment')?>
				<?php } ?>
				<div class="form-group">
					<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
				</div>
			
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
</div>
