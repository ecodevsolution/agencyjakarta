<?php

	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use backend\models\Kontrak;
	use yii\helpers\ArrayHelper;
	/* @var $this yii\web\View */
	/* @var $searchModel backend\models\TimelineSearch */
	/* @var $dataProvider yii\data\ActiveDataProvider */
	
	$this->title = 'Detail Invoice';
	$this->params['breadcrumbs'][] = ['label' => 'invoice', 'url' => ['invoice']];
	$this->params['breadcrumbs'][] = $this->title;
	
	include "inc/fungsi_bulan.php";
	function format_rupiah($angka){
			$rupiah = number_format($angka,0,',','.');
			return $rupiah;
			
	}
?> 
	  <!-- BEGIN PAGE CONTENT -->
        <div class="page-content panel">
			<div class="header">
				<h2><strong>Invoice</strong> <?= $kode ?></h2>
			</div>
        <div class="m-t-10 m-b-10 no-print"> 
			<?= Html::a(' Make A Payment',['create'],['class'=>'btn btn-primary m-r-10 m-b-10 fa fa-dollar m-r-10'])?>
			<?= Html::a(' Export as PDF',['print','id'=>$kode],['class'=>'fa fa-file-text m-r-10 btn btn-white m-r-10 m-b-10'])?>			
        </div>
		<div class="row invoice-page">
            <div class="col-md-12 p-t-0">
				<div class="row">
					<div class="col-md-12">
						<div class="pull-left">
							<h4 class="w-500 c-gray f-14"><strong>FROM</strong></h4>
							<img src="images/logo/Agency-Jakarta-Final1.png" class="img-responsive0" alt="themeforest">
							<address>
							<p class="width-300 m-t-10"><strong>AgencyJakarta</strong></p>
							<p class="width-300">PT Bagus Pratama Mandiri</p>
							<p class="width-300">Jalan Gardenia Blok A4 No.4 Kemang Pratama</p>
							<p class="width-300">Bekasi, 17114</p>
							<abbr title="Phone">NPWP:</abbr> 02.727.563.5-432.000
							</address>
						</div>
						<div class="pull-right">
							<h4 class="w-500 c-gray f-14"><strong>TO</strong></h4>
							
							<address>
							<p class="width-300 m-t-10"><strong><?= $model['company_name']; ?></strong></p>
							<p class="width-300"><?= $model['address']; ?></p>
							<p class="width-300"><?= $model['city_name']; ?></p>
							<abbr title="Phone">P :</abbr> <?= $model['contact_number'];?>
							</address>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 m-t-20 m-b-20">
							<p><strong>Invoice Date:</strong> <span><?= date("d M Y",strtotime($model['tanggal'])) ?></span></p>
							<p><strong>Due Date:</strong> <span><?= date("d M Y",strtotime($model['tanggal_akhir'])) ?></span></p>
							</div>
						</div>
						<table class="table">
							<thead>
							<tr>
								<th style="width:65px" class="unseen text-center">Days</th>
								<th class="text-left">DESCRIPTION</th>
								<th style="width:145px" class="text-right">PER PAX</th>
								<th style="width:95px" class="text-right">TOTAL</th>
							</tr>
							</thead>
							<tbody>
							<?php
								$x = 0;
								foreach($models as $modells):
								$x++;
							?>
							<tr class="item-row">
								<td class="delete-wpr">
								<p class="qty text-center"><?= $modells['duration']?></p>
								</td>
								<td>
								<div class="text-primary">
									<p><strong><?= $modells['first_name'].' '.$modells['Last_name']?></strong></p>
								</div>
								<p class="width-100p"><small>Sales Promotion girls untuk bekerja pada event tersebut. (<?= $modells['jumlah_pramuniaga'] ;?> Orang)</small></p>
								</td>
								<td>
								<p class="text-right cost"><font style="font-size:12px"><?= format_rupiah($modells['budget']- 100000)?> IDR</font></p>
								</td>
								<td class="text-right price"><font style="font-size:12px"><?= format_rupiah(($modells['budget']- 100000)* $modells['duration'] * $modells['jumlah_pramuniaga']) ?> IDR</font></td>
							</tr>
							<?php  endforeach; ?>
							
							<?php
								$connection = \Yii::$app->db;
								$sqll = $connection->createCommand("select IFNULL(tl.harga_tl * (datediff(k.tanggal_akhir, k.tanggal_mulai)+1),0) as teamleadder , IFNULL(tl.harga_tl,0) as harga
																 from detail_jadwal dt join 
																 jadwal j on dt.idjadwal = j.idjadwal join 
																 user u on dt.iduser = u.id join
																 kontrak k on k.idkontrak = j.idkontrak join
																 teamleader tl on tl.idtl = k.idtl where k.idkontrak = '".$kode."'");
								$tl = $sqll->queryOne();
							?>
							<tr class="item-row">
								<td class="delete-wpr">

								</td>
								<td>
								<div class="text-primary">
									<p><strong>TeamLeader</strong></p>
								</div>
								<p class="width-100p"><small>Kebutuhan Teamleader untuk bekerja pada event tersebut</small></p>
								</td>
								<td>
								<p class="text-right cost"><font style="font-size:12px"><?= format_rupiah($tl['harga'])?> IDR</font></p>
								</td>
								<td class="text-right price"><font style="font-size:12px"><?= format_rupiah($tl['teamleadder'])?> IDR </font></td>
							</tr>
							
							<?php
								$connection = \Yii::$app->db;
								$sql = $connection->createCommand("select IFNULL(COUNT(*) * unif.harga * (datediff(k.tanggal_akhir, k.tanggal_mulai)+1),0) as seragam ,  unif.harga
																 from detail_jadwal dt join 
																 jadwal j on dt.idjadwal = j.idjadwal join 
																 user u on dt.iduser = u.id join
																 kontrak k on k.idkontrak = j.idkontrak join
																 seragam unif on k.idseragam = unif.idseragam
																 where k.idkontrak = '".$kode."'");
								$srgm = $sql->queryOne();
							?>
							<tr class="item-row">
								<td class="delete-wpr">
								
								</td>
								<td>
								<div class="text-primary">
									<p><strong>Uniform</strong></p>
								</div>
								<p class="width-100p"><small>Kebutuhan Seragam untuk bekerja pada event tersebut</small></p>
								</td>
								<td>
								<p class="text-right cost"><font style="font-size:12px"><?= format_rupiah($srgm['harga'])?> IDR</font></p>
								</td>
								<td class="text-right price"><font style="font-size:12px"><?= format_rupiah($srgm['seragam'])?> IDR</font></td>
							</tr>
							
							<tr class="item-row">
								<td class="delete-wpr">

								</td>
								<td>
								<div class="text-primary">
									<p><strong>Fee Management</strong></p>
								</div>
								<p class="width-100p"><small>Fee Management for Agencyjakarta</small></p>
								</td>
								<td>
								<p class="text-right cost"><font style="font-size:12px">100.000 IDR</font></p>
								</td>
								<td class="text-right price"><font style="font-size:12px"><b><?= format_rupiah($modells['fee'] * $modells['duration']  * $x * $modells['jumlah_pramuniaga'])?> IDR</font></td>
							</tr>
							<tr>
								<td class="delete-wpr">

								</td>
								<td class="text-right no-border">
								<div><strong>Grand Total</strong></div>
								</td>
								<td class="delete-wpr">

								
								<?php
					
									$total1 = (($modells['budget']- 100000)* $modells['duration'] * $x * $modells['jumlah_pramuniaga']) + $tl['teamleadder'] + $srgm['seragam'] + ($modells['fee'] * $modells['duration']  * $x * $modells['jumlah_pramuniaga']);
								?>
								</td>
								<td class="text-right" id="total"><font style="font-size:12px"><b><?= format_rupiah($total1) ?> IDR</b></font></td>
							</tr>
							</tbody>
						</table>
						<div class="well bg-white">
							Thank you for your business. Please make sure all cheques payable to <strong>Agencyjakarta.</strong> <li>BCA No. 5271002824  A/n  Bagus Prabowo</li><li> Mandiri No. 1670001030179 A/n  PT Bagus Pratama Mandiri</li>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>