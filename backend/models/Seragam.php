<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "seragam".
 *
 * @property integer $idseragam
 * @property string $deskripsi_seragam
 * @property integer $harga
 */
class Seragam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seragam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['harga'], 'integer'],
            [['deskripsi_seragam'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idseragam' => 'Idseragam',
            'deskripsi_seragam' => 'Deskripsi Seragam',
            'harga' => 'Harga',
        ];
    }
}
