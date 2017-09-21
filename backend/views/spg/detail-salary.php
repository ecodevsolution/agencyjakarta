<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TimelineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Salary Detail';
$this->params['breadcrumbs'][] = ['label' => 'Salary', 'url' => ['salary']];
$this->params['breadcrumbs'][] = $this->title;

function format_rupiah($angka){
		$rupiah = number_format($angka,0,',','.');
		return $rupiah;
		
	}
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
                        <th>Jumlah Masuk</th>
						<th>Jumlah Absent</th>
						<th>Jumlah Subtitute</th>
						<th>Nominal</th>
						<th>Date Payment</th>
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
						<td><?= $models->jml_masuk; ?></td>
						<td><?= $models->jml_absent; ?></td>
						<td><?= $models->jml_subs; ?></td>
						<td><?= format_rupiah($models->nominal); ?></td>
						<td><?= date("d M Y", strtotime($models->tanggal)); ?></td>									
                      </tr>
					  <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
		</row>