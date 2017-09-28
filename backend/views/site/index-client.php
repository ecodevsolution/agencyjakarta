<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use dmstr\widgets\Alert;
use backend\models\Timeline;
use backend\models\Kontrak;
?>

    <div class="row m-t-10">
		<div class="col-xlg-2 col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="panel">
				<div class="panel-content widget-info">
					<div class="row">
						<div class="left">
							<i class="fa fa-thumbs-up bg-green"></i>
						</div>
						<div class="right">	
							<?php 
								$status = 'N';
								$done = Kontrak::find()
									->where(['idclient'=>Yii::$app->user->identity->id])
									->andWhere(['status_kontrak'=>'E'])
									->count();
							?>
							<p class="number countup" data-from="0" data-to="52000"><?= $done ?></p>
							<p class="text"></p>
							<p class="text"><?= Html::a("Contract Done",['kontrakclient/index']); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="col-xlg-2 col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="panel">
				<div class="panel-content widget-info">
					<div class="row">
						<div class="left">
							<i class="fa fa-users bg-blue"></i>
						</div>
						<div class="right">
							<?php 
								$contract = Kontrak::find()
									->where(['idclient'=>Yii::$app->user->identity->id])
									->andWhere('status_kontrak!= :status',['status'=>'N' , 'status'=>'E'])
									->count();
							?>
							<p class="number countup" data-from="0" data-to="575" data-suffix="k"><?= $contract ?></p>
							<p class="text"><?= Html::a("Contract",['kontrakclient/index']); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="col-xlg-2 col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="panel">
				<div class="panel-content widget-info">
					<div class="row">
						<div class="left">
							<i class="fa fa-usd bg-red"></i>
						</div>
						<div class="right">
						<?php 
							$payment = Kontrak::find()
									->where(['idclient'=>Yii::$app->user->identity->id])
									->andWhere(['status_pembayaran'=>'U'])
									->count();
						?>
							<p class="number countup" data-from="0" data-to="463" data-suffix="k"><?= $payment ?></p>
							<p class="text"><?= Html::a("Unpaid Payment",['payment/invoice']); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	
	<div class="row">
		<div class="col-md-4 col-sm-6 portlets">
			<div class="panel">
				<div class="panel-header panel-controls">
					<h3><i class="icon-list"></i> <strong>Last </strong> Event</h3>
				</div>
				<div class="panel-content">
					<ul class="todo-list ui-sortable">
						<?php
							$model = Timeline::find()
									->joinWith(['kontrak'])
									->where(['idclient'=>Yii::$app->user->identity->id])
									->orderBy(['idkontrak'=>SORT_DESC])
									->limit(5)
									->all();
							foreach($model as $models):
						?>
						<li class="high">
							<span class="span-check">
								<input id="task-1" type="checkbox" data-checkbox="icheckbox_square-blue" />
								<label for="task-1"></label>
							</span>
							<span class="todo-task"><?= $models->kontrak->nama_event; ?></span>
							<div class="todo-date clearfix">
								<div class="completed-date"></div>
								<div class="due-date">Due on <span class="due-date-span"><?= date("d M Y",strtotime($models->kontrak->tanggal_mulai)).' - ', date("d M Y",strtotime($models->kontrak->tanggal_akhir))?></span></div>
							</div>
							<span class="todo-options pull-right">
								<a href="javascript:;" class="todo-delete"><i class="icons-office-52"></i></a>
							</span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="col-md-4 col-sm-6 portlets">
			<div class="widget widget_calendar bg-dark">
				<div class="multidatepicker"></div>
			</div>
		</div>
    </div>