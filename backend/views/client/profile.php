<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use backend\models\UserContact;
use backend\models\UserImage;
use backend\models\Timeline;
use backend\models\DetailJadwal;
use backend\models\Jadwal;
use backend\models\Kontrak;
?>        
	<?php 
		if(Yii::$app->user->identity->bod == "" || Yii::$app->user->identity->face == "" || Yii::$app->user->identity->kelengkapan == "P"){
	?>
	<div class="alert alert-danger media fade in">
        <h4 class="alert-title">Your Personal data has not complete !!</h4>
		<p>Please edit your personal data to complete personal information</p>
    </div>
	<?php }?>
	<div class="page-content page-app page-profil">
        <div class="col-lg-12 col-md-12">
		
            <div class="row profil-header" >
				<div class="col-lg-9 col-md-12">
					<div class="row">
						<div class="col-xs-4 profil-img">
							<?php
								$count = UserImage::find()->where(['iduser'=>Yii::$app->user->identity->id])->count();
								if($count == 0){ ?>
									<img src="backend/assets/global/images/avatars/avatar3_big.png" class="img-responsive img-circle" alt="Default">			
								<?php }else{?>
							<?php 									
							$usr = UserImage::find()
									->joinWith('userForm')
									->orderBy(['iduserimage' => SORT_ASC])
									->where(['iduser'=>Yii::$app->user->identity->id])
									->Limit(1)
									->all();
							?>
							<?php foreach ($usr as $usrs): ?>
								<img src="images/profil_page/<?= $usrs->image_upload;?>" class="img-responsive img-circle" alt="<?= $usrs->title;?>">
							<?php endforeach; ?>
							<?php } ?>
							
						</div>
						<div class="col-xs-8 p-l-0 col-map">
							<img src="backend/assets/global/images/gallery/4.jpg" alt="profil">
						</div>
					</div>
					<div class="row header-name">
						<div class="col-xs-9">
							<div class="name"> <?= Yii::$app->user->identity->username;?> <i class="fa fa-check-circle"></i></div>
							<div class="profil-info"><i class="icon-present"></i><?= Yii::$app->user->identity->bod;?></div>
							<?php $count = UserContact::find()->where(['iduser'=>Yii::$app->user->identity->id])->count(); ?>
							<div class="profil-info"><i class="icon-call-end"></i><?= $count; ?></div>
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
							->where(['iduser'=>Yii::$app->user->identity->id])
							->Limit(3)
							->all();
					?>
					<?php foreach ($img as $imgs): ?>
						<div class="col-sm-4">
							<img src="images/profil_page/<?= $usrs->image_upload;?>" class="img-responsive img-circle" alt="<?= $usrs->title;?>">
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
					
					<div class="row m-r-0">
						<div class="col-sm-12">
							<?= Html::a('Edit Profile', ['update', 'id' =>  Yii::$app->user->identity->id], ['class'=>'btn btn-block btn-primary bd-0 no-bd']) ?>
							</div>
					</div>
				</div>				
			</div>
			
            <div class="profil-content">
				<div class="row">
					<div class="col-md-7">
						
						
						<div class="row">
							<?php
								$timline = Timeline::find()
											->orderBy(['idtimeline' => SORT_DESC])
											->Limit(3)
											->all();
							?>
							<div class="col-sm-5">
								<?php foreach ($timline as $timlines): ?>
									<div class="item hover-effect">
										<div class="user">
											<img src="images/events/<?= $timlines->img_event;?>" class="img-responsive hover-img" alt="">
										</div>
										<div class="comment">
											<?= $timlines->description;?>                 
										</div>
										<div class="more">
											<div class="row">
												<div class="col-sm-4 like">
													<?php
														$this->registerCss("
															.f{
																color:#828282;
															}
														");
													?>
													<i class="fa fa-heart"></i><?= Html::a('Like', ['apply', 'e' => $timlines->idtimeline], ['class'=>'f']) ?>
												</div>
											</div>	
										</div>
									</div>
								<?php endforeach; ?>
							</div>
							
							<?php
								$events = Jadwal::find()
									->joinWith('detailJadwal')
									->joinWith('kontrak')
									->joinWith('timeline')
									->orderBy(['jadwal.idjadwal' => SORT_DESC])
									->where(['iduser'=>Yii::$app->user->identity->id])
									->all();
								$i = 0;
							?>
							<?php foreach ($events as $eventss): 
								$i++; ?>
							<div class="col-sm-7">
								<?php if($i%2 == 0){ ?>
									<div class="item item-comment">
										<div class="user">
											<div class="clearfix">
												<p class="time-icon"><i class="icon-calendar"></i></p>
												<p></p>
												<p class="place"><i class="icon-pointer"></i> <?= $eventss->kontrak->lokasi;?></p>
												<p class="time"><?= $eventss->kontrak->tanggal_mulai;?></p>
											</div>
											<div class="comment">
												<p class="c-primary m-b-0"><strong><?= $eventss->timeline->title;?></strong></p>
											</div>
											<div class="item-event-detail">
												<p><?= $eventss->timeline->tanggal_mulai;?> - <?= $eventss->timeline->tanggal_akhir;?><span class="separator"></span></p>
											</div>
										</div>
										<img src="images/events/<?= $eventss->timeline->img_event;?>" class="img-responsive hover-img" alt="">
										<p> <?= $eventss->timeline->description;?></p>

										<div class="more">
											<div class="row">
												<div class="col-sm-4 more-comments">
													<div class="comment-number">
														<?php 
															$countApp = TimelineApply::find()->where(['idtimeline'=> $eventss->timeline->idtimeline])->count();
														?>
														<i class="fa fa-thumbs-up"></i> Recent Apply <span class="pull-right badge badge-dark"><?= $countApp; ?></span>
													</div>
												</div>
											</div>
										</div>									
									</div>
								<?php } ?>

							</div>
						</div>
					</div>
					
					<div class="col-md-5">
						<div class="row">
							<div class="col-md-12 col-sm-6 col-xs-12">
							<?php if($i%2 != 0){ ?>
								<div class="item item-comment">
									<div class="user">
										<div class="clearfix">
											<p class="time-icon"><i class="icon-calendar"></i></p>
											<p></p>
											<p class="place"><i class="icon-pointer"></i> <?= $eventss->kontrak->lokasi;?></p>
											<p class="time"><?= $eventss->kontrak->tanggal_mulai;?></p>
										</div>
										<div class="comment">
											<p class="c-primary m-b-0"><strong><?= $eventss->timeline->title;?></strong></p>
										</div>
										<div class="item-event-detail">
											<p><?= $eventss->timeline->tanggal_mulai;?> - <?= $eventss->timeline->tanggal_akhir;?><span class="separator"></span></p>
										</div>
									</div>
										<img src="images/events/<?= $eventss->timeline->img_event;?>" class="img-responsive hover-img" alt="">
										<p> <?= $eventss->timeline->description;?></p>
									<div class="more">
										<div class="row">
											<div class="col-sm-4 more-comments">
												<div class="comment-number">
													<i class="fa fa-thumbs-up"></i> Current Apply <span class="pull-right badge badge-dark"><?= $countApp; ?></span>
												</div>
											</div>
										</div>
									</div>
									
								</div>
							<?php } ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
            </div>
        </div>
		
		
       
    </div>
    <!-- END PAGE CONTENT -->