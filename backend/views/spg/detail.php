<?php
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use backend\models\UserContact;
use backend\models\UserImage;
use backend\models\Timeline;
use backend\models\DetailJadwal;
use backend\models\Jadwal;
use backend\models\Kontrak;
use backend\models\UserForm;
use backend\models\UserDocument;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\UserCategory;

$root = '@web';

$this->registerJsFile("https://code.jquery.com/jquery-1.11.3.min.js",
		['depends' => [\yii\web\JqueryAsset::className()],
		'position' => View::POS_END]);
			
			
$this->registerJsFile($root."/pretty/js/jquery.prettyPhoto.js",
		['depends' => [\yii\web\JqueryAsset::className()],
		'position' => View::POS_END]);
	
$this->registerJs("
		
		$('a[rel^=prettyPhoto]').prettyPhoto();
				
	");

	if (Yii::$app->user->isGuest){
		
		echo Yii::$app->getResponse()->redirect('?r=site/login');
	}
   
?>        
	<div class="page-content page-app page-profil">
        <div class="col-lg-12 col-md-12">
		
            <div class="row profil-header" >
				<div class="col-lg-9 col-md-12">
					<div class="row">
						<div class="col-xs-4 profil-img">
							<?php
								$count = UserImage::find()->where(['iduser'=>$model->id])->count();
								if($count == 0){ ?>
									<img src="backend/assets/global/images/avatars/avatar3_big.png" class="img-responsive img-circle" alt="Default">			
								<?php }else{?>
							<?php 									
							$usr = UserImage::find()
									->from('user_image')
									->joinWith('userForm')
									->orderBy(['iduserimage' => SORT_ASC])
									->where(['iduser'=>$model->id])
									->Limit(1)
									->all();
							?>
							<?php foreach ($usr as $usrs): ?>
								<a href="images/profile/800x/<?= $usrs->image_upload; ?>" rel="prettyPhoto">
									<img src="images/profile/400x/<?= $usrs->image_upload;?>" class="img-responsive img-circle" width="200px" height="200px" alt="<?= $usrs->title;?>">
								</a>
							<?php endforeach; ?>
							<?php } ?>
							
						</div>
						<div class="col-xs-8 p-l-0 col-map">
							<img src="backend/assets/global/images/gallery/4.jpg" alt="profil">
						</div>
					</div>
					<div class="row header-name">
						<div class="col-xs-9">
							<?php
								$forms = UserForm::find()
										->joinWith('bank')
										->joinWith('face0')
										->joinWith('userExperience')
										->where(['id'=>$model->id])
										->one();
								
							?>
							<div class="name"> <?= $forms->first_name .' '. $forms->Last_name;?> 
								<?php if($forms->kelengkapan == 'P' || $forms->kelengkapan != 'Y') { ?>
									<i style="color:#FF1000" class="fa fa-times-circle"></i>
								<?php } else { ?>
									<i class="fa fa-check-circle"></i>
								<?php } ?>
							</div>
							<div class="profil-info"><i class="icon-present"></i><?= $forms->bod;?></div>
							
							
							<?php $phone = UserContact::find()->where(['iduser'=>$model->id, 'title'=>'Primary'])->one(); ?>
							<?php
								if(Yii::$app->user->identity->idrole != 3){
							?>
							<div class="profil-info"><i class="icon-call-end"></i><?php try{echo $phone->contact_number;}catch(Exception $e){{echo '-';}} ?></div>
								<?php } else echo '';?>
						</div>
						<div class="col-xs-3 moments">
							<div class="num-moments c-primary countup" data-from="0" data-to="137" data-delay="2000" data-suffix="+" data-duration="6">0</div>
							<div class="text-center">Moments</div>
						</div>
					</div>
				</div>
				
				
				<div class="col-lg-3 col-md-12 user-friends">
					<div class="row m-r-0">
					<?php
						$img = UserImage::find()
							->joinWith('userForm')
							->orderBy(['iduserimage' => SORT_DESC])
							->where(['iduser'=>$model->id])
							->Limit(3)
							->all();
					?>
					<?php foreach ($img as $imgs): ?>
						<div class="col-sm-4">
							<a href="images/profile/800x/<?= $imgs->image_upload; ?>" rel="prettyPhoto[galery1]">
								<img src="images/profile/400x/<?= $imgs->image_upload;?>" class="img-responsive img-thumbnail" alt="<?= $imgs->title;?>">
							</a>
							
						</div>
					<?php endforeach; ?>
					</div>
					
					<div class="row m-r-0">
						<div class="col-sm-12">
							 <div class="profil-sidebar-element m-t-20">
									<h3><strong>RATING</strong></h3>
									<div id="stars" class="stars pull-left">
										<span class="fa fa-star-o c-primary"></span>
										<span class="fa fa-star-o c-primary"></span>
										<span class="fa fa-star-o c-primary"></span>
										<span class="fa fa-star-o c-primary"></span>
										<span class="fa fa-star-o c-primary"></span>
									</div>
									<div class="sidebar-number pull-right">0/5</div>
								</div>
							</div>
					</div>
					<?php
						if(Yii::$app->user->identity->idrole == 3){
							
						}else{
					?>
					<div class="row m-r-0">
						<div class="col-sm-12">
							<h3><strong>DOCUMENT</strong></h3></hr>
							<?php
							
								$doc = UserDocument::find()
									->where(['iduser'=>$model->id])
									->all();
								
								foreach($doc as $docs):	
							?>
								<a href="file/<?=$docs->file_upload;?>"><?= $docs->title; ?></a></br>
							<?php endforeach; ?>
						</div>
					</div>
						<?php } ?>
				</div>				
			</div>
			<?php
				try{
			?>
            <div class="profil-content">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-4">
							<?php 
									
										$form = ActiveForm::begin();
											echo $form->field($model, 'idcategory')->dropDownList(
											ArrayHelper::map(UserCategory::find()->all(),'idcategory', 'grade'),
											['prompt'=>'- Choose Grade -'])->label(false);				 
								?>	
											<div class="form-group">
												<?= Html::submitButton('Aktifkan', ['class' => 'btn btn-success']) ?>
												<?= Html::a('Tolak',['spg/reject','id' => $model->id],['class'=>'btn btn-danger']); ?>			
											</div>			
											
										<?php ActiveForm::end(); 
									
							?>
						</div>
						<table class="table table-striped">
							<tbody>
								<tr>
									<td width="15%">High</td>
									<td width="1%">:</td>
									<td><?= $forms->high; ?></td>
								</tr>
								<tr>
									<td>Weight</td>
									<td>:</td>
									<td><?= $forms->weight; ?></td>
								</tr>
								<?php 
									if($forms->language == 1){
										$set = 'Vary Bad';
									}else if($forms->language == 2){
										$set = 'Enough';
									}else if($forms->language == 3){
										$set = 'Good';
									}else if($forms->language == 4){
										$set = 'Very Good';
									}
								?>
								<tr>
									<td>English</td>
									<td>:</td>
									<td><?= $set; ?></td>
								</tr>
								<tr>
									<td>Face</td>
									<td>:</td>
									<td><?= $forms->face0->face; ?></td>
								</tr>
								<tr>
									<td>Experience</td>
									<td></td>
									<td><?php try{echo $forms->userExperience->deskripsi;}catch(Exception $e){{echo '-';}} ?></td>
								</tr>
								<?php
									if(Yii::$app->user->identity->idrole == 1){
								?>
								<tr>
									<td>Bank Account Name</td>
									<td>:</td>
									<td><?= $forms->bank->bank_name; ?></td>
								</tr>
								<tr>
									<td>Bank Account Number</td>
									<td>:</td>
									<td><?= $forms->account_number; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
            </div>
				<?php }catch(Exception $e){{echo '-';}}?>
        </div>
		
		
       
    </div>
    <!-- END PAGE CONTENT -->