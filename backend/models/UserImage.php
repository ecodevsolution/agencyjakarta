<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_image".
 *
 * @property integer $iduserimage
 * @property integer $iduser
 * @property string $title
 * @property string $image_upload
 * @property string $date_upload
 */
class UserImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iduser','date_upload'], 'required'],
            [['iduser'], 'integer'],
            [['date_upload'], 'safe'],
            [['title', 'image_upload'], 'string', 'max' => 50],
			['image_upload', 'image', 'extensions' => ['jpg'], 
				'minWidth' => 800, 'minHeight' => 800,
			],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iduserimage' => 'Iduserimage',
            'iduser' => 'Iduser',
            'title' => 'Title',
            'image_upload' => 'Image Upload',
            'date_upload' => 'Date Upload',
        ];
    }
	public function getUserForm()
    {
        return $this->hasMany(UserForm::className(), ['id' => 'iduser']);
    }
	public function getUserContact()
    {
        return $this->hasMany(UserContact::className(), ['iduser' => 'iduser']);
    }
}
