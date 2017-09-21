<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_contact".
 *
 * @property integer $idcontactuser
 * @property integer $iduser
 * @property string $title
 * @property string $contact_number
 */
class UserContact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_contact';
    }

    /**
     * @inheritdoc
     */
	public function getUserImage()
    {
        return $this->hasMany(UserImage::className(), ['iduser' => 'iduser']);
    }
    public function rules()
    {
        return [
            [['iduser'], 'required'],
            [['iduser'], 'integer'],
            [['title'], 'string', 'max' => 25],
            [['contact_number'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcontactuser' => 'Idcontactuser',
            'iduser' => 'Iduser',
            'title' => 'Title',
            'contact_number' => 'Contact Number',
        ];
    }
}
