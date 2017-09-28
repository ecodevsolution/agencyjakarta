<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
use backend\models\Timeline;
use yii\helpers\Html;
use backend\models\TimelineApply;

if(Yii::$app->user->identity->kelengkapan == 'P'){
$url = 'index.php?r=spg%2Fupdate&id='.Yii::$app->user->identity->id;
return Yii::$app->getResponse()->redirect($url);
}
?>


        <!-- BEGIN PAGE CONTENT -->
        <div class="row">
            <div class="col-lg-12">
              <!-- BEGIN TIMELINE CONTENT -->
				<div class="timeline-btn-day"> <i class="icon-custom-left"></i>
					<button type="button" class="btn btn-primary f-16"><strong>TIMELINE EVENTS</strong></button>
				</div>
				
				<section id="timeline">
					
					<?php
					$timeline = Timeline::find()
								->joinWith('kontrak')
								->joinWith('timelineDetail')
								->where(['>','idkategori',Yii::$app->user->identity->idcategory])
									->orderBy(['idtimeline'=>SORT_DESC])
									->all();
					$x = 0;
					foreach($timeline as $timelines): 
					$x++;
					$countApp = TimelineApply::find()->where(['idtimeline'=> $timelines->idtimeline])->count();
					if($x%2==0){
					?>
					
					<div class="timeline-block">
						<div class="timeline-icon bg-yellow">
							<i class="fa fa-tag"></i>
						</div>
						<div class="timeline-content">
							<div class="timeline-heading clearfix">
								<h2 class="pull-left"><strong><?= $timelines->kontrak->nama_event; ?></h2>
								<div class="pull-right">
									<div class="pull-left">
										<div class="timeline-day-number"><?= $x; ?></div>
									</div>
									<div class="pull-left">
										<div class="timeline-day"><?= $timelines->date_event; ?></div>
										<div class="timeline-month c-gray"><?= $timelines->author; ?></div>
									</div>
								</div>
							</div>
							<?php
                                $this->registerCss("
                                        .f{
                                                color:red;
                                        }
                                ");
                                $initialCount = 125;
                                $shortDesc = $timelines->kontrak->description_spg;
								
								$read = Html::a('Read More', ['//timeline/read-more', 'id' => $timelines->idtimeline],['class'=>'f']);
                                $shortDescription = substr($shortDesc,0,$initialCount)."..". $read;
                            ?>
                            <img src="images/events/<?= $timelines->img_event;?>" class="img-responsive" hover-img" alt="">
							<?= $shortDescription ?>
							<p></p>
							<?php 
								if(Yii::$app->user->identity->kelengkapan == "P"){
									echo "";
								}else{
							?>
								<?php 
							
										$count = TimelineApply::find()
											->where(['idspg'=>Yii::$app->user->identity->id])
											->Andwhere(['idtimeline'=>$timelines->idtimeline])
											->count();
											
									if($count == 0){
								?>
									<?= Html::a('Apply', ['//timeline-apply/apply', 'id' => $timelines->idtimeline, 'usr'=>Yii::$app->user->identity->id],['class'=>'fa fa-check-circle-o fa-2x']); ?><span class="pull-right badge badge-dark"><?= $countApp; ?></span>
								
									<?php } else{
											$apply = TimelineApply::find()
											->where(['idspg'=>Yii::$app->user->identity->id])
											->Andwhere(['idtimeline'=>$timelines->idtimeline])
											->all();
											foreach($apply as $applies):
										?>
										<?= Html::a('Cancel', ['//timeline-apply/cancel', 'id' => $applies->idtimeline, 'usr' => $applies->idspg],['class'=>'f fa fa-times fa-2x']); ?><span class="pull-right badge badge-dark"><?= $countApp; ?></span>
											
								<?php endforeach; } }?>
						</div>
					</div>
				
				
				
					<?php } else { ?>
					<div class="timeline-block">
						<div class="timeline-icon bg-yellow">
							<i class="fa fa-tag"></i>
						</div>
						<div class="timeline-content">
							<div class="timeline-heading clearfix">
								<h2 class="pull-left"><strong><?= $timelines->kontrak->nama_event; ?></strong></h2>
								<div class="pull-right">
									<div class="pull-left">
										<div class="timeline-day-number"><?= $x; ?></div>
									</div>
									<div class="pull-left">
										<div class="timeline-day"><?= $timelines->date_event; ?></div>
										<div class="timeline-month c-gray"><?= $timelines->author; ?></div>
									</div>
								</div>
							</div>
							<?php
								$this->registerCss("
									.f{
										color:red;
									}
								");
								$initialCount = 125;
								$shortDesc = $timelines->kontrak->description_spg;
								$read = Html::a('Read More', ['//timeline/read-more', 'id' => $timelines->idtimeline],['class'=>'f']);
								$shortDescription = substr($shortDesc,0,$initialCount)."..". $read;
							?>
							<img src="images/events/<?= $timelines->img_event;?>" class="img-responsive" hover-img" alt="<?= $timelines->kontrak->nama_event; ?>">			     
							<?= $shortDescription ?>
							<p></p>
							<?php 
								if(Yii::$app->user->identity->kelengkapan == "P"){
									echo "";
								}else{
							?>
							<?php 
							
									$count = TimelineApply::find()
										->where(['idspg'=>Yii::$app->user->identity->id])
										->Andwhere(['idtimeline'=>$timelines->idtimeline])
										->count();
								if($count == 0){
							?>
								<?= Html::a('Apply', ['//timeline-apply/apply', 'id' => $timelines->idtimeline, 'usr'=>Yii::$app->user->identity->id],['class'=>'fa fa-check-circle-o fa-2x']); ?><span class="pull-right badge badge-dark"><?= $countApp; ?></span>
							
								<?php } else{
										$apply = TimelineApply::find()
										->where(['idspg'=>Yii::$app->user->identity->id])
										->Andwhere(['idtimeline'=>$timelines->idtimeline])
										->all();
										foreach($apply as $applies):
									?>
									<?= Html::a('Cancel', ['//timeline-apply/cancel', 'id' => $applies->idtimeline, 'usr'=>Yii::$app->user->identity->id],['class'=>'f fa fa-times fa-2x']); ?><span class="pull-right badge badge-dark"><?= $countApp; ?></span>
										
							<?php endforeach; } }?>
						</div>
					</div>
					<?php } endforeach; ?>
				</section>
              <!-- END TIMELINE CONTENT -->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
