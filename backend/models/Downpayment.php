<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "downpayment".
 *
 * @property integer $iddownpayment
 * @property integer $idkontrak
 * @property integer $nominal
 * @property string $keterangan
 */
class Downpayment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'downpayment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idkontrak', 'nominal'], 'integer'],
            [['keterangan'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddownpayment' => 'Iddownpayment',
            'idkontrak' => 'Idkontrak',
            'nominal' => 'Nominal',
            'keterangan' => 'Keterangan',
        ];
    }
}
