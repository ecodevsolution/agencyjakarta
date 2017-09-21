<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_experience".
 *
 * @property integer $idexperience
 * @property integer $iduser
 * @property string $deskripsi
 * @property string $tahun
 */
class UserExperience extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_experience';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iduser'], 'integer'],
            [['deskripsi'], 'string'],
            [['tahun'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idexperience' => 'Idexperience',
            'iduser' => 'Iduser',
            'deskripsi' => 'Deskripsi',
            'tahun' => 'Tahun',
        ];
    }
}
