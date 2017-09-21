<?php



use yii\helpers\Html;

use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */

/* @var $model backend\models\UserForm */

/* @var $form yii\widgets\ActiveForm */

?>



<div class="user-form-form">

	<div class="col-lg-12">
		<div class="tab-content">
		<div class = "tab-pane active" id ="style">

    <?php $form = ActiveForm::begin(); ?>

	<label>Password</label>

    <?= $form->field($model, 'password_hash')->passwordInput() ->label(false)?>
	                                                                                                                                                
    <div class="form-group">
                                                                                                                                                     
        <?= Html::submitButton('Change Password', ['class' =>'btn btn-primary']) ?>
                                                                                                                                                     
    </div>
                                                                                                                                                     
                                                                                                                                                     
                                                                                                                                                     
    <?php ActiveForm::end(); ?>

	
	</div></div>
</div>
</div>


