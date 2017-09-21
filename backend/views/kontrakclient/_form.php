<?php
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\UserForm;
use dosamigos\tinymce\TinyMce;
use backend\models\Seragam;
use backend\models\Teamleader;
use dosamigos\ckeditor\CKEditor;


$root = '@web';
$this->registerJsFile($root."/js/plugins.js",		
	['depends' => [\yii\web\JqueryAsset::className()],
	'position' => View::POS_HEAD]);     
	
?>
<script>
		( function($) {
			
			$(document).ready(function()
			{
				$('#kontrak-status_rekomendasi').change(function()
				{
					var field = $('#kontrak-pramuniaga_rekomendasi').val();
					var recomendation = $('#kontrak-status_rekomendasi').val(); 
					if(recomendation == 'Y'){
						$('#kontrak-pramuniaga_rekomendasi').val('');
						$('#kontrak-pramuniaga_rekomendasi').removeAttr('readonly');
					}else if(recomendation == 'N'){ 
						$('#kontrak-pramuniaga_rekomendasi').val('0');
						$('#kontrak-pramuniaga_rekomendasi').attr('readonly','readonly');  
						
					}
				});
		
			});
			

		} ) ( jQuery );
</script>
<div class="user-form-form">
		<div class="col-lg-12">
			<div class="tab-content">
				<div class="tab-pane active" id="style">
					<!-- Circle -->
					<?php $form = ActiveForm::begin([
						'options'=>[
									'data-style'=>'circle',
									'role'=>'form',
									'class'=>'wizard'],
									]); ?>
						<div class="wizard-div current wizard-circle">
					
							<fieldset class="withScroll show-scroll">
								<legend>Personal Information</legend>
								<div class="row">
									<div class="col-lg-6">
										<input type="hidden" value="<?= Yii::$app->user->identity->id?>" name="client" />
										<div class="form-group">
											<label for="hight">Nama Perwakilan</label>
											<?= $form->field($model, 'perwakilan')->textInput()->label(false)?>
										</div>
										<div class="form-group">
											<label for="hight">Email</label>
											<?= $form->field($model, 'email')->textInput()->label(false)?>
										</div>
										
										<div class="form-group">
											<label for="weight">Phone Number</label>
											<?= $form->field($model, 'telp')->textInput()->label(false)?>
										</div>						
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											<label for="hight">Start Time</label>
											<?= $form->field($model, 'jam_mulai')->textInput(['class'=>'timepicker form-control'])->label(false)?>
										</div>
										
										<div class="form-group">
											<label for="hight">End Time</label>
											<?= $form->field($model, 'jam_akhir')->textInput(['class'=>'timepicker form-control'])->label(false)?>
										</div>			
										<div class="form-group">
											<label>Start Date</label>
											<?= $form->field($model, 'tanggal_mulai')->textInput(['class'=>'date-picker form-control'])->label(false)?>
										</div>
										
										<div class="form-group">
											<label>End Date</label>
											<?= $form->field($model, 'tanggal_akhir')->textInput(['class'=>'date-picker form-control'])->label(false)?>
										</div>
									</div>
								</div>
							</fieldset>
							
							
							
							<fieldset>
								<legend>Location Address</legend>
								<div class="row">									
										
									<div class="col-lg-12">
										<div class="form-group">
											<label for="hight">Location</label>
											<?= $form->field($model, 'lokasi')->textInput()->label(false)?>
										</div>
										
										<div class="form-group">
											<label for="hight">Address</label>
											<?= $form->field($model, 'alamat')->widget(CKEditor::className(), [
												'options' => ['rows' => 6],
												'preset' => 'advanced'
											])->label(false) ?>
										</div>			
									</div>
								</div>
							</fieldset>
							
							
							
							<fieldset>
								<legend>Final step</legend>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="hight">Total SPG(Minimum 2 Person)</label>
											<?= $form->field($model, 'jumlah_pramuniaga')->textInput()->label(false)?>
										</div>
										
										<div class="form-group">
											<label for="hight">Need Recomendation</label>
											  <?= $form->field($model, 'status_rekomendasi')->dropDownList(['Y' => 'Yes', 'N' => 'No'], ['prompt' => '-Choose-'])->label(false) ?>
										</div>
										<div class="form-group">
											<label>Total Recomendation</label>
											<?= $form->field($model, 'pramuniaga_rekomendasi')->textInput(['value'=>0, 'readonly'=>true])->label(false)?>
										</div>
										<div class="form-group">
											<label>Budget/Person</label>
											<?= $form->field($model, 'budget')->textInput()->label(false)?>
										</div>
										<div class="form-group">
											<label for="hight">Uniform</label>
											 <?= $form->field($model, 'idseragam')->dropDownList(
													ArrayHelper::map(Seragam::find()->all(),'idseragam', 'deskripsi_seragam'),
													['prompt'=>'- Choose -']
												)->label(false)
											?>
										</div>

									</div>
	
									<div class="col-lg-6">
										<div class="form-group">
										<?= $form->field($model, 'description_spg')->widget(CKEditor::className(), [
											'options' => ['rows' => 6],
											'preset' => 'advanced'
										])->label('SPG Description'); ?>

										</div>
										<br/>
										<div class="form-group">
											<label for="hight">Team Leader</label>
											<?= $form->field($model, 'idtl')->radioList(array('1'=>'Use','0'=>'Not Use'))->label(false); ?>
										</div>	
									</div>
								</div>
							</fieldset>
					
						</div>		
					<?php ActiveForm::end(); ?>
				</div>
            </div>
  
        </div>	
	</div>


