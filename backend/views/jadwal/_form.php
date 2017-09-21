<?php
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Kontrak;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\db\Query;
use backend\models\TimelineApply;
/* @var $this yii\web\View */
/* @var $model backend\models\Jadwal */
/* @var $form yii\widgets\ActiveForm */

$root = '@web';
$this->registerJsFile($root."/js/plugins.js",		
	['depends' => [\yii\web\JqueryAsset::className()],
	'position' => View::POS_END]);  
?>

	<div class="user-form-form">
		<div class="col-lg-12">
			<div class="tab-content">
				<div class="tab-pane active" id="style">
					<!-- Circle -->	
					<?php 
						$form = ActiveForm::begin([
						'options'=>[
									'data-style'=>'circle',
									'role'=>'form',
									'class'=>'wizard',
									'id' => 'dynamic-form']
									
									]); ?>
						<div class="wizard-div current wizard-circle">
							<fieldset>
								<legend>Schedule Information</legend>
								<label>Name Leader</label>
								<?= $form->field($model, 'idkontrak')->dropDownList(
										ArrayHelper::map(Kontrak::find()->all(),'idkontrak', 'perwakilan'),
										['prompt'=>'- Choose -',
										'onchange'=>'
											$.post("index.php?r=jadwal/list-kontrak&id='.'"+$(this).val(), function( data ) {
											$("#show").html( data );
											});
										'])->label(false);				 
								?>
								<div id="show">
								
								</div>
								
							</fieldset>	
							<fieldset>
								<legend>Shift</legend>
								<div class="panel panel-default">
									<div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Shift Schedule </h4></div>
									<div class="panel-body">
										<?php DynamicFormWidget::begin([
											'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
											'widgetBody' => '.container-items', // required: css class selector
											'widgetItem' => '.item', // required: css class
											'limit' => 100, // the maximum times, an element can be cloned (default 999)
											'min' => 1, // 0 or 1 (default 1)
											'insertButton' => '.tambah-item', // css class
											'deleteButton' => '.hapus-item', // css class
											'model' => $modeldetail[0],
											'formId' => 'dynamic-form',
											'formFields' => [
												'pembagian_kerja',
												'tanggal_jadwal',
												'jam_mulai',
												'jam_selesai',
											],
										]);
											$classTime = 'timepicker form-control';
										?>
					
										<div class="container-items"><!-- widgetContainer -->
											<?php foreach ($modeldetail as $i => $modeldetails): ?>
											<div class="item panel panel-default"><!-- widgetBody -->
												<div class="panel-heading">
													<h3 class="panel-title pull-left">Add Shift</h3>
													<div class="pull-right">
														<button type="button" class="tambah-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
														<button type="button" class="hapus-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="panel-body">
													<div class="row">
														
														<div class="col-sm-3">
															<label>SPG</label>
															<?= $form->field($modeldetails, "[{$i}]iduser")->dropDownList(
																ArrayHelper::map(TimelineApply::find()->joinWith('userForm')->where(['counter'=>4])->all(), 'idspg', 'userForm.first_name'))->label(false); ?>
														</div>
														<div class="col-sm-2">
															<label>Shift</label>
															<?= $form->field($modeldetails, "[{$i}]pembagian_kerja")->dropDownList([ '1' => 'Shift 1', '2' => 'Shift 2', '3' => 'Both'], ['prompt' => '-Choose-'])->label(false)?>
														</div>
														<div class="col-md-3">
															<label>Date Schedule</label>
															<?= $form->field($modeldetails, "[{$i}]tanggal_jadwal")->textInput(['class'=>'date-picker form-control'])->label(false)?>
														</div>
														<div class="col-md-2">
															<label>Start Times</label>
															<?= $form->field($modeldetails, "[{$i}]jam_mulai")->textInput(['class'=>$classTime])->label(false)?>
														</div>
														<div class="col-md-2">
															<label>End Times</label>
															<?= $form->field($modeldetails, "[{$i}]jam_selesai")->textInput(['class'=>'timepicker form-control'])->label(false)?>
														</div>
													</div>
												</div><!-- .row -->
											</div>
										</div>
										<?php endforeach; ?>
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