<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_address".
 *
 * @property integer $idaddress
 * @property integer $iduser
 * @property integer $idcity
 * @property string $address
 */
class UserAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iduser', 'idcity'], 'integer'],
            [['address'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idaddress' => 'Idaddress',
            'iduser' => 'Iduser',
            'idcity' => 'Idcity',
            'address' => 'Address',
        ];
    }
}
