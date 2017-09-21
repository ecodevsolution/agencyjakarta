<?php

namespace backend\controllers;

use Yii;
use backend\models\UserForm;
use common\models\User;
use backend\models\ClientSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\UserImage;
use backend\models\UserAddress;
use backend\models\UserContact;
use backend\models\UserDocument;
use backend\models\Model;

/**
 * UserFormController implements the CRUD actions for UserForm model.
 */
class ClientController extends Controller
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
        $searchModel = new ClientSearch();
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
	public function actionProfile()
    {
		$model = new UserForm();
        return $this->render('profile', [
            'model'=>$model,
        ]);
    }
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
		$modelAddress = new UserAddress();
		$modelContact = new UserContact();
        if ($model->load(Yii::$app->request->post()) && $modelAddress->load(Yii::$app->request->post()) &&  $modelContact->load(Yii::$app->request->post())){			
			$model->idrole = 3;
			$model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
			$model->created_at = date('Ydmh');
			$model->idcategory = 0;
			$model->generateAuthKey();
			$model->save();
			
			$max =  UserForm::find()
						->max('id');

			$modelAddress->iduser = $max;
			$modelAddress->idcity = $model->idcity;
			$modelAddress->save();
			
			
			$modelContact->iduser = $max;
			$modelContact->title = 'Primary';
			$modelContact->save();
			
			return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'modelAddress'=>$modelAddress,
				'modelContact'=>$modelContact,
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
		
		$modelAddress = UserAddress::find()
						->where(['iduser'=>$id])
						->one();
		$modelContact = UserContact::find()
						->where(['iduser'=>$id])
						->one();
        if ($model->load(Yii::$app->request->post()) && $modelAddress->load(Yii::$app->request->post())  && $modelContact->load(Yii::$app->request->post())){
			$model->updated_at = date('Ydmh');
			$model->generateAuthKey();
			$model->save(false);
			
			$modelAddress->iduser = $id;
			$modelAddress->idcity = $model->idcity;
			$modelAddress->save();
			
			$modelContact->iduser = $id;
			$modelContact->title = 'Primary';
			$modelContact->save();
			$session = Yii::$app->session;
			
			$session->setFlash('Updte', 'Update successfully !');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'modelAddress' => $modelAddress,
				'modelContact'=> $modelContact,
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
