<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Kontrak;
use yii\helpers\ArrayHelper;
use backend\models\Payment;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment';
$this->params['breadcrumbs'][] = $this->title;

function format_rupiah($angka){
		$rupiah = number_format($angka,0,',','.');
		return $rupiah;
		
	}
?>    
		<div class="row">
			
            <div class="col-md-12 portlets">
              <div class="panel">
					<div class="panel-header panel-controls">
						<h3><i class="fa fa-usd"></i> <strong>Payment </strong></h3>
					</div>
				  
				  
                <div class="panel-content">				 
					<table class="table table-hover table-dynamic">
						<thead>
						<tr>
							<th>#</th>
							<th>Event Name</th>
							<th>Total Payment</th>													
							<th>Status</th>

						</tr>
						</thead>
						<tbody>
							<?php
							$x = 0;
								foreach($model as $models):							
								$x++;
								
								
								
							?>
							<tr>
								<td><?= $x?></td>
								<td><?= Html::a($models->kontrak->nama_event,['detail-payment','id'=>$models->idkontrak]); ?></td>
								<td><?= format_rupiah($models->kontrak->total_harga); ?></td>
								
								<?php
									$status = Payment::find()
											->where(['idkontrak'=>$models->idkontrak])
											->orderBy(['idpayment'=>SORT_DESC])
											->One();
									if($status){
										if($status->flag == 1){
											$statuses = "Down payment";
										}else if($status->flag == 2){
											$statuses = "Paid";
										}
									}else{
										$statuses = "Waiting Payment";
									}
								?>
								<td><?= $statuses ?></td>
								
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
                </div>
              </div>
            </div>
		</div>