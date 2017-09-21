<?php
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Position;
use backend\models\City;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;
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
				<?php
					$session = Yii::$app->session;	
					if($session->has('Updte')){
						
						echo"<div class='alert alert-success' role='alert'>
								<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
								".$session['Updte']."
							</div> ";
					}
					unset($session['Updte']);
				?>
				<div class="tab-pane active" id="style">
					<!-- Circle -->
					<?php $form = ActiveForm::begin()?>
						<div class="wizard-div current wizard-circle">
							<fieldset>
								<legend>General Information</legend>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="username">Username</label>
											<?= $form->field($model, 'username')->textInput(['maxlength' => 100])->label(false) ?>
										</div>
										<div class="form-group">
											<label for="username">Company Name</label>
											<?= $form->field($model, 'company_name')->textInput(['maxlength' => 100])->label(false) ?>
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
										<?php
											if(Yii::$app->user->identity->idrole == 1 ){
										?>
										<div class="form-group">
											<label>Status</label>
											<?= $form->field($model, 'kelengkapan')->dropDownList(['Y'=>'Enable','P'=>'Waiting Approval','N'=>'Disable'],
												['prompt'=>'- Choose -'])->label(false) ?>
										</div>
										<?php } if($model->isNewRecord){ ?>
										<div class="form-group">
											<label>Password</label>
											<?= $form->field($model, 'password_hash')->passwordInput()->label(false) ?>
										</div>
										<?php } ?>
									</div>
								</div>
							</fieldset>						
							
							<fieldset>
								<legend>Contact Information</legend>
								<div class="row">
									<div class="col-lg-12">
										<div class="form-group">
											<label for="city">City</label>
											<?= $form->field($model, 'idcity')->dropDownList(
												ArrayHelper::map(City::find()->all(),'idcity', 'city_name'),
												['prompt'=>'- Choose -']
											)->label(false)
										?>
										</div>
										<div class="form-group">
											<?= $form->field($modelAddress, 'address')->widget(CKEditor::className(), [
												'options' => ['rows' => 6],
												'preset' => 'basic'
											]) ?>
											
										</div>
										<div class="form-group">
											<label for="city">Phone</label>
											<?= $form->field($modelContact, 'contact_number')->textInput()->label(false) ?>
										</div>
									</div>
								</div>
							</fieldset><br/>
							<div class="form-group">
									<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
							</div>							
						</div>		
					<?php ActiveForm::end(); ?>
				</div>
            </div>
  
        </div>	
	</div>
