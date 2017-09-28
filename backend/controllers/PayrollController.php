<?php

namespace backend\controllers;
use Yii;
use backend\models\DetailAbsent;
use backend\models\Absent;
use backend\models\DetailJadwal;
use backend\models\Payroll;
use  yii\web\Session;

class PayrollController extends \yii\web\Controller
{
    public function actionIndex()
    {
		$model = new DetailAbsent();
		
		if(isset($_POST['start'])){
			include "inc/fungsi_bulan.php";
			$session = Yii::$app->session;
			$session->setFlash('periode', 'Periode from '.tampil_bulan(date('m'),strtotime($_POST['start'])).' '.date('m'),strtotime($_POST['end']).' ');
			
			$connection = \Yii::$app->db;
			$sql = $connection->createCommand("select k.nama_event, k.tanggal_mulai, k.tanggal_akhir, j.idjadwal from jadwal 
												j join detail_jadwal dt on j.idjadwal = dt.idjadwal join timeline tl on tl.idtimeline = j.idtimeline JOIN kontrak k on tl.idkontrak =
												k.idkontrak join timeline t on k.idkontrak = t.idkontrak group by j.idjadwal");
			$models = $sql->queryAll();
			
			return $this->render('payroll',[
				'model'=>$model,
				'models'=>$models,
			]);
		}else{
			return $this->render('index',[
				'model'=>$model,
			]);
		}
    }
	public function actionDetailAbsent($id, $user)
    {
		$kode = $id;
		$model = DetailAbsent::find()
				->joinWith(['absent'])
				->where(['idjadwal'=>$id])
				->andWhere(['iduser'=>$user])
				->all();

		return $this->render('detail-absent',[
			'kode'=>$kode,
			'model'=>$model,
		]);
    }
	public function actionReportl(){
		
		return $this->render('reportl', [
					//'model'=>$model,
			]);
	}
	public function actionPeriode($id)
    {
		$model = new DetailAbsent();
		$modelpay = new Payroll();
		
		if(isset($_POST['check'])){
			
			
			foreach($_POST['check'] as $key => $check):
			$modelpay = new Payroll();
			
			$model = DetailJadwal::find()
					->where(['iduser'=>$check])
					->andWhere(['idjadwal'=>$id])
					->All();
			foreach($model as $models):
				$models->flag = 2;
				$models->save();
			endforeach;

			$present = $_POST['present'][$key];
			$absents = $_POST['absents'][$key];
			$sub = $_POST['sub'][$key];
			//$tampil = $check.",".$present.",".$absents.",".$sub;
			
			//$absent =  (explode(",",$tampil));
			$jml = $_POST['nominal'];
			//
			$modelpay->idjadwal = $id;
			$modelpay->iduser = $check;
			$modelpay->jml_masuk = $present;
			$modelpay->jml_absent = $absents;
			$modelpay->jml_subs = $sub;
			$modelpay->tanggal = date("Y-m-d");
			$modelpay->nominal = $jml;
			$modelpay->save();
			
			
			//var_dump($jml);
			endforeach;
			$url = "?r=payroll/index";
			return Yii::$app->getResponse()->redirect($url);
			//$connection = \Yii::$app->db;
			//$sql = $connection->createCommand("select * from detail_absent dt join absent a on dt.idabsent = a.idabsent 
			//								   join jadwal j on a.idjadwal = j.idjadwal 
			//								   join user u on dt.iduser = u.id group by dt.iddetail where j.idjadwal = '".$id."'");
			//$models = $sql->queryAll();
			//return $this->render('paid',[
			//	'models'=>$models,
			//]);
		}else{
			
			$connection = \Yii::$app->db;
			$sql = $connection->createCommand("select * from jadwal j 
											   join detail_jadwal dj on j.idjadwal = dj.idjadwal 
											   join user u on dj.iduser = u.id  where j.idjadwal = ".$id." and dj.flag = 1 group by dj.iduser");
			$models = $sql->queryAll();
			return $this->render('paid',[
				'models'=>$models,
				'modelpay' =>$modelpay,
			]);
		}
    }

}
