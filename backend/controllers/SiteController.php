<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\UserForm;
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
                        'actions' => ['login', 'error','forgot-password'],
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
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
	public function actionForgotPassword(){
		
		include "inc/fungsi_email.php";
		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post())){
			$search = UserForm::find()
					  ->where(['username'=>$model->username])
					  ->One();
			
			if($search){
				$CHAR = 'ABCDEFGHIJKLzyxwv123456789!?`*^%$#@()~';
				$string = '';
				for($i = 0 ; $i < 10 ; $i++){
					$pos = rand(0, strlen($CHAR)-1);
					$string .= $CHAR{$pos};
				}
			
				EmailForgotPasssword($search->email, $search->first_name, $search->Last_name, $model->username, $string );
				$search->password_reset_token = $search->password_hash;
				$search->password_hash = Yii::$app->security->generatePasswordHash($string);
				$search->save(false);
				$msg = "Please Check Your Email !";
				return $this->render('forgot', [
					'model' => $model,
					'msg'  => $msg,
				]);
			}else{
				$err = "Username not Exist !";
				return $this->render('forgot', [
					'model' => $model,
					'err' => $err,
				]);
			}
			
		}else {
			
			return $this->render('forgot', [
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
