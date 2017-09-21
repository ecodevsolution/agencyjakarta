<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property integer $idpayment
 * @property string $idkontrak
 * @property integer $nominal
 * @property string $keterangan
 * @property integer $flag
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idkontrak', 'nominal'], 'required'],
            [['nominal', 'flag','status','left'], 'integer'],
            [['idkontrak'], 'string', 'max' => 10],
            [['keterangan'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpayment' => 'Idpayment',
            'idkontrak' => 'Idkontrak',
            'nominal' => 'Nominal',
			'left' => 'Left',
            'keterangan' => 'Keterangan',
            'flag' => 'Flag',
			'status' => 'Status',
        ];
    }
}
