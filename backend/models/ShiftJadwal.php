<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shift_jadwal".
 *
 * @property integer $idshift
 * @property string $keterangan
 * @property string $jam_masuk
 * @property string $jam_keluar
 * @property integer $flag
 */
class ShiftJadwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shift_jadwal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keterangan', 'jam_masuk', 'jam_keluar', 'flag'], 'required'],
            [['jam_masuk', 'jam_keluar'], 'safe'],
            [['flag'], 'integer'],
            [['keterangan'], 'string', 'max' => 50],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idshift' => 'Idshift',
            'keterangan' => 'Keterangan',
            'jam_masuk' => 'Jam Masuk',
            'jam_keluar' => 'Jam Keluar',
            'flag' => 'Flag',
        ];
    }
}
