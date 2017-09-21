<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "absent".
 *
 * @property integer $idabsent
 * @property integer $idjadwal
 * @property string $keterangan
 * @property string $verifikator
 * @property string $jam
 * @property string $tanggal
 *
 * @property Jadwal $idjadwal0
 * @property DetailAbsent[] $detailAbsents
 */
class Absent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'absent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idjadwal'], 'integer'],
            [['keterangan'], 'string'],
            [['jam', 'tanggal'], 'safe'],
            [['verifikator'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idabsent' => 'Idabsent',
            'idjadwal' => 'Idjadwal',
            'keterangan' => 'Keterangan',
            'verifikator' => 'Verifikator',
            'jam' => 'Jam',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdjadwal0()
    {
        return $this->hasOne(Jadwal::className(), ['idjadwal' => 'idjadwal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDetailAbsents()
    {
        return $this->hasMany(DetailAbsent::className(), ['idabsent' => 'idabsent']);
    }
}
