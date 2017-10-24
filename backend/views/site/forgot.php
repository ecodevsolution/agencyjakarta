<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\UserForm;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\helpers\Url;

?>	


        <div class="container" id="login-block">
            <i class="user-img icons-faces-users-03"></i>
            <div class="account-info">
                <a href="<?= Yii::$app->homeUrl; ?>" class="logo"></a> 
                <h3>Please Fill Username to Forgot Password</h3>
		
            </div>
            <div class="account-form">

				<?php
					if(isset($err)){
						echo"<div class='alert alert-danger' role='alert'>
								<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
								".$err."
							</div>";
					}
				?>
				<?php
					if(isset($msg)){
						echo"<div class='alert alert-success' role='alert'>
								<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
								".$msg."
							</div>";
					}
				?>
                <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>
                    <h3><strong>Forgot Password</strong></h3>

                    <div class="append-icon">
                        <?= $form
							->field($model, 'username')
							->label(false)
							->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
                        <i class="icon-user"></i>
                    </div>

					 <?= Html::submitButton('Forgot Password', ['class' => 'btn btn-lg btn-dark btn-rounded ladda-button', 'name' => 'login-button']) ?>
					 <?= Html::a(' Sign in',['site/login'],['class'=>'fa fa-lock']); ?>			
				<?php ActiveForm::end(); ?>
			</div>


        </div>
		 
        <!-- END LOCKSCREEN BOX -->
        <p class="account-copyright">
            <span>Copyright © <?= date("Y");?> </span><span><a href="https://agencyjakarta.co.id">Agencyjakarta.co.id</a></span>.<span>All rights reserved.</span>
        </p>
