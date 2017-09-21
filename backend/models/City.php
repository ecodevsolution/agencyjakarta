<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $idcity
 * @property string $city_name
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }
	public function getUserForm()
    {
        return $this->hasMany(UserForm::className(), ['idcity' => 'idcity']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_name'], 'required'],
            [['city_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcity' => 'Idcity',
            'city_name' => 'City Name',
        ];
    }
}
