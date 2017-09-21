<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        if(Yii::$app->user->identity->idrole == "1") {
			return $this->render('index');
		}else if(Yii::$app->user->identity->idrole == "2") {		
			return $this->render('index-spg');
		}else{
			return $this->render('index-client');
		}
    }
	
	public function actionRating()
    {
       return $this->render('rating');
    }
	
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
	public function actionError(){
		
		return $this->render('error');
	}
	public function actionCheck(){

		//$model = new LoginForm();
        //return $this->render('login', [
        //    'model' => $model,
        //]);
	}
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
