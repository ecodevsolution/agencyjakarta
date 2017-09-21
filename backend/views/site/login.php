<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\UserForm;
use yii\helpers\ArrayHelper;
use backend\models\City;
use yii\bootstrap\Modal;
use yii\web\View;
use  yii\web\Session;
use yii\helpers\Url;

//use yii\web\View;
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

/*$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];*/

/*
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
*/
$session = Yii::$app->session;

	$session->remove('LoginErr');
	$session->remove('Login');

?>	


        <div class="container" id="login-block">
            <i class="user-img icons-faces-users-03"></i>
            <div class="account-info">
                <a href="<?= Yii::$app->homeUrl; ?>" class="logo"></a> 
                <h3>Please Fill All Field To Start Your Session.</h3>
		
            </div>
            <div class="account-form">
				<?php
						
					if($session->has('Login') || $session->has('LoginErr') ){
						if($session->has('Login')){
							$session->remove('LoginErr');
							$label = "success";
							$field = $session->get('Login');
							
						}else if($session->has('LoginErr')){
							$session->remove('Login');
							$label = "danger";
							$field = $session->get('LoginErr');
							
						}
				?>
				<div class="alert alert-<?= $label; ?>" role="alert">
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<?= $field; ?>
				</div>
				<?php } ?>
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
                    <h3><strong>Sign in</strong> to your account</h3>
					
       
                    <div class="append-icon">
                        <?= $form
							->field($model, 'username')
							->label(false)
							->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
                        <i class="icon-user"></i>
                    </div>
                    <div class="append-icon m-b-20">
                         <?= $form
							->field($model, 'password')
							->label(false)
							->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                        <i class="icon-lock"></i>
                    </div>
					 <?= Html::submitButton('Sign in', ['class' => 'btn btn-lg btn-dark btn-rounded ladda-button', 'name' => 'login-button']) ?>
					 <?= Html::a(' Forgot Password',['site/password-reset'],['class'=>'fa fa-unlock']); ?>			
				<?php ActiveForm::end(); ?>
			</div>
														
			<div style="float:right;">
				<?php $this->registerCss(" 
						a {
							cursor: pointer;
						}
					");
				?>
               <?php
				$form = ActiveForm::begin();
				$model_spg = new UserForm();
				Modal::begin([
					'toggleButton' => [ 'tag' => 'a', 'label'=>'New user? Signup'],
					'header' => '<i class="glyphicon glyphicon-lock"></i> Signup',
					'footer'=>Html::submitButton($model_spg->isNewRecord ? 'Create' : 'Update', ['class' => $model_spg->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
				]);
				

						echo $form->field($model_spg, 'username')->textInput(['maxlength' => 100, 'placeholder'=>'Enter your Username...'])->label(false);
						echo $form->field($model_spg, 'first_name')->textInput(['maxlength' => 100,'placeholder'=>'Enter your First name...'])->label(false);
						echo $form->field($model_spg, 'Last_name')->textInput(['maxlength' => 100, 'placeholder'=>'Enter your Last name...'])->label(false);
						echo $form->field($model_spg, 'idcity')->dropDownList(
															ArrayHelper::map(City::find()->all(),'idcity', 'city_name'),
															['prompt'=>'- Your City -']
														)->label(false);
												
						echo $form->field($model_spg, 'email')->textInput(['maxlength' => 100, 'placeholder'=>'Enter your Email...'])->label(false);
						echo $form->field($model_spg, 'password_hash')->passwordInput(['placeholder'=>'Enter password...'])->label(false);

						
					
				Modal::end();
				ActiveForm::end();
				
				 if ($model_spg->load(Yii::$app->request->post())){
					 //------------------------------- BEGIN Email--------------------------------------------
						include "inc/fungsi_email.php";
						EmailRegister($model_spg->email, $model_spg->first_name,  $model_spg->Last_name,  $model_spg->username,  $model_spg->password_hash);
						//------------------------------- END Email--------------------------------------------
						$model_spg->password_hash = Yii::$app->security->generatePasswordHash($model_spg->password_hash);
						$model_spg->created_at = date('Ydmh');
						$model_spg->generateAuthKey();
						$model_spg->kelengkapan= "P";
						$model_spg->idrole = 2;
						$model_spg->idcategory = 0;
						//return $this->redirect('/user/index',302);
						//var_dump($model_spg);

						if($model_spg->save()){
							$session->setFlash('Login', 'Registered successfully , Please Login to complete your Registration!');
							
						}else{
							$session->setFlash('LoginErr', 'Username Already Exist !');
						}
						
						
						//return $this->render('index-spg');
						//$model = new LoginForm();
						//$model->refresh();
						//var_dump($session);
					}
					
			?>
            </div>

        </div>
		 
        <!-- END LOCKSCREEN BOX -->
        <p class="account-copyright">
            <span>Copyright © <?= date("Y");?> </span><span><a href="http://adinugraha.my.id">Agencyjakarta.co.id</a></span>.<span>All rights reserved.</span>
        </p>
