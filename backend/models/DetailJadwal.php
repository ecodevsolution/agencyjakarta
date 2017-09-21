<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_jadwal".
 *
 * @property integer $idjadwal
 * @property integer $iduser
 * @property integer $idshift
 * @property string $tanggal
 * @property integer $flag
 */
class DetailJadwal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_jadwal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idjadwal', 'iduser', 'idshift', 'tanggal', 'flag'], 'required'],
            [['idjadwal', 'iduser', 'idshift', 'flag'], 'integer'],
            [['tanggal'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getJadwal()
    {
        return $this->hasOne(Jadwal::className(), ['idjadwal' => 'idjadwal']);
    }
    public function getUserForm()
    {
        return $this->hasOne(UserForm::className(), ['id' => 'iduser']);
    }
    public function getShiftJadwal()
    {
        return $this->hasOne(ShiftJadwal::className(), ['idshift' => 'idshift']);
    }
    public function attributeLabels()
    {
        return [
            'idjadwal' => 'Idjadwal',
            'iduser' => 'Iduser',
            'idshift' => 'Idshift',
            'tanggal' => 'Tanggal',
            'flag' => 'Flag',
        ];
    }
}
