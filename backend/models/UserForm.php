<?php

namespace backend\models;
use common\models\User;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $idrole
 * @property string $idposition
 * @property integer $idcity
 * @property string $username
 * @property string $first_name
 * @property string $Last_name
 * @property integer $high
 * @property integer $weight
 * @property string $language
 * @property string $face
 * @property string $kelengkapan
 * @property string $company_name
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class UserForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
	public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    public function rules()
    {
        return [
            [['idcity', 'username', 'first_name', 'Last_name','password_hash', 'email'], 'required'],
            [['idrole', 'idcity','idcategory','high', 'weight', 'status', 'created_at', 'updated_at','idbank'], 'integer'],
            [['kelengkapan','account_number'], 'string'],
			['username', 'filter', 'filter' => 'trim'],
			[['join_date'], 'safe'],
			['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
			['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['idposition'], 'string', 'max' => 2],
			[['email'],'email'],
			[['username','password_hash'], 'string', 'min'=>6],
            [['username', 'company_name', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['first_name', 'language', 'face'], 'string', 'max' => 50],
            [['Last_name'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
	public function getCategory0()
    {
        return $this->hasOne(UserCategory::className(), ['idcategory' => 'idcategory']);
    }
	 public function getUserImage()
    {
        return $this->hasOne(UserImage::className(), ['iduser' => 'id']);
    }
	 public function getBank()
    {
        return $this->hasOne(Bank::className(), ['idbank' => 'idbank']);
    }
	 public function getUserExperience()
    {
        return $this->hasOne(UserExperience::className(), ['iduser' => 'id']);
    }
	 public function getCity()
    {
        return $this->hasOne(City::className(), ['idcity' => 'idcity']);
    }
	 public function getFace0()
    {
        return $this->hasOne(Face::className(), ['idface' => 'face']);
    }
	public function getTimelineApply()
    {
        return $this->hasOne(TimelineApply::className(), ['idspg' => 'id']);
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idrole' => 'Idrole',
            'idposition' => 'Idposition',
            'idcity' => 'Idcity',
			'idcategory' => 'Idcategory',
            'username' => 'Username',
            'first_name' => 'First Name',
            'Last_name' => 'Last Name',
			'bod'=> 'Birthday',
            'high' => 'High',
            'weight' => 'Weight',
            'language' => 'Language',
            'face' => 'Face',
            'kelengkapan' => 'Kelengkapan',
			'idbank' => 'Idbank',
			'account_number' => 'Account Number',
            'company_name' => 'Company Name',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
			'join_date' => 'Join Date',
            'updated_at' => 'Updated At',
        ];
    }
}
