<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mail Event';
$this->params['breadcrumbs'][] = $this->title;
?>    
	<div class="row">
            <div class="col-md-12 portlets">
              <div class="panel">
				  <h3><i class="icon-bulb"></i> <strong>Event  </strong> Lists</h3>
                <div class="panel-content">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
						<th>#</th>
                        <th>Event Name</th>
                        <th>Detail</th>
						<th>Date</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php
						$x = 0;
							foreach($model as $models):
							$x++;
						?>
                      <tr>
					   <td><?= $x ?></td>
                        <td><?= $models->title_event ?></td>
                        <td><?= Html::a('', ['/mail/detail-send','id'=>$models->idtimeline], ['class'=>'fa fa-pencil-square-o']) ?></td>
						<td><?= $models->date_created?></td>
                      </tr>
					  <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
		</row>