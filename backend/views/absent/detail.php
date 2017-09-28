<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\UserForm;
use yii\helpers\ArrayHelper;
use backend\models\DetailAbsent;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shift';
$this->params['breadcrumbs'][] = ['label' => 'Absent', 'url' => ['index']];
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
							<th>Backup</th>
						</tr>
						</thead>
						<tbody>
							<?php
								if($models){
							$x = 0;
								foreach($models as $model):
									
								$x++;
								
								$jml = DetailAbsent::find()
									->joinWith(['absent'])
									->where(['idjadwal'=>$_GET['id']])
									->andWhere(['tanggal'=>date("Y-m-d")])
									->andWhere(['shift'=>$_GET['shift']])
									->andWhere(['iduser'=>$model->iduser])
									->count();
								if ($jml == 1){
									$text = "* You already <b>ONCE<b/> for SHIFT ".$_GET['shift'];
								}else if($jml == 2){
									$text = "* You already <b>ALL ABSENT<b/> for SHIFT ".$_GET['shift'];
								}else{	
									$text="";
								}
							if($jml == 0 || $jml == 1){
							?>
							<tr>
								<td><?= $x ?></td>
								<td><?= $model->userForm->first_name ." ". $model->userForm->Last_name?></td>
								<td>
									<input type="hidden" name="user[]" value="<?= $model->iduser?>">
									<input type="checkbox" name="absent[]" value="1"> Present
									<input type="checkbox" name="absent[]" value="2"> Absent
									<input type="checkbox" name="absent[]" value="3"> Subtitute
								</td>
								<td width="50%"> 
									<select name="subtitute[]" class="form-control">
										<option value="-"></option>
										
										<?php
											$user = UserForm::find()
													->where(['idrole'=>2])
													->andWhere(['active_work'=>0])
													->orderBy(['first_name'=>SORT_ASC])
													->all();
													
											foreach($user as $users):
										?>
											<option value="<?= $users->id?>"><?= $users->first_name.' '.$users->Last_name?></option>
										<?php endforeach; ?>
									</select>
								</td>
							</tr>
							<?php }else{} endforeach; ?>
							
						</tbody>
						
					</table>
					
					<p class="text-danger"><?= $text ?> </p>
					
                </div>
              </div>
            </div>
		</div>
		<?php
			if($jml == 0 || $jml == 1){
		?>
		<div class="col-md-4 panel">
			
			 <?= $form->field($modelAbs, 'verifikator')->textInput(['maxlength' => 50]) ?>
				<div class="form-group text-right">
					<?= Html::submitButton('Submit', ['class' =>'btn btn-primary']) ?>
				</div>
		</div>
			<?php  } ?>
		<?php } ?>
	<?php ActiveForm::end(); ?>