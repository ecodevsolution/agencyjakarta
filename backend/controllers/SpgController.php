<?php

namespace backend\controllers;

use Yii;
use backend\models\UserForm;
use common\models\User;
use backend\models\SpgSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\UserImage;
use backend\models\UserDocument;
use backend\models\UserExperience;
use backend\models\UserContact;
use backend\models\DetailJadwal;
use backend\models\DetailAbsent;
use backend\models\Timeline;
use backend\models\Payroll;
use backend\models\Model;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;
use yii\data\Pagination;
use backend\models\jadwal;


/**
 * UserFormController implements the CRUD actions for UserForm model.
 */
class SpgController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserForm models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserForm model.
     * @param integer $id
     * @return mixed
     */
	 
	public function actionReport(){
		
		
		
			
			
		if(isset($_POST['start']) && isset($_POST['end'])){
			
			$query = UserForm::find()
					->JoinWith('city')
					->where(['kelengkapan'=>$_POST['status']])
					->AndWhere(['between', 'join_date' ,$_POST['start'], $_POST['end']])
					->orderBy(['city.city_name'=>SORT_ASC]);
				
			$countQuery = clone $query;
			$pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize'=>50]);
			$model = $query->offset($pages->offset)
				->limit($pages->limit)
				->all();
			
			// $model = UserForm::find()
					// ->JoinWith('city')
					// ->where(['kelengkapan'=>$_POST['status']])
					// ->AndWhere(['between', 'join_date' ,$_POST['start'], $_POST['end']])
					// ->orderBy(['city.city_name'=>SORT_ASC])
					// ->all();
					
				
			return $this->render('report', [
					'model'=>$model,
					'pages' => $pages,
			]);
		}else{
			return $this->render('report', [
					//'model'=>$model,
			]);
		}
	}
	public function actionProfile()
    {	
			$model = new UserForm();
				return $this->render('profile', [
					'model'=>$model,
			]);
			
		//if (!\Yii::$app->user->isGuest) {
		//		$model = new UserForm();
		//		return $this->render('profile', [
		//			'model'=>$model,
		//	]);
		//}else{
		//	echo "<script>alert('Your Session Has Expired Please Login First !');</script>";
		//}
    }
	public function actionReject($id){
		
		$model = $this->findModel($id);
		$model->kelengkapan = 'N';
		$model->status = 0;
		$model->save(false);
		
		return $this->render('detail', [
				'model' => $this->findModel($id),
			]);
		
	}
	public function actionDetailSpg($id)
    {
		$model = $this->findModel($id);
		if ($model->load(Yii::$app->request->post())){
			$model->kelengkapan = 'Y';
			$model->idcategory = $model->idcategory;
			
			$model->save(false);			
			
			return $this->render('detail', [
				'model' => $this->findModel($id),
			]);
			
		}else{		
			return $this->render('detail', [
				'model' => $this->findModel($id),
			]);
		}
    }
	public function actionChangePassword($id)
    {
		$model = $this->findModel($id);
		if ($model->load(Yii::$app->request->post())){
			$model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
			$model->save(false);
		//	var_dump($model->password_hash);
			return $this->redirect(['profile']);
		}else{
			return $this->render('password', [
				'model'=>$model,
			]);
		}
    }
    public function actionView($id)
    {

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	public function actionDetailJadwal($id)
    {
		$kode = $id;
		$iduser = Yii::$app->user->identity->id;
		$model = DetailJadwal::find()
				->where(['idjadwal'=>$id])
				->andWhere(['iduser'=>$iduser])
				->all();

		return $this->render('detail-jadwal',[
			'kode'=>$kode,
			'model'=>$model,
		]);
    }
	public function actionJadwal()
    {
		// $id = Yii::$app->user->identity->id;
		// $connection = \Yii::$app->db;
		// if(Yii::$app->user->identity->idrole == 1){
		// 	$sql = $connection->createCommand("select Distinct k.idkontrak, * from timeline t join 
		// 								  kontrak k on t.idkontrak = k.idkontrak 
		// 								  join jadwal j on j.idkontrak = k.idkontrak 
		// 								  join detail_jadwal dt on j.idjadwal = dt.idjadwal AND k.status_kontrak = 'S'");
		// }else if(Yii::$app->user->identity->idrole == 2){
		// 	$sql = $connection->createCommand("select * from timeline t join 
		// 								  kontrak k on t.idkontrak = k.idkontrak 
		// 								  join jadwal j on j.idkontrak = k.idkontrak 
		// 								  join detail_jadwal dt on j.idjadwal = dt.idjadwal where dt.iduser = ".$id." AND k.status_kontrak = 'S'");
		// }
		// $model = $sql->queryAll();
		
		  $event = Jadwal::find()
                ->JoinWith(['timeline'])
                ->where(['flag_status'=>'1'])
                ->all();

		return $this->render('jadwal',[
			'event'=>$event,
		]);
    }
	public function actionAbsent()
    {
		$id = Yii::$app->user->identity->id;
		$connection = \Yii::$app->db;
		if(Yii::$app->user->identity->idrole == 1){
			$sql = $connection->createCommand("select distinct * from timeline t join 
											  kontrak k on t.idkontrak = k.idkontrak 
											  join jadwal j on j.idkontrak = k.idkontrak 
											  join absent a on j.idjadwal = a.idjadwal join detail_absent dt on a.idabsent = dt.idabsent  where k.status_kontrak = 'S'");
		}else if(Yii::$app->user->identity->idrole == 2){
			$sql = $connection->createCommand("select distinct * from timeline t join 
											  kontrak k on t.idkontrak = k.idkontrak 
											  join jadwal j on j.idkontrak = k.idkontrak 
											  join absent a on j.idjadwal = a.idjadwal join detail_absent dt on a.idabsent = dt.idabsent 
											  where dt.iduser = ".$id." and k.status_kontrak = 'S' group by k.idkontrak");
		}
		$model = $sql->queryAll();
		


		return $this->render('absent',[
			'model'=>$model,
		]);
    }
	
	public function actionDetailAbsent($id)
    {
		$kode = $id;
		$iduser = Yii::$app->user->identity->id;
		$model = DetailAbsent::find()
				->joinWith(['absent'])
				->where(['idjadwal'=>$id])
				->andWhere(['iduser'=>$iduser])
				->all();

		return $this->render('detail-absent',[
			'kode'=>$kode,
			'model'=>$model,
		]);
    }
	
	public function actionSalary()
    {
		$id = Yii::$app->user->identity->id;
		$connection = \Yii::$app->db;

		$sql = $connection->createCommand("select distinct * from timeline t join 
				kontrak k on t.idkontrak = k.idkontrak 
				join jadwal j on j.idkontrak = k.idkontrak 
				join absent a on j.idjadwal = a.idjadwal join detail_absent dt on a.idabsent = dt.idabsent 
				where dt.iduser = ".$id." and k.status_kontrak = 'E' group by k.idkontrak");
									
		$model = $sql->queryAll();
		return $this->render('salary',[
			'model'=>$model,
		]);
    } 
	public function actionDetailSalary($id)
    {
		$kode = $id;
		$iduser = Yii::$app->user->identity->id;
		$model = Payroll::find()
				->where(['idjadwal'=>$id])
				->andWhere(['iduser'=>$iduser])
				->all();

		return $this->render('detail-salary',[
			'kode'=>$kode,
			'model'=>$model,
		]);
    }
	
	public function actionApply()
    {
		
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("select tl.title_event ,app.counter ,app.date_apply from timeline_apply app  join timeline tl on 
										  app.idtimeline = tl.idtimeline join user u on app.idspg = u.id where u.id = '".Yii::$app->user->identity->id."'");
										  $model = $sql->queryAll();

		return $this->render('apply',[
			'model'=>$model,
		]);
    }
	
	
	public function actionProses($id , $status){
		
		$model = $this->findModel($id);
		
		if($status == 'N'){
			$model->status = 0;
			$model->kelengkapan = $status;
			$model->save();
		}
		//------------------------------- BEGIN Email--------------------------------------------
		//include "inc/fungsi_email.php";
		//EmailApproveRegister($model->email, $model->first_name,  $model->Last_name);
		//------------------------------- END Email--------------------------------------------
		$model->kelengkapan = $status;
		$model->save(false);
		
		$searchModel = new SpgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
		
	}
    /**
     * Creates a new UserForm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserForm();
		$modelsImage = [new UserImage];
		$modelsDoc = [new UserDocument];
		$modelsContact = [new UserContact];
		
         if ($model->load(Yii::$app->request->post())){
			
			$model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
			$model->generateAuthKey();
			$model->created_at = date('Ydmh');
			$year = $_POST['year'];
			$day = $_POST['day'];
			$month = $_POST['month'];
			$model->bod = $year.'-'.$month.'-'.$day;
			$model->idrole = '2';
			$model->kelengkapan = 'P';

			if($model->save() && $model->validate()) {
				Yii::$app->session->setFlash('success','You have entered the data correctly');
			}
			$modelsImage = Model::createMultiple(UserImage::classname());
			Model::loadMultiple($modelsImage, Yii::$app->request->post());
			
			foreach ($modelsImage as $key => $modelImage) {
			  
				$modelImage->image_upload=UploadedFile::getInstance($modelImage,'['.$key.']image_upload');
				$imageName = md5(uniqid($modelImage->image_upload));
				
				if(empty($modelImage->image_upload)){
					return $this->redirect(['view', 'id' => $model->id]);
				}else{
					$modelImage->image_upload->saveAs('images/profile/'.$imageName. '.'.$modelImage->image_upload->extension);
				
					$modelImage->image_upload= $imageName. '.'.$modelImage->image_upload->extension;
					$modelImage->iduser = $model->id;
						
					$modelImage->save(false); 
				}
			}
			
			$modelsDoc = Model::createMultiple(UserDocument::classname());
			Model::loadMultiple($modelsDoc, Yii::$app->request->post());
			
			foreach ($modelsDoc as $key => $modelDoc) {
			  
				$modelDoc->file_upload=UploadedFile::getInstance($modelDoc,'['.$key.']file_upload');
				$docFile = md5(uniqid($modelDoc->file_upload));
				
				if(empty($modelDoc->file_upload)){
					return $this->redirect(['view', 'id' => $model->id]);
				}else{
					$modelDoc->file_upload->saveAs('file/'.$docFile. '.'.$modelDoc->file_upload->extension );
				
					$modelDoc->file_upload= $docFile. '.'.$modelDoc->file_upload->extension;
					$modelDoc->iduser = $model->id;
						
					$modelDoc->save(false); 
				}
			}
			
			$modelsContact = Model::createMultiple(UserContact::classname());
			Model::loadMultiple($modelsContact, Yii::$app->request->post());
			foreach ($modelsContact as $key => $modelContact) {

				$modelContact->iduser = $model->id;				
				$modelContact->save(false); 
			}
		//  var_dump($model->idbank);
		 return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'modelsImage' => (empty($modelsImage)) ? [new UserImage] : $modelsImage,
				'modelsDoc' => (empty($modelsDoc)) ? [new UserDocument] : $modelsDoc,
				'modelsContact' => (empty($modelsContact)) ? [new UserContact] : $modelsContact,
            ]);
        }
    }
	
    /**
     * Updates an existing UserForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id){
			$model = $this->findModel($id);
			
        if ($model->load(Yii::$app->request->post())){
			
			$year = $_POST['year'];
			$day = $_POST['day'];
			$month = $_POST['month'];
			$model->updated_at = date('Ydmh');
			$model->bod = $year.'-'.$month.'-'.$day;
			$model->save(false);
		
		
			
			$modelsContact = Model::createMultiple(UserContact::classname());
			Model::loadMultiple($modelsContact, Yii::$app->request->post());
			
			foreach ($modelsContact as $con =>  $modelContact):
				
				if($modelContact->contact_number != ""){
					
					$modelContact->iduser = $model->id;				
					$modelContact->save(false);
				}
			endforeach;
		
			return $this->redirect(['profile']);			
        } else {
            return $this->render('update', [
                'model' => $model,
				'modelsContact' => (empty($modelsContact)) ? [new UserContact] : $modelsContact,
            ]);
        }
    }
	
	public function actionUpdateExperience($id){
			$models = UserForm::find()->where(['id'=>$id])->one();
			
			$exp = UserExperience::find()
					->where(['iduser'=>$id])
					->count();
			if($exp >=  1){
				$model = UserExperience::find()
					->where(['iduser'=>$id])
					->one();
			}else{
				$model = new UserExperience();
				
			}		
        if ($model->load(Yii::$app->request->post())){
			if($exp == 0){
				$model->iduser = Yii::$app->user->identity->id;
				$model->save();
			}else{
				$model->save();
			}
			
		
			return $this->redirect(['profile']);			
        } else {
            return $this->render('experience', [
                'model' => $model,
				'models' => $models,
            ]);
        }
    }
	public function actionUpdatePhoto($id){				
		$models = UserForm::find()->where(['id'=>$id])->one();
		$modelsImage = Model::createMultiple(UserImage::classname());
		if (Model::loadMultiple($modelsImage, Yii::$app->request->post())){
			
			foreach ($modelsImage as $key2 => $modelImage):
			  
				$modelImage->image_upload=UploadedFile::getInstance($modelImage,'['.$key2.']image_upload');
				$imageName = md5(uniqid($modelImage->image_upload));
				
				if(isset($modelImage->image_upload)){
					$modelImage->image_upload->saveAs('images/tmp/'.$imageName. '.'.$modelImage->image_upload->extension);
				
					$modelImage->image_upload= $imageName. '.'.$modelImage->image_upload->extension;
					$modelImage->iduser = $id;
					$modelImage->date_upload = date("Y-m-d H:i:s");
					
					Image::frame('images/tmp/'.$modelImage->image_upload.'', 0, 'FFF', 0)
						->rotate(0)
						->resize(new Box(800,800))
						->save('images/profile/800x/'.$modelImage->image_upload.'', ['quality' => 100]);
					
					Image::frame('images/tmp/'.$modelImage->image_upload.'', 0, 'FFF', 0)
						->rotate(0)
						->resize(new Box(400,400))
						->save('images/profile/400x/'.$modelImage->image_upload.'', ['quality' => 100]);
					
					unlink('images/tmp/' . $modelImage->image_upload);
					$modelImage->save(false); 
				}
			endforeach;
			return $this->redirect(['profile']);			
        } else {
            return $this->render('photo', [
				'modelsImage' => (empty($modelsImage)) ? [new UserImage] : $modelsImage,
				'models'=>$models,
            ]);
        }
    }
	public function actionUpdateDocument($id){
		$models = UserForm::find()->where(['id'=>$id])->one();	
		$modelsDoc = Model::createMultiple(UserDocument::classname());
		
		if (Model::loadMultiple($modelsDoc, Yii::$app->request->post())){
			
			foreach ($modelsDoc as $z => $modelDoc):
			  
				$modelDoc->file_upload=UploadedFile::getInstance($modelDoc,'['.$z.']file_upload');
				$docFile = md5(uniqid($modelDoc->file_upload));
				
				if(isset($modelDoc->file_upload)){
					$modelDoc->file_upload->saveAs('file/'.$docFile. '.'.$modelDoc->file_upload->extension );
				
					$modelDoc->file_upload= $docFile. '.'.$modelDoc->file_upload->extension;
					$modelDoc->iduser = $id;
					$modelDoc->date_upload = date("Y-m-d H:i:s");
					$modelDoc->title = 'Curriculum Vitae';
					$modelDoc->save(false); 
				}
			endforeach;

			return $this->redirect(['profile']);			
        } else {
            return $this->render('document', [
				'modelsDoc' => (empty($modelsDoc)) ? [new UserDocument] : $modelsDoc,
				'models'=>$models,
            ]);
        }
    }
	//public function actionDownload($id) {
	//	$doc = UserDocument::find()
	//			->where(['iddocument' => $id])
	//			->all();
	//	
	//	foreach($doc as $docs):
	//	$path = Yii::getAlias('@web') . '/file';
	//	return $this->redirect([$path . '/'.$docs->file_upload]);
	//	//var_dump($docs->title);
	//	
	//	//$path = Yii::getAlias('@webroot') . '/file';
	//	//$file = $path . '/'.$docs->file_upload;
	//	//if (file_exists($file)) {
	//	//	Yii::$app->response->xSendFile($file);
	//	//} 
	//	endforeach;
	//}

    /**
     * Deletes an existing UserForm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	public function actionDelimg()
    {
		$id_image = $_GET['id'];
        $look = UserImage::find()
				->where(['iduserimage'=>$id_image])
				->one();
		//var_dump($look->image);
		$image ='images/profile/400x/'.$look->image_upload;
		$images ='images/profile/800x/'.$look->image_upload;
		//var_dump($image);
		if (unlink($image) && unlink($images)) {
			$look->delete();
		}
        return $this->redirect(['update-photo','id'=> $look->iduser]);
    }
	
	public function actionDeldoc()
    {
		$iddoc = $_GET['id'];
        $look = UserDocument::find()
				->where(['iddocument'=>$iddoc])
				->one();
		//var_dump($look->image);
		$image ='file/'.$look->file_upload;
		//var_dump($image);
		if (unlink($image)) {
			$look->delete();
		}
        return $this->redirect(['update-document','id'=> $look->iduser]);
    }
	
	public function actionDelcontact()
    {
		$idcontact = $_GET['id'];
        $look = UserContact::find()
				->where(['idcontactuser'=>$idcontact])
				->one();
		$look->delete();
        return $this->redirect(['update','id'=> $look->iduser]);
    }
    /**
     * Finds the UserForm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
