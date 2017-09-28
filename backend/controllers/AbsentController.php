<?php

namespace backend\controllers;
use Yii;
use backend\models\Timeline;
use backend\models\Jadwal;
use backend\models\Absent;
use backend\models\DetailJadwal;
use backend\models\DetailAbsent;



class AbsentController extends \yii\web\Controller
{
    public function actionIndex()
    {
		if(Yii::$app->user->identity->idrole == 1){
        $model = Timeline::find()
				->joinWith(['kontrak'])
				->where(['status_kontrak'=>'S'])
				->all();
		}else{
			 $model = Timeline::find()
				->joinWith(['kontrak'])
				->where(['status_kontrak'=>'S'])
				->andwhere(['idclient'=>Yii::$app->user->identity->id])
				->all();
		}
		
		return $this->render('index', [
            'model' => $model,
        ]);
    }
	 public function actionDetailAbsent($id)
    {
        
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("SELECT a.idshift, a.idjadwal FROM detail_jadwal a JOIN jadwal b ON a.idjadwal = b.idjadwal JOIN timeline c ON b.idtimeline = c.idtimeline JOIN kontrak d ON c.idkontrak = d.idkontrak where d.idkontrak = '".$id."' GROUP BY a.idshift, a.idjadwal");
		$model = $sql->queryAll();
		return $this->render('shift', [
            'model' => $model,
        ]);
    }
	
	public function actionRegEmail(){
		include "inc/fungsi_email.php";
		EmailForgotPasssword('muhamadadinugraha@gmail.com','Adi', 'Nugraha', 'adinugraha', '%6*.?,');
	//	Yii::$app->mailer->compose()
	//		->setFrom('no-reply@agencyjakarta.co.id')
	//		->setCc('bagus@agencyjakarta.co.id')
	//		->setBcc('me@adinugraha.my.id')
	//		->setTo('agencyjakarta1@gmail.com')
	//		->setSubject('Message subject')
	//		->setTextBody('Plain text content')
	//		->setHtmlBody('<b>HTML content</b>')
	//		->send();
	//	
	}
	public function actionSpgAbsent($id, $shift)
    {
			$modelAbs = new Absent();
			
			
	//	if ($modelAbs->load(Yii::$app->request->post())){
	//		$modelAbs->idjadwal = $id;
	//		$modelAbs->shift = $shift;
	//		$modelAbs->iduser = $_POST['iduser'];
	//		$modelAbs->jam = date("H:i:s");
	//		$modelAbs->tanggal = date("Y-m-d");
	//	//	$modelAbs->save();
    //    //    return $this->redirect(['index']);
    //    } else {
	//		$models = DetailJadwal::find()
	//			->joinWith(['userForm'])				
	//			->where(['idjadwal'=>$id])
	//			->Andwhere(['pembagian_kerja'=>$shift])
	//			->all();
    //        return $this->render('detail', [
    //            'modelAbs' => $modelAbs,
	//			'models'=>$models,
    //        ]);
    //    }
		if ($modelAbs->load(Yii::$app->request->post())){
		
			
			$modelAbs->idjadwal = $id;
			$modelAbs->jam = date("H:i:s");
			$modelAbs->tanggal = date("Y-m-d");
			$modelAbs->save();
			
			$max = Absent::find()->orderBy('idabsent DESC')->one();
			
			
			foreach($_POST['absent'] as $key => $absents):
				$modelDetail = new DetailAbsent();
				
				$user = $_POST['user'][$key];
				$subs = $_POST['subtitute'][$key];

				$modelDetail->idabsent = $max->idabsent;
				$modelDetail->iduser = $user;
				$modelDetail->shift = $shift;
				$modelDetail->pic = $subs;
				$modelDetail->status = $absents;
				$modelDetail->save();
				
			endforeach;
			
			$session = Yii::$app->session;
			$session->setFlash('Absent', 'Absent successfully !.');
			
			
			$model = Timeline::find()
					->joinWith(['kontrak'])
					->where(['status_kontrak'=>'S'])
					->all();
			return $this->render('index', [
				'model' => $model,
			]);
				
		}else{
			$date = date('Y-m-d');
			$models = DetailJadwal::find()
					->joinWith(['userForm'])				
					->where(['idjadwal'=>$id])					
					->Andwhere(['idshift'=>$shift])
					->AndWhere(['tanggal'=>$date])
					->all();
			return $this->render('detail',[
				'models'=>$models,
				'modelAbs' => $modelAbs,
			]);
		}
	}

}
