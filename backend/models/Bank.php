<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property integer $idbank
 * @property string $bank_name
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bank_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idbank' => 'Idbank',
            'bank_name' => 'Bank Name',
        ];
    }
}
