<?php

namespace backend\controllers;

use Yii;
use backend\models\Timeline;
use backend\models\Sendmail;
use backend\models\UserForm;
class MailController extends \yii\web\Controller
{	
	
    public function actionIndex()
    {
		$model = Timeline::find()
				->joinWith('kontrak')
				->all();
        return $this->render('index',[
			'model'=>$model,
		]);
    }
	
	public function actionDetailSend($id)
    {
		if(isset($_POST['check'])){	
			$modelt = Timeline::findOne($_POST['id']);
			foreach($_POST['check'] as $key => $check):
				$models = UserForm::findOne($check);
				//var_dump($models->email);
				
				Yii::$app->mailer->compose()
				->setFrom('no-reply@agencyjakarta.co.id')
				->setTo($models->email)
				->setSubject('Events')
				->setHtmlBody('<img src="http://portal.agencyjakarta.co.id/images/events/'.$modelt->img_event.'" /><br/><br/>
							'.$modelt->description.'<br/> Untuk Login Silahkan klik <a href="http://portal.agencyjakarta.co.id">disini</a>')
				->send();
				var_dump($models->email);
				$modelss = new Sendmail();
				$modelss->idspg = $models->id;
				$modelss->idtimline = $_POST["id"];
				$modelss->date = date("Y-m-d");
				$modelss->save();
			endforeach;
			return Yii::$app->getResponse()->redirect("?r=mail/detail-send&id=".$id."");
			//$kode = $id;
			//$model = UserForm::find()
			//		->where(['kelengkapan'=>'Y'])
			//		->all();
			//return $this->render('detail',[
			//	'model'=>$model,
			//	'kode'=>$kode,
			//]);
		}else{
			$kode = $id;
			$model = UserForm::find()
					->where(['kelengkapan'=>'Y'])
					->AndWhere(['idrole'=>2])
					->all();
			return $this->render('detail',[
				'model'=>$model,
				'kode'=>$kode,
			]);
			
		}
    }
 

}
