<?php

use yii\helpers\Html;
use backend\models\UserForm;
use backend\models\TimelineApply;
use backend\models\City;
use backend\models\Kontrak;
use backend\models\Timeline;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recomendation detail';
$this->params['breadcrumbs'][] = ['label' => 'Recomendation', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timeline-index">
	<div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header panel-controls">
                  <h3><i class="fa fa-table"></i> <strong>List Recomendation </strong> Event <?= $event->title_event; ?></h3>
                </div>
                <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>City</th>
                        <th>High</th>
                        <th>Face</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php
							$mod = Kontrak::find()
								->where(['idkontrak'=>$event->idkontrak])
								->One();
							$count = TimelineApply::find()
								->where(['counter'=>4])
								->AndWhere(['idtimeline'=>$event->idtimeline])
								->count();
							$count = $mod->jumlah_pramuniaga - $count;
							
							foreach($model as $models):
						?>
                      <tr>
                        <td><?= Html::a(ucwords($models['first_name']), ['//spg/detail-spg','id' => $models['id']],['target'=>'_Blank']);  ?></td>
                        <td><?= $models['city_name'] ?></td>
                        <td><?= $models['high']?></td>
                        <td><?= $models['face']?></td>
						<?php
							$this->registerCss("
								.f{
									color:red;
								}
								.w{
									color:orange;
									font-size:14px;
								}
							");
							
						if($models['status'] == 1){
							echo"<td><span class='fa fa-exclamation-triangle fa-2x w'></span></td>";
						}else{
							if($models['counter']  == 2){
						?>
							<td>
							<?php
								if($count ==  0){
									echo"<span class='fa fa-times-circle fa-2x f'></span>";
								}else{
							?>
							<?= Html::a('', ['//recomendation-client/approve', 'id' => $models['idtimelineapply'], 'status'=>4, 's'=>$models['id'], 'val'=>1],['class'=>'fa fa-check-circle-o']); ?> | <?= Html::a('', ['//recomendation-client/approve', 'id' => $models['idtimelineapply'], 'status'=>5,'s'=>$models['id'], 'val'=>0],['class'=>'fa fa-times-circle f']); ?>
								<?php } ?>
							
							<?php }else{
								if($count >  0){
									if($models['counter'] == 4){
										echo"<td><span class='fa fa-check-circle-o fa-2x'></span></td>";
									}else if($models['counter'] == 5 || $models['counter'] == 3){
										echo"<td><span class='fa fa-times-circle fa-2x f'></span></td>";
									}else{
										echo"<td><span class='fa fa-exclamation-triangle fa-2x w'> Waiting Approval</span></td>";
									}
								}else{
									echo"<td>".Html::a('', ['//recomendation-client/approves', 'id' => $models['idtimelineapply'], 'status'=>2],['class'=>'fa fa-reply fa-2x'])."</td>";
								}
							}
						}
						?>
                      </tr>
						<?php endforeach; ?>
                    </tbody>
                  </table>
				  <?php					
					echo "<p style='color:red'>max recomendation sales promotion girls   ".$mod->jumlah_pramuniaga . "  Left   ". $count."</p>";
					//echo $kontrak->idkontrak;					
				  ?>
                </div>
            </div>
        </div>
    </div>
</div>
