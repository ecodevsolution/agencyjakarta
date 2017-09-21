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
use backend\models\UserCategory;
use wbraganca\dynamicform\DynamicFormWidget;

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
		
		( function($) {
			
			$(document).ready(function()
			{				
				$('#kontrak-total_harga').val('0'); 	
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
									'role'=>'form',									
									'id' => 'dynamic-form']		
									]); ?>
						<div class="wizard-div current wizard-circle">
					
							<fieldset>								
								<div class="panel panel-default">
									<div class="panel-heading"><h4><i class="glyphicon glyphicon-user"></i> Contract Information </h4></div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Client</label>
										
												<?= $form->field($model, 'idclient')->dropDownList(
														ArrayHelper::map(UserForm::find()->where(['idrole'=>'3'])->all(),'id', 'username'),
														['prompt'=>'- Choose -']
													)->label(false)
												?>
											</div>
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
								</div>
							</fieldset>
							
							
							
							<fieldset>
								<div class="panel panel-default">
									<div class="panel-heading"><h4><i class="glyphicon glyphicon-map"></i> Contract Location </h4></div>
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
								</div>
							</fieldset>
							
							
							
							<fieldset>
								<div class="panel panel-default">
									<div class="panel-heading"><h4><i class="glyphicon glyphicon-user"></i> Contract Description </h4></div>
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Event Name</label>
												<?= $form->field($model, 'nama_event')->textInput()->label(false)?>
											</div>
											<div class="form-group">
												<label for="hight">Total SPG(Minimum 2 Person)</label>
												<?= $form->field($model, 'jml_spg')->textInput()->label(false)?>
											</div>
																															
											<div class="form-group">
												<label>Total Price</label>
												<?= $form->field($model, 'total_harga')->textInput(['readonly'=>true])->label(false)?>
											</div>
											<div class="form-group">
												<label for="hight">Uniform</label>
												<?= $form->field($model, 'idseragam')->dropDownList(
														ArrayHelper::map(Seragam::find()->orderBy(['idseragam'=>SORT_DESC])->all(),'idseragam', 'deskripsi_seragam'),
														['prompt'=>'- Choose -']
													)->label(false)
												?>
											</div>
											
										</div>
		
										<div class="col-lg-6">
											<div class="form-group">
											<?= $form->field($model, 'description_spg')->widget(CKEditor::className(), [
												'options' => ['rows' => 4],
												'preset' => 'basic'
											])->label('SPG Description (Job Desc and Criteria)'); ?>
	
											</div>
											<!-- <br/>-->
											<div class="form-group">
												<label for="hight">Team Leader</label>
												<?php 
													$model->idtl = '0';
												?>
												<?= $form->field($model, 'idtl')->radioList(array('1'=>'Use','0'=>'Not Use'))->label(false); ?>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
							
							<fieldset>
								<legend>Detail Grade Spg</legend>
								<div class="panel panel-default">
									<div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Grade SPG </h4></div>
									<div class="panel-body">
										<?php DynamicFormWidget::begin([
											'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
											'widgetBody' => '.container-items', // required: css class selector
											'widgetItem' => '.item', // required: css class
											'limit' => 100, // the maximum times, an element can be cloned (default 999)
											'min' => 1, // 0 or 1 (default 1)
											'insertButton' => '.tambah-item', // css class
											'deleteButton' => '.hapus-item', // css class
											'model' => $detail[0],
											'formId' => 'dynamic-form',
											'formFields' => [
												'idcategory',
												'jumlah',
												'diskon',
												'harga',
											],
										]);
											
										?>
					
										<div class="container-items"><!-- widgetContainer -->
											<?php foreach ($detail as $i => $details): ?>										
											<div class="item panel panel-default"><!-- widgetBody -->
												<div class="panel-heading">
													<h3 class="panel-title pull-left">Add Grade</h3>
													<div class="pull-right">
														<button type="button" class="tambah-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
														<button type="button" class="hapus-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="panel-body">
													
													<div class="row">																							
														<div class="col-md-6 col-xs-12">
														<?php
															$modelx = UserCategory::find()								
															->all();
															$data = array();
														?>
															
															<label>SPG</label>
															
															<?php
																foreach ($modelx as $modelxy)
																$data[$modelxy->idcategory] = 'Grade '.$modelxy->grade . ' - '. number_format($modelxy->price,0,".",",");     
																echo $form->field($details, "[{$i}]idcategory")->dropDownList($data ,array('prompt' => '--Choose--'))->label(false);	 
														
															?>															
															<?= $form->field($details, "[{$i}]jumlah")->textInput()->label('Total') ?>
														</div>
														<div class="col-md-6 col-xs-12">
															<?= $form->field($details, "[{$i}]diskon")->textInput()->label('Discount(Amount)') ?>
															<?= $form->field($details, "[{$i}]harga")->textInput(['id'=>'price'])->label('Price') ?>
														</div>
													</div>
												</div><!-- .row -->
											</div>
											<?php endforeach; ?>
										</div>
										<div class="form-group">											
											<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
										</div>
										</div>
										<?php DynamicFormWidget::end(); ?>
									</div>
								</div>								
							</fieldset>	
						</div>		
					<?php ActiveForm::end(); ?>
				</div>
            </div>
  
        </div>	
	</div>


<?php
	$this->registerJs("
		$(document).on('change', '#price', function(){ 

			var total = 0;
			$('.ing').each(function() { 
				total = total + parseInt($(this).val()); 
			});
			$('#kontrak-total_harga').val(total); 

			});	
	
	")
?>