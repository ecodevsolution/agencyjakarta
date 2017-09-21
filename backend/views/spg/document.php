<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\UserDocument;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Sales Promotion Girls: ' . ' ' . $models->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Document', 'url' =>['update-document', 'id' => $models->id]];
$this->params['breadcrumbs'][] = ['label' => $models->first_name];
?>

	<div class="user-form-form">
		
		<?php
			$form = ActiveForm::begin([
			'options'=>[
					'enctype'=>'multipart/form-data',
					'id' => 'dynamic-form']			
				]); 
			if(isset($_GET['id'])){
				$iddoc = $_GET['id'];
				$doc   = UserDocument::find()
					  ->where(['iduser' => $iddoc])
					  ->all();
			
			foreach($doc as $docs):
		?>
			<div class="item panel panel-default"><!-- widgetBody -->
				<div class="panel-heading">
					<h3 class="panel-title pull-left">Current Document</h3>
					<div class="pull-right">
					   <?= Html::a('', ['deldoc', 'id' => $docs->iddocument], ['class' => 'glyphicon glyphicon-minus']) ?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-12">
							<?php if(isset($docs->file_upload)){ ?>
									<a href="file/<?=$docs->file_upload;?>">Download</a>
								<?php	} ?>	
						</div>
						
					</div><!-- .row -->
				</div>
			</div>
			<?php endforeach; } ?>
			<div class="panel panel-default">
				<div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Document </h4></div>
				
				<div class="panel-body">
					 <?php DynamicFormWidget::begin([
						'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
						'widgetBody' => '.container-items', // required: css class selector
						'widgetItem' => '.item', // required: css class
						'limit' => 100, // the maximum times, an element can be cloned (default 999)
						'min' => 1, // 0 or 1 (default 1)
						'insertButton' => '.tambah-item', // css class
						'deleteButton' => '.hapus-item', // css class
						'model' => $modelsDoc[0],
						'formId' => 'dynamic-form',
						'formFields' => [
							'file_upload',
							'title',
						],
					]); ?>

					<div class="container-items"><!-- widgetContainer -->
					<?php foreach ($modelsDoc as $i => $modelDoc): ?>
						<div class="item panel panel-default"><!-- widgetBody -->
							<div class="panel-heading">
								<h3 class="panel-title pull-left">Add Curiculum Vitae</h3>
								<div class="pull-right">
									<button type="button" class="tambah-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
									<button type="button" class="hapus-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-body">
								<?php
									// necessary for update action.
									if (! $modelDoc->isNewRecord) {
										echo Html::activeHiddenInput($modelDoc, "[{$i}]iddocument");
									}
								?>
								<div class="row">
									<div class="col-sm-6">
										<?= $form->field($modelDoc, "[{$i}]file_upload")->fileInput() ?>
									</div>
								</div><!-- .row -->
							</div>
						</div>
					<?php endforeach; ?>
					</div>
					<?php DynamicFormWidget::end(); ?>
				</div>
			</div>
			<div class="form-group">
				<?= Html::submitButton('Update', ['class' =>'btn btn-success']) ?>
			</div>			
		<?php ActiveForm::end(); ?>
	</div>


