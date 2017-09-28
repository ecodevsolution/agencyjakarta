<?php

namespace backend\controllers;

use Yii;
use backend\models\Timeline;
use backend\models\TimelineSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\TimelineApply;
use backend\models\UserForm;
use yii\web\UploadedFile;
use yii\db\Query;
/**
 * TimelineController implements the CRUD actions for Timeline model.
 */
class RecomendationController extends Controller
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
		$model = Timeline::find()
				->joinWith(['timelineApply'])
				->joinWith(['kontrak'])
				->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Timeline model.
     * @param integer $id
     * @return mixed
     */
	
    public function actionDetailApply($id)
    {
		$event = Timeline::find()
				->joinWith('kontrak')
				->where(['idtimeline'=>$id])
				->One();
		$connection = \Yii::$app->db;
		$sql = $connection->createCommand("	select u.id, 
												   u.first_name, 
												   c.city_name, 
												   u.email, 
												   u.high, 
												   f.face, 
												   t.status, 
												   t.idtimeline,
												   t.counter
												from timeline_apply t join 
												    timeline tm on t.idtimeline = tm.idtimeline join 
													user u on t.idspg = u.id join 
													city c on u.idcity = c.idcity join
                                                    face f on u.face = f.idface WHERE t.idtimeline ='".$id."'");
                                                    
                                                    //WHERE t.status = 1 AND
		$model = $sql->queryAll();
        return $this->render('detail', [
            'model' => $model,
			'event'=> $event,
        ]);
    }
	
	public function actionApprove($id, $status, $s, $val){
		
		$model = TimelineApply::find()
				->where(['idtimeline'=>$id])
				->andWhere(['idspg'=>$s])
				->One();
		$model->status = $status;
		$model->save(false);
		//var_dump($model);
		$models = UserForm::findOne($s);
		$models->active_work = $val;
		$models->save();
		
		return $this->redirect(['/recomendation/detail-apply', 'id' => $model->idtimeline]);
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
