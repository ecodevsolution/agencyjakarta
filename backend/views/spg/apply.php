<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Apply Status';
$this->params['breadcrumbs'][] = $this->title;
?>    
	<div class="row">
            <div class="col-md-12 portlets">
              <div class="panel">
				  <h3><i class="icon-calendar"></i> <strong>Apply Statuses </strong> Sales Promotion Girls</h3>
                <div class="panel-content">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
						<th>#</th>
                        <th>Event Name</th>
						<th>Status</th>
						<th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php
						$x = 0;
							foreach($model as $models):
							if($models['counter'] == 1){
								$label = "warning";
								$text = "Waiting";
							}else if($models['counter'] == 2){
								$label = "success";
								$text = "Recomendation";
							}else if($models['counter'] == 3){
								$label = "danger";
								$text = "Not Recomendation";
							}else if($models['counter'] == 4){
								$label = "success";
								$text = "Approve by Client";
							}else if($models['counter'] == 5){
								$label = "danger";
								$text = "Reject by Client";
							}
							$x++;
						?>
                      <tr>
					   <td><?= $x ?></td>
                        <td><?= $models['title_event']; ?></td>
						 <td><span class="label label-<?= $label ?>"><?= $text; ?></td>
						<td><?= date("d M Y", strtotime($models['date_apply'])); ?></td>
                      </tr>
					  <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
		</row>