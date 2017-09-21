<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "jadwal".
 *
 * @property integer $idjadwal
 * @property integer $idtimeline
 * @property string $color
 * @property integer $flag_status
 * @property string $tanggal
 *
 * @property Absent[] $absents
 * @property Payroll[] $payrolls
 */
class Jadwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jadwal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtimeline', 'flag_status'], 'integer'],
            [['tanggal'], 'safe'],
            [['color'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idjadwal' => 'Idjadwal',
            'idtimeline' => 'Idtimeline',
            'color' => 'Color',
            'flag_status' => 'Flag Status',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsents()
    {
        return $this->hasMany(Absent::className(), ['idjadwal' => 'idjadwal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayrolls()
    {
        return $this->hasMany(Payroll::className(), ['idjadwal' => 'idjadwal']);
    }

    public function getDetailJadwal()
    {
        return $this->hasOne(DetailJadwal::className(), ['idjadwal' => 'idjadwal']);
    }
	
	public function getTimeline()
    {
        return $this->hasOne(Timeline::className(), ['idtimeline' => 'idtimeline']);
    }
}
