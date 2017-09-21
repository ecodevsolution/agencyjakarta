<?php

namespace backend\controllers;

use Yii;
use backend\models\Kontrak;
use backend\models\KontrakclientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Seragam;
use backend\models\Teamleader;

/**
 * KontrakController implements the CRUD actions for Kontrak model.
 */
class KontrakclientController extends Controller
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
     * Lists all Kontrak models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KontrakclientSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kontrak model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Kontrak model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       $model = new Kontrak();
		
		$kontrak = Kontrak::find()
				->orderBy('idkontrak DESC')
				->limit(1)
				->all();

				
        if ($model->load(Yii::$app->request->post())){
			
			foreach ($kontrak as $kontraks):
			
			$time = date('Y',strtotime($kontraks->tanggal));	
			//var_dump($time);
			//var_dump($modelspelanggan->idpelanggan);
			$lastNoUrut = intval(substr($kontraks->idkontrak, -2, 8))+0;
			if($time != date('Y')){
				$lastNoUrut=0;
			}
			$noLast = $lastNoUrut+1; 
			$auto_id = strlen($noLast);
			if($auto_id == 1){
				$lastNo = "0000000".$noLast;
			}else if($auto_id == 2){
				$lastNo = "000000".$noLast;
			}else if($auto_id == 3){
				$lastNo = "00000".$noLast;
			}else if($auto_id == 4){
				$lastNo = "0000".$noLast;
			}else if($auto_id == 5){
				$lastNo = "000".$noLast;
			}else if($auto_id == 6){
				$lastNo = "00".$noLast;
			}else if($auto_id == 7){
				$lastNo = "0".$noLast;
			}else if($auto_id == 8){
				$lastNo = $noLast;
			}else{
				$lastNo ="MAXIMUM LIMIT";
			}
			$awalan = date('y'); 
			$newid = $awalan.$lastNo;
			
			$model->idkontrak = $newid;
			$model->idclient = $_POST['client'];
			$model->status_kontrak = "P";
			$dateawl = date("Ymd", strtotime($model->tanggal_mulai));
			$dateakhir = date("Ymd", strtotime($model->tanggal_akhir));
			$duration = $dateakhir-$dateawl;
			$model->tanggal_mulai = date("Y-m-d", strtotime($model->tanggal_mulai));
			$model->tanggal_akhir = date("Y-m-d", strtotime($model->tanggal_akhir));
			

			$model->durasi_kontrak = $duration + 1;
			$model->status_pembayaran = "U";
			$model->tanggal = date("Y-m-d");
			$model->save();
			//var_dump($model->durasi_kontrak);
            return $this->redirect(['view', 'id' => $model->idkontrak]);
			endforeach;
        } else {
            return $this->render('create', [
                'model' => $model,

            ]);
        }
    }

    /**
     * Updates an existing Kontrak model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idkontrak]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Kontrak model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kontrak model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kontrak the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kontrak::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
