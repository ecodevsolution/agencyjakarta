<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Kontrak;
use yii\helpers\ArrayHelper;
use backend\models\Payment;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Payment';
$this->params['breadcrumbs'][] = ['label' => 'Payment', 'url' => ['index-client']];
$this->params['breadcrumbs'][] = $this->title;

function format_rupiah($angka){
		$rupiah = number_format($angka,0,',','.');
		return $rupiah;
		
	}
?>    
		<div class="row">
			
            <div class="col-md-12 portlets">
              <div class="panel">
				  <h3><i class="icon-calendar"></i> <strong>Detail Payment </strong></h3>
                <div class="panel-content">
					<table class="table table-hover table-dynamic">
						<thead>
						<tr>
							<th>#</th>
							<th>Total Payment</th>
							<th>Left Payment</th>
							<th>Keterangan</th>
							<th>Status</th>
							<th>Confirmation</th>
							<?php if(Yii::$app->user->identity->idrole == 1){?>
							<th>Action</th>
							<?php }?>
						</tr>
						</thead>
						<tbody>
							<?php
								$x = 0;
								foreach($model as $models):
									
								$x++;
								
								if($models->status == 1){
									$text = "Ok";
									$label = "success";
								}else if($models->status == 2){
									$text = "Reject";
									$label = "danger";
								}else{
									$text = "Waiting";
									$label = "warning";
								}
								
								if($models->flag == 1){
									$status = "Down Payment";
								}else if($models->flag==2){
									$status = "Full Paid";
								}
								
							?>
							<tr>
								<td><?= $x?></td>
								<td><?= format_rupiah($models->nominal); ?></td>
								<td><?= format_rupiah($models->left); ?></td>
								<td><?= $models->keterangan; ?></td>

								<td><?= $status; ?></td>
								<td><span class="label label-<?= $label; ?>"><?= $text; ?></td>
								<?php if(Yii::$app->user->identity->idrole == 1){?>
								<td><?= Html::a('Confirmation',['update','id'=>$models->idpayment]) ?> 
									<?php if($timeline->timelineApply->status == 1){ echo '| '.Html::a('',['active','id'=>$timeline->idtimeline,'c'=>$timeline->idkontrak],['class'=>'fa fa-check']);}else{echo" ";} ?>
								</td>
								<?php }?>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
                </div>
              </div>
            </div>
		</div>