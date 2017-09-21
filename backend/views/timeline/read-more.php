<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

use backend\models\Timeline;
use backend\models\TimelineApply;

function format_rupiah($angka){
		$rupiah = number_format($angka,0,',','.');
		return $rupiah;
		
	}
?>        

	<div class="row" style="background-color:#fff;">
	   
        <div class="col-lg-9" style=" margin-left: 12%;margin-top: 2%; margin-bottom: 2%;margin-right: 12%">
            <!-- BEGIN TIMELINE CONTENT -->			
				
			<?php
				$timline = Timeline::find()
					->where(['idtimeline'=>$model->idtimeline])
					->all();
				
				foreach ($timline as $timelines):
				$countApp = TimelineApply::find()->where(['idtimeline'=> $timelines->idtimeline])->count();
			?>
			
			<div class="timeline-block">				
				<div class="timeline-content">
					<div class="timeline-heading clearfix">
						<h2 class="pull-left"><strong><?= $timelines->title_event; ?></h2>
						<div class="pull-right">
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
                    ?>
					
                    <img src="images/events/<?= $timelines->img_event;?>" class="img-responsive" hover-img" alt="">
					<?= $timelines->description; ?>
					<?php if(Yii::$app->user->identity->kelengkapan != "P"){ ?>
						<p>Fee : <?= format_rupiah($timelines->price);?></p>
					<?php } ?>
					

					<?php 
						if(Yii::$app->user->identity->kelengkapan == "P"){
							echo "";
						}else{
						
					
						$count = TimelineApply::find()
							->where(['idspg'=>Yii::$app->user->identity->id])
							->Andwhere(['idtimeline'=>$timelines->idtimeline])
							->count();
							
						if($count == 0){
					?>
					
					<?= Html::a('Apply', ['//timeline-apply/apply', 'id' => $timelines->idtimeline, 'usr'=>Yii::$app->user->identity->id],['class'=>'fa fa-check-circle-o fa-2x']); ?><span class="pull-right badge badge-dark"><?= $countApp; ?></span>
						<p></p>
					<?php } else{
							$apply = TimelineApply::find()
							->where(['idspg'=>Yii::$app->user->identity->id])
							->Andwhere(['idtimeline'=>$timelines->idtimeline])
							->all();
							foreach($apply as $applies):
					?>
					
					<?= Html::a('Cancel', ['//timeline-apply/cancel', 'id' => $applies->idtimelineapply],['class'=>'f fa fa-times fa-2x']); ?><span class="pull-right badge badge-dark"><?= $countApp; ?></span>
									
						<?php endforeach; } } ?>
						<p></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	
    <!-- END PAGE CONTENT -->
	
