<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_kontrak".
 *
 * @property integer $idkontrak
 * @property integer $idcategory
 * @property integer $jumlah
 * @property double $diskon
 * @property double $harga
 */
class DetailKontrak extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_kontrak';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idkontrak', 'idcategory', 'jumlah', 'diskon', 'harga'], 'required'],
            [['idkontrak', 'idcategory', 'jumlah'], 'integer'],
            [['diskon', 'harga'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idkontrak' => 'Idkontrak',
            'idcategory' => 'Idcategory',
            'jumlah' => 'Jumlah',
            'diskon' => 'Diskon',
            'harga' => 'Harga',
        ];
    }
}
