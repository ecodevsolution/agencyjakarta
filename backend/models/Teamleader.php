<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "teamleader".
 *
 * @property integer $idtl
 * @property string $nama_tl
 * @property integer $harga_tl
 */
class Teamleader extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teamleader';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['harga_tl'], 'integer'],
            [['nama_tl'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtl' => 'Idtl',
            'nama_tl' => 'Nama Tl',
            'harga_tl' => 'Harga Tl',
        ];
    }
}
