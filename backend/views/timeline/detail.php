<?php

use yii\helpers\Html;
use backend\models\UserForm;
use backend\models\TimelineApply;
use backend\models\City;
use backend\models\Timeline;
use backend\models\Kontrak;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Timelines Apply';
$this->params['breadcrumbs'][] = ['label' => 'Timelines Apply Detail', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timeline-index">
	<div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                 <div class="panel-header panel-controls">
				 <?php 
					
					if($model){
						
				 ?>
                  <h3><i class="fa fa-table"></i> <strong>List Recomendation </strong> Event <?= $model[0]['nama_event']; ?></h3>
					<?php 
						if(isset($_GET['search'])){
							echo '<input action="action" onclick="history.go(-1);" type="button" value="&laquo; Back" />';
						}
					?>
                </div>
				<?php $form = ActiveForm::begin(['method'=>'GET']); 
					?>
					<input type="text" class="form-control" placeholder="Grade or Face..." style = 'width:20%;right:15px;position:absolute;' name="search" /> 					
				<?php ActiveForm::end(); ?>
				
				<br/>
               <div class="panel-content pagination2 table-responsive">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>City</th>
						<th>Grade</th>
                        <th>Email</th>
                        <th>High</th>
                        <th>Face</th>
						<th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php
							// $mod = Kontrak::find()
								// ->where(['idkontrak'=>$kontrak->idkontrak])
								// ->One();
							// $count = TimelineApply::find()
								// ->where(['counter'=>2])
								// ->AndWhere(['idtimeline'=>$id])
								// ->count();
							// $count = $mod->pramuniaga_rekomendasi - $count;
							foreach($model as $models):
						?>
                      <tr>
                        <td><?= Html::a($models['first_name'], ['//spg/detail-spg', 'id' => $models['id']]);  ?></td>
                        <td><?= $models['city_name'] ?></td>
						<td><?= $models['grade'] ?></td>
                        <td><?= $models['email'] ?></td>
                        <td><?= $models['high']?></td>
                        <td><?= $models['face']?></td>
						<td><a href="" title="Approve"><i class="fa fa-check"></i></a>  | <a href="" title="Reject"><i class="fa fa-times"></i></a></td>
                      </tr>
						<?php endforeach; ?>
                    </tbody>
                  </table>
	
                </div>
					<?php }else{
						
						echo '<strong>List Recomendation Empty</strong> ..<br/><input action="action" onclick="history.go(-1);" type="button" value="&laquo; Back" />';
					}
					?>
            </div>
        </div>
    </div>
</div>
