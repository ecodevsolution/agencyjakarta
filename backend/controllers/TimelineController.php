<?php

namespace backend\controllers;

use Yii;
use backend\models\Timeline;
use backend\models\TimelineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TimelineApply;
use yii\web\UploadedFile;
use backend\models\TimelineDetail;
use backend\models\Kontrak;
use backend\models\Model;
/**
 * TimelineController implements the CRUD actions for Timeline model.
 */
class TimelineController extends Controller
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
     * Lists all Timeline models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimelineSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionDetailKontrak($id){
		
		$model = Kontrak::find()
				->JoinWith('userForm')
				->Where(['idkontrak'=>$id])
				->One();
				
		echo '<div class="form-group">
				<label>Event Name</label>
				<input type="text" class="form-control"  readonly="true"  value="'.$model->nama_event.'"/>
			</div>
			<div class="form-group">
				<label>PIC</label>
				<input type="text" class="form-control"  readonly="true"  value="'.$model->perwakilan.' "/>
			</div>
			<div class="form-group">
				<label>Client Name</label>
				<input type="text" class="form-control"  readonly="true"  value="'.$model->userForm->first_name .''.$model->userForm->Last_name.'"/>
			</div>';
	}
			
	public function actionDetail($id){
		
		$model = Kontrak::find()
				->JoinWith('userForm')
				->Where(['idkontrak'=>$id])
				->One();
		$model_t = Timeline::find()						
				->Where(['timeline.idkontrak'=>$id])
				->One();
		
		$model_dt = TimelineDetail::find()
					->JoinWith('userCategory')
					->where(['idtimeline'=>$model_t->idtimeline])
					->All();
		
		foreach($model_dt as $models_dt):
		
			$models_dtl ="";
			$models_dtl .= "<div class='col-md-6'>";
			$models_dtl .= "<label>Grade SPG</label>";
			$models_dtl .= "<input type='text' class='form-control' readonly='true' value=".$models_dt->userCategory->grade.">";
			$models_dtl .= "</div>";
			
			$models_dtl .= "<div class='col-md-6'>";
			$models_dtl .= "<label>SPG Price</label>";
			$models_dtl .= "<input type='text' class='form-control' readonly='true' value=".number_format($models_dt->harga,0,".",".").">";
			$models_dtl .= "</div>";
			
		endforeach;
			$models_dtl .= "<br/>";
		$status = $model->status_kontrak;
		if($status == 'P'){
			$status_t = '<span class="label label-warning">Waiting Approve</span>';			
		}
		if($status == 'Y'){
			$status_t = '<span class="label label-success">Contract Approve</span>';			
		}
		if($status == 'N'){
			$status_t = '<span class="label label-danger">Contract reject</span>';			
		}
		if($status == 'S'){
			$status_t = '<span class="label label-primary">On Scheduling</span>';			
		}
		if($status == 'E'){
			$status_t = '<span class="label label-danger">Kontrak Expired</span>';			
		}
		echo '<div class="form-group">
				<label>Event Name</label>
				<input type="text" class="form-control"  readonly="true"  value="'.$model->nama_event.'"/>
			</div>
			<div class="form-group">
				<label>PIC</label>
				<input type="text" class="form-control"  readonly="true"  value="'.$model->perwakilan.' "/>
			</div>
			<div class="form-group">
				<label>Client Name</label>
				<input type="text" class="form-control"  readonly="true"  value="'.$model->userForm->first_name .''.$model->userForm->Last_name.'"/>
			</div>
			
			<div class="form-group">
				<label>Date Valid</label>
				<input type="text" class="form-control"  readonly="true"  value="'.date('d M Y',strtotime($model->tanggal_mulai)).' - '.date('d M Y',strtotime($model->tanggal_akhir)).'"/>
			</div>
			
			<div class="form-group">
				<label>Status</label><br/>
				'.$status_t.'
			</div>
			<hr/>
			
			<div class="panel-header panel-controls">
				<h3><i class="fa fa-newspaper-o"></i> <strong>Detail Timeline </strong></h3>
			</div>
			<br/>
			
			<div class="form-group">				
				<label>Timeline Image</label><br/>
				<img src="images/events/'.$model_t->img_event.'" alt="'.$model->nama_event.'" width="50%" class="img-responsive" title="'.$model->nama_event.'" />					
			</div>			
			<div class="form-group">
				
				
				'.$models_dtl.'
			</div>
			
		';
	}
    /**
     * Displays a single Timeline model.
     * @param integer $id
     * @return mixed
     */
	
	public function actionReport(){
		return $this->render('report', [
				//'model'=>$model,
		]);
	}
    public function actionDetailApply($id)
    {
	   if(isset($_GET['search'])){
		  $event = Timeline::findOne(['idtimeline'=>$id]);
			$connection = \Yii::$app->db;
			$sql = $connection->createCommand("select u.id, u.first_name, c.city_name,uc.grade, u.email, tm.idkontrak, u.high, f.face, t.idtimeline,t.counter , k.nama_event from 
					timeline_apply t join 
					timeline tm on t.idtimeline = tm.idtimeline join 
					kontrak k ON tm.idkontrak = k.idkontrak JOIN
					`user` u on t.idspg = u.id join city c on u.idcity = c.idcity join
					user_category uc ON u.idcategory = uc.idcategory JOIN
					face f on u.face = f.idface where tm.idtimeline  = ".$id." AND
					(f.face like '".$_GET['search']."' OR uc.grade = '".$_GET['search']."')");
			$model = $sql->queryAll();
			
			$kontrak = Timeline::findOne($id);
				if($event){	
				return $this->render('detail', [
					'model' => $model,
					'event'=> $event,
					'kontrak' => $kontrak,
					'id' => $id,
				]);
			}else{
				return $this->redirect(['/site/error']);
			}
	   }else{
			$event = Timeline::findOne(['idtimeline'=>$id]);
			$connection = \Yii::$app->db;
			$sql = $connection->createCommand("select u.id, u.first_name, c.city_name,uc.grade, u.email, tm.idkontrak, u.high, f.face, t.idtimeline,t.counter , k.nama_event from 
					timeline_apply t join 
					timeline tm on t.idtimeline = tm.idtimeline join 
					kontrak k ON tm.idkontrak = k.idkontrak JOIN
					`user` u on t.idspg = u.id join city c on u.idcity = c.idcity join
					user_category uc ON u.idcategory = uc.idcategory JOIN
					face f on u.face = f.idface where tm.idtimeline  = ".$id."");
			$model = $sql->queryAll();
			
			$kontrak = Timeline::findOne($id);
				if($event){	
				return $this->render('detail', [
					'model' => $model,
					'event'=> $event,
					'kontrak' => $kontrak,
					'id' => $id,
				]);
			}else{
				return $this->redirect(['/site/error']);
			}
	   }
    }
	public function actionApprove($id, $status){
		
		$model = TimelineApply::findOne($id);
		
		//var_dump($id);
		$model->counter = $status;
		//var_dump($model->counter);
		$model->save();
		return $this->redirect(['/timeline/detail-apply', 'id' => $model->idtimeline]);
	}
	public function actionReadMore($id){
			
		return $this->render('read-more', [
            'model' => $this->findModel($id),
        ]);
	}
    /**
     * Creates a new Timeline model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Timeline();
		$detail = [new TimelineDetail];
		
		$detail = Model::createMultiple(TimelineDetail::classname());
        if ($model->load(Yii::$app->request->post()) && Model::loadMultiple($detail, Yii::$app->request->post())){
			
				$model->img_event=UploadedFile::getInstance($model,'img_event');
				$imageName = md5(uniqid($model->img_event));
				$model->img_event->saveAs('images/events/'.$imageName. '.'.$model->img_event->extension );
				$model->img_event= $imageName. '.'.$model->img_event->extension;
				
				$model->author = Yii::$app->user->identity->username;
				$model->date_created = date("Y-m-d");
				$model->date_event = $_POST['start'];
				$model->save(false);
				
				foreach ($detail as $key => $details):
				
					$details->idtimeline = $model->idtimeline;
					$details->idkontrak = $model->idkontrak;
					$details->save(false);				

				endforeach;
							
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
				'detail' => (empty($detail)) ? [new TimelineDetail] : $detail,
            ]);
        }
    }

    /**
     * Updates an existing Timeline model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtimeline]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Timeline model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Timeline model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Timeline the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Timeline::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
