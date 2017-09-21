<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\UserForm;
use backend\models\DetailAbsent;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paid';
$this->params['breadcrumbs'][] = ['label' => 'Detail Payroll', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>    
	<?php $form = ActiveForm::begin(); ?>
		<div class="row">
			
            <div class="col-md-12 portlets">
              <div class="panel">
				  <h3><i class="icon-calendar"></i> <strong>Schedule </strong> Sales Promotion Girls</h3>
                <div class="panel-content">
				 <?php $form = ActiveForm::begin(); ?>
					<table class="table table-hover table-dynamic">
						<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Present</th>
							<th>Absent</th>
							<th>Subtitute</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
							<?php
							$x = 0;
								foreach($models as $key => $model):
								
								$present = DetailAbsent::find()
										->where(['iduser'=>$model['iduser']])
										->andWhere(['status'=>1])
										
										->count();
								$presents = $present/2;
								if ($presents < 1 ){
									$presents = 0;
								}
								$absent = DetailAbsent::find()
										->where(['iduser'=>$model['iduser']])
										->andWhere(['status'=>2])
										->count();
								$absents = $absent/2;
								if ($absents == 1 ){
									$absents = 1;
								}		
								$subs = DetailAbsent::find()
										->where(['iduser'=>$model['iduser']])
										->andWhere(['status'=>3])
										->count();
								$sub = $subs/2;
								if ($sub ==  1 ){
									$sub = 1;
								}
								$x++;
							?>
							<tr>
								<td><input type="checkbox" name="check[<?= $key?>]" value="<?= $model['iduser']?>">
								<input type="hidden" name="present[]" value="<?= $presents ?>">
								<input type="hidden" name="sub[]" value="<?= $sub ?>">
								<input type="hidden" name="absents[]" value="<?= $absents ?>">
								</td>
								<td><?= $model['first_name'] ." ". $model['Last_name']?></td>
								<td><?= $presents ?></td>
								<td><?= $absents ?></td>
								<td><?= $sub ?></td>
								<td><?=Html::a('Detail',['detail-absent','id'=>$model['idjadwal'], 'user'=>$model['iduser']]); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
                </div>
              </div>
            </div>
		</div>
		<div class="col-md-4 panel">
				<div class="form-group text-right">
					<input type="text" class="form-control" name="nominal">
					<?= Html::submitButton('Submit', ['class' =>'btn btn-primary']) ?>
				</div>
		</div>
	<?php ActiveForm::end(); ?>