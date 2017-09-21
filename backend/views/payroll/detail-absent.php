<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Absent Detail';
$this->params['breadcrumbs'][] = ['label' => 'Absent', 'url' => ['absent']];
$this->params['breadcrumbs'][] = $this->title;
?>    
	<div class="row">
            <div class="col-md-12 portlets">
              <div class="panel">
				  <h3><i class="icon-calendar"></i> <strong>Absent </strong> Sales Promotion Girls</h3>
                <div class="panel-content">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
						<th>#</th>
                        <th>Verifikator</th>
						<th>Date</th>
						<th>Time</th>
						<th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php
						$x = 0;
							foreach($model as $models):
							
							if($models->status == 1){
								$status = "Present";
								$label = "success";
							}else if($models->status == 2){
								$status = "Absent";
								$label = "danger";
							}else{
								$status = "Subtitute";
								$label = "warning";
							}
							
							$x++;
						?>
                      <tr>
						<td><?= $x ?></td>
						<td><?= $models->absent->verifikator; ?></td>
						<td><?= date("d M Y", strtotime($models->absent->tanggal));  ?></td>
						<td><?= $models->absent->jam;  ?></td>
						<td><span class="label label-<?= $label ?>"><?= $status; ?></td>								
                      </tr>
					  <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
		</row>