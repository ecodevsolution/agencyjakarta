<?php

use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Position;
use wbraganca\dynamicform\DynamicFormWidget;
use backend\models\City;
use backend\models\Bank;
use backend\models\UserContact;
use yii\helpers\ArrayHelper;
use backend\models\Face;
/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
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
									'enctype'=>'multipart/form-data',
									'id' => 'dynamic-form']
									
									]); ?>
						<div class="wizard-div current wizard-circle">
							<fieldset>
								<legend>Personal Information</legend>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label for="username">Username</label>
											<?= $form->field($model, 'username')->textInput(['maxlength' => 100])->label(false) ?>
										</div>
										<div class="form-group">
											<label for="firstname">First Name</label>
											<?= $form->field($model, 'first_name')->textInput(['maxlength' => 100])->label(false) ?>
										</div>
										<div class="form-group">
											<label for="lastname">Last Name</label>
											<?= $form->field($model, 'Last_name')->textInput(['maxlength' => 100])->label(false) ?>
										</div>
										<div class="form-group">
											<label for="email">Email</label>
											<?= $form->field($model, 'email')->textInput(['maxlength' => 100])->label(false) ?>
										</div>
										<div class="form-group">
											<label>City</label>
									
											<?= $form->field($model, 'idcity')->dropDownList(
													ArrayHelper::map(City::find()->all(),'idcity', 'city_name'),
													['prompt'=>'- Choose -']
												)->label(false)
											?>
										</div>
								
									</div>
									
									<div class="col-lg-6">
										<div class="form-group">
											<label for="hight">High</label>
											<?= $form->field($model, 'high')->textInput()->label(false)?>
										</div>
										
										<div class="form-group">
											<label for="weight">Weight</label>
											<?= $form->field($model, 'weight')->textInput()->label(false)?>
										</div>
										<div class="form-group">
											<label>Face</label>
											<?= $form->field($model, 'face')->dropDownList(
													ArrayHelper::map(Face::find()->all(),'idface', 'face'),
													['prompt'=>'- Choose -']
												)->label(false)
											?>
										</div>
										
										<div class="form-group">
											<label>English Language</label>
											<?= $form->field($model, 'language')->dropDownList([ '1' => 'Very Bad', '2' => 'Enough', '3' => 'Good', '4' => 'Very Good'], ['prompt' => '-Choose-'])->label(false)?>
										</div>
				
										<div class="form-group">
											<label for="bod">Birthday</label>	
										</div>

										<select name="day">
											<?php
												$day = date('d', strtotime($model->bod));
												echo"<option value ='$day'>$day</option>"; 

												for($i = 1; $i<=31; $i++){
													if($i < 10 ){
														echo"<option value='$i'>0$i</option>";   	                                                             
													}else {
														echo"<option value='$i'>$i</option>";
													}

												}

											?>

    									</select>

    
										<select name="month">
        									<?php 
												$month = date('m', strtotime($model->bod));
												echo"<option value ='$month'>$month</option>"; 	
												for($i = 1; $i<=12; $i++){
													if($i < 10 ){
														echo"<option value='$i'>0$i</option>";                                                                    
													}else {
														echo"<option value='$i'>$i</option>";

													}
												}														
											?>

   										</select>

										<select name="year">

											<?php 

												$year = date('Y', strtotime($model->bod));
												echo"<option value ='$year'>$year</option>"; 	
												for($i = 1980; $i<=2000; $i++){
													echo"<option value='$i'>$i</option>";
												}
											?>

										</select>                                                                          

										<!--	<div class="form-group">
											<label>Password</label>
											<?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => 25])->label(false) ?>
										</div> -->
									</div>
								</div>
							</fieldset>
							
							<fieldset>
								<legend>Bank Account</legend>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="bank">Bank Account</label>
												<?= $form->field($model, 'idbank')->dropDownList(
													ArrayHelper::map(Bank::find()->all(),'idbank', 'bank_name'),
													['prompt'=>'- Choose -']
												)->label(false)
											?>
										</div>
										<div class="form-group">
											<label for="bod">Account Number</label>
											<?= $form->field($model, 'account_number')->textInput(['maxlength' => 50])->label(false) ?>
										</div>
										
										
									</div>
								</div>
							</fieldset>
							
							<fieldset>
								<legend>Contact Info</legend>
								
								<?php
								
									if(isset($_GET['id'])){
										$idcontact = $_GET['id'];
										$contact   = UserContact::find()
											  ->where(['iduser' => $idcontact])
											  ->all();
									
									foreach($contact as $contacts):
								?>
								<div class="item panel panel-default"><!-- widgetBody -->
									<div class="panel-heading">
										<h3 class="panel-title pull-left">Current Contact</h3>
										<div class="pull-right">
										   <?= Html::a('', ['delcontact', 'id' => $contacts->idcontactuser], ['class' => 'glyphicon glyphicon-minus']) ?>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-sm-12">
												<?= $form->field($contacts, 'title')->textInput(['readonly' => true]) ?>
											</div>
											<div class="col-sm-12">
												<?= $form->field($contacts, 'contact_number')->textInput(['readonly' => true]) ?>
											</div>
										</div><!-- .row -->
									</div>
								</div>
								<?php endforeach; } ?>
								<div class="panel panel-default">
									<div class="panel-heading"><h4><i class="glyphicon glyphicon-tag"></i> Contact </h4></div>
									<div class="panel-body">
										 <?php DynamicFormWidget::begin([
											'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
											'widgetBody' => '.container-items', // required: css class selector
											'widgetItem' => '.item', // required: css class
											'limit' => 4, // the maximum times, an element can be cloned (default 999)
											'min' => 1, // 0 or 1 (default 1)
											'insertButton' => '.tmbh-item', // css class
											'deleteButton' => '.dlt-item', // css class
											'model' => $modelsContact[0],
											'formId' => 'dynamic-form',
											'formFields' => [												
												'title',
												'contact_number',
											],
										]); ?>

										<div class="container-items"><!-- widgetContainer -->
										<?php foreach ($modelsContact as $i => $modelContact): ?>
											<div class="item panel panel-default"><!-- widgetBody -->
												<div class="panel-heading">
													<h3 class="panel-title pull-left">Add Contact</h3>
													<div class="pull-right">
														<button type="button" class="tmbh-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
														<button type="button" class="dlt-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="panel-body">
													<?php
														// necessary for update action.
														if (! $modelContact->isNewRecord) {
															echo Html::activeHiddenInput($modelContact, "[{$i}]idcontactuser");
														}
													?>
													<div class="row">
														<div class="col-sm-12">
															<?= $form->field($modelContact, "[{$i}]title")->dropDownList([ 'Primary' => 'Primary', 'Secondary' => 'Secondary'], ['prompt' => '-Choose-'])->label(false)?>
															<label> Contact Number </label>
															<?= $form->field($modelContact, "[{$i}]contact_number")->textInput(['maxlength' => true])->label(false) ?>
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
						<div class="form-group">
							<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
						</div>						
					<?php ActiveForm::end(); ?>
				</div>
            </div>
  
        </div>	
	</div>
