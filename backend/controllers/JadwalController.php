<?php

namespace backend\controllers;

use Yii;
use backend\models\Jadwal;
use backend\models\JadwalSearch;
use yii\web\Controller;
use backend\models\Kontrak;
use backend\models\Timeline;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use backend\models\DetailJadwal;
use backend\models\ShiftJadwal;
use backend\models\EventCategory;
use backend\models\TimelineApply;


/**
 * JadwalController implements the CRUD actions for Jadwal model.
 */
class JadwalController extends Controller
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
     * Lists all Jadwal models.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $model = Timeline::find()
	// 			->joinWith(['kontrak'])
	// 			->where(['status_kontrak'=>'P'])
	// 			->all();
	
		
	// 	return $this->render('index', [
    //         'model' => $model,
    //     ]);
    // }
	
    public function actionDetailSpg($id){
    
        $modelx = TimelineApply::find()
                ->joinWith('userForm')
                ->where(['timeline_apply.status'=>'4'])
                ->AndWhere(['idtimeline'=>$id])
                ->all();
        $spg = '';
        foreach($modelx as $model):
              $spg.="<option value=".$model->idspg.">".ucfirst($model->userForm->first_name)." ".ucfirst($model->userForm->Last_name)."</option>";
        endforeach;
        echo"
                <label class='control-label'>Choose SPG</label>
                <div class='form-group field-detailjadwal-idjadwal required'>
                    <select class='form-control' name='spg'>
                        ".$spg."
                    </select>
                    <div class='help-block'></div>
                </div>
            ";

           
                                       
                                          
    }
	public function actionIndex()
    {
        // $model = new Jadwal();
        // $shift = new ShiftJadwal();
		// $modeldetail = [new DetailJadwal];

		// 	$modeldetail = Model::createMultiple(DetailJadwal::classname());
		// if (Model::loadMultiple($modeldetail, Yii::$app->request->post())){
			
		// 	$timeline = Timeline::find()
		// 				->where(['idkontrak'=>$id])
		// 				->One();
						
		// 	$kontrak = Kontrak::findOne($id);
		// 	$kontrak->status_kontrak = 'S';
		// 	$kontrak->save(false);
			
		// 	$model->idkontrak = $timeline->idkontrak;
		// 	$model->flag_status = 1;
		// 	$model->idrecomendation = $timeline->idtimeline;
		// 	$model->tanggal = date("Y-m-d");
			
		// 	$model->save();
			
			
		// 	foreach ($modeldetail as $key => $modeldetails):
			
		// 		$max = Jadwal::find()
		// 			  ->select('idjadwal')
		// 			  ->max('idjadwal');
		// 		$modeldetails->idjadwal = $max;
		// 		$modeldetails->tanggal_mulai = $_POST['byear'][$key].'-'.$_POST['bmonth'][$key].'-'.$_POST['bdate'][$key];
		// 		$modeldetails->tanggal_akhir = $_POST['eyear'][$key].'-'.$_POST['emonth'][$key].'-'.$_POST['edate'][$key];
		// 		$modeldetails->jam_mulai = $_POST['sminute'][$key].':'.$_POST['ssecond'][$key];
		// 		$modeldetails->jam_selesai = $_POST['eminute'][$key].':'.$_POST['esecond'][$key];
		// 		$modeldetails->flag=1;
		// 		$modeldetails->save();
		//  endforeach;

        $model = new Jadwal();       
        $details = new DetailJadwal();
        $shift = new ShiftJadwal();
        $event = Jadwal::find()
                ->JoinWith(['timeline'])
                ->where(['flag_status'=>'1'])
                ->all();

        // $schedule = new 
        if ($shift->load(Yii::$app->request->post())){
                $shift->flag = 1;
                $shift->save();
            return Yii::$app->getResponse()->redirect('index.php?r=jadwal%2Findex');
        }

        if ($details->load(Yii::$app->request->post())){
                $jdwl = Jadwal::find()
                        ->where(['idtimeline'=>$details->idjadwal])
                        ->one();
                $details->idjadwal = $jdwl->idjadwal;
                $details->iduser = $_POST['spg'];
                $details->flag = 1;
                $details->save();
            return Yii::$app->getResponse()->redirect('index.php?r=jadwal%2Findex');
        }

        if ($model->load(Yii::$app->request->post())){

                $tl = Timeline::find()
                    ->where(['idtimeline'=>$model->idtimeline])
                    ->One();

                 $kontrak = Kontrak::find()                    
                    ->where(['idkontrak'=>$tl->idkontrak])
                    ->One();

               $model->flag_status = 1;
               $model->color = $_POST['color'];
               $model->tanggal = date('Y-m-d');
               $model->save();
              $kontrak->status_kontrak = 'S';
               $kontrak->save(false);   
                             
            return Yii::$app->getResponse()->redirect('index.php?r=jadwal%2Findex');
        } else {
			
			// $connection = \Yii::$app->db;
			// $sql = $connection->createCommand("select * from timeline_apply t join user u on t.idspg = u.id 
			// 							 join timeline tm on t.idtimeline = tm.idtimeline 
			// 							 join kontrak k on tm.idkontrak = k.idkontrak where t.status  = 4 and k.idkontrak = '".$id."'");
			// $models = $sql->queryOne();
            // return $this->render('jadwal', [
            //     'model' => $model,
			// 	'models'=> $models,
			// 	'modeldetail' => (empty($modeldetail)) ? [new DetailJadwal] : $modeldetail,
            // ]);
            return $this->render('jadwal', [
                 'model' => $model,
                 'event' => $event,
                 'details' => $details,
                 'shift' => $shift,
             ]);
        }
    }
	
    /**
     * Displays a single Jadwal model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Jadwal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Jadwal();
		$modeldetail = [new DetailJadwal];

        if ($model->load(Yii::$app->request->post())){
			
			$model->save();
            return $this->redirect(['view', 'id' => $model->idjadwal]);
        } else {
			
			$connection = \Yii::$app->db;
			$sql = $connection->createCommand("select u.id, u.first_name from timeline_apply t join user u on t.idspg = u.id 
										 join timeline tm on t.idtimeline = tm.idtimeline 
										 join kontrak k on tm.idkontrak = k.idkontrak where t.counter  = 4 and k.idkontrak = '".$idkontrak."'");
			$models = $sql->queryAll();
            return $this->render('create', [
                'model' => $model,
				'models'=> $models,
				'modeldetail' => (empty($modeldetail)) ? [new DetailJadwal] : $modeldetail,
            ]);
        }
    }
	public function actionListKontrak($id){
		
		$countContract = Kontrak::find()->where(['idkontrak' => $id])->count();
		 
		 $Contract = Kontrak::find()
		 ->where(['idkontrak' => $id])
		 ->all();
	 
		if($countContract > 0){
			foreach($Contract as $Contracts){
				

			}
			
			
		}
		else{
			echo "<label class='alert alert-danger'>Contract Not Found</label>";
		}
		
	}
    /**
     * Updates an existing Jadwal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idjadwal]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Jadwal model.
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
     * Finds the Jadwal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jadwal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Jadwal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
