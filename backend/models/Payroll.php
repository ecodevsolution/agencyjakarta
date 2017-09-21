<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payroll".
 *
 * @property integer $idpayroll
 * @property integer $idjadwal
 * @property integer $iduser
 * @property double $nominal
 * @property integer $jml_masuk
 * @property integer $jml_absent
 * @property integer $jml_subs
 * @property string $tanggal
 *
 * @property Jadwal $idjadwal0
 * @property User $iduser0
 */
class Payroll extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payroll';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idjadwal', 'iduser', 'jml_masuk', 'jml_absent', 'jml_subs'], 'integer'],
            [['nominal'], 'number'],
            [['tanggal'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idpayroll' => 'Idpayroll',
            'idjadwal' => 'Idjadwal',
            'iduser' => 'Iduser',
            'nominal' => 'Nominal',
            'jml_masuk' => 'Jml Masuk',
            'jml_absent' => 'Jml Absent',
            'jml_subs' => 'Jml Subs',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJadwal()
    {
        return $this->hasOne(Jadwal::className(), ['idjadwal' => 'idjadwal']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserForm()
    {
        return $this->hasOne(User::className(), ['id' => 'iduser']);
    }
}
