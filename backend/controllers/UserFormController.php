<?php

namespace backend\controllers;

use Yii;
use backend\models\UserForm;
use common\models\User;
use backend\models\UserFormSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserFormController implements the CRUD actions for UserForm model.
 */
class UserFormController extends Controller
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
        $searchModel = new UserFormSearch();
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
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	public function actionSpg()
	{

		$model = new UserForm();
		
		return $this->render('ddd', [
			'model'=>$model,
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

        if ($model->load(Yii::$app->request->post())){
			if($model->idposition != "CL" || $model->idposition != "SP"){
				$model->idrole = "1";
				$model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
				$model->created_at = date('Ydmh');
				$model->kelengkapan = "E";
				$model->generateAuthKey();
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);
			}else{
				$model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
				$model->created_at = date('Ydmh');
				$model->generateAuthKey();
				$model->save();
				return $this->redirect(['view', 'id' => $model->id]);	
			}
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserForm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

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
