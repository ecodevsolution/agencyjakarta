<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\UserImage;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Sales Promotion Girls: ' . ' ' . $models->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Photo', 'url' =>['update-photo', 'id' => $models->id]];
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
				$idimg = $_GET['id'];
				$img   = UserImage::find()
					  ->where(['iduser' => $idimg])
					  ->all();
			
			foreach($img as $imgs):
		?>
				<div class="item panel panel-default"><!-- widgetBody -->
					<div class="panel-heading">
						<h3 class="panel-title pull-left">Current Image</h3>
						<div class="pull-right">
						   <?= Html::a('', ['delimg', 'id' => $imgs->iduserimage], ['class' => 'glyphicon glyphicon-minus']) ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12">
								<?php 
									if(isset($imgs->image_upload)){
										echo Html::img('images/profile/400x/'.$imgs->image_upload,['width'=>93]); 
										
									}
								?>	
							</div>
							<div class="col-sm-12">
								<?= $form->field($imgs, 'title')->textInput(['readonly' => true]) ?>
							</div>
						</div><!-- .row -->
					</div>
				</div>
			<?php endforeach; } ?>
			
			<div class="panel panel-default">
				<div class="panel-heading"><h4><i class="glyphicon glyphicon-camera"></i> Photo </h4></div>
				
				<div class="panel-body">
					 <?php DynamicFormWidget::begin([
						'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
						'widgetBody' => '.container-items', // required: css class selector
						'widgetItem' => '.item', // required: css class
						'limit' => 4, // the maximum times, an element can be cloned (default 999)
						'min' => 1, // 0 or 1 (default 1)
						'insertButton' => '.add-item', // css class
						'deleteButton' => '.remove-item', // css class
						'model' => $modelsImage[0],
						'formId' => 'dynamic-form',
						'formFields' => [
							'image_upload',
							'title',
						],
					]); ?>

					<div class="container-items"><!-- widgetContainer -->
					<?php foreach ($modelsImage as $i => $modelImage): ?>
						<div class="item panel panel-default"><!-- widgetBody -->
							<div class="panel-heading">
								<h3 class="panel-title pull-left">Add Photo</h3>
								<div class="pull-right">
									<button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
									<button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-body">
								<?php
									// necessary for update action.
									if (! $modelImage->isNewRecord) {
										echo Html::activeHiddenInput($modelImage, "[{$i}]iduserimage");
									}
								?>
								<div class="row">
									<div class="col-sm-6">
										<?= $form->field($modelImage, "[{$i}]image_upload")->fileInput() ?>
										<label> Description </label>
										<?= $form->field($modelImage, "[{$i}]title")->textInput(['maxlength' => true])->label(false) ?>
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


