<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schedule Detail';
$this->params['breadcrumbs'][] = ['label' => 'Schedule', 'url' => ['jadwal']];
$this->params['breadcrumbs'][] = $this->title;
?>    
	<div class="row">
            <div class="col-md-12 portlets">
              <div class="panel">
				  <h3><i class="icon-calendar"></i> <strong>Schedule </strong> Sales Promotion Girls</h3>
                <div class="panel-content">
                  <table class="table table-hover table-dynamic">
                    <thead>
                      <tr>
						<th>#</th>
                        <th>Shift</th>
						<th>Date</th>
						<th>Times</th>
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
                        <td>Shift <?= $models->pembagian_kerja; ?></td>
						<td><?= date("d M Y",strtotime($models->tanggal_mulai)).' - '.date("d M Y",strtotime($models->tanggal_akhir)) ?></td>
						<td><?= $models->jam_mulai.' - '.$models->jam_selesai; ?></td>
                      </tr>
					  <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
		</row>