<?php

namespace backend\controllers;

use Yii;
use backend\models\TimelineApply;
use backend\models\Timeline;
use backend\models\Kontrak;
use backend\models\TimelineApplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TimelineApplyController implements the CRUD actions for TimelineApply model.
 */
class TimelineApplyController extends Controller
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
     * Lists all TimelineApply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TimelineApplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TimelineApply model.
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
     * Creates a new TimelineApply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TimelineApply();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtimelineapply]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TimelineApply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
	public function actionApply($id, $usr){		
		
		$timeline = Timeline::findOne($id);
		$kontrak = Kontrak::findOne($timeline->idkontrak);
		
			$model = new TimelineApply();
			$model->idtimeline = $id;
			$model->idspg = $usr;
			$model->counter = 1;
			$model->status = 1;
			$model->date_apply = date("Y-m-d");
			$model->save();
			return $this->redirect(['//site/index']);
		
	}
	
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idtimelineapply]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TimelineApply model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
	 public function actionCancel($id, $usr)
    {
        $apply = TimelineApply::find()
                ->where(['idtimeline'=>$id])
                ->AndWhere(['idspg'=>$usr])
                ->One();
        $apply->delete();
        
        return $this->redirect(['//site/index']);
    }
	
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['//site/index']);
    }

    /**
     * Finds the TimelineApply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TimelineApply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TimelineApply::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
