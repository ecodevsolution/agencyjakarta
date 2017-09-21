<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_absent".
 *
 * @property integer $iddetail
 * @property integer $idabsent
 * @property integer $iduser
 * @property string $shift
 * @property string $pic
 * @property integer $status
 *
 * @property Absent $idabsent0
 * @property User $iduser0
 */
class DetailAbsent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_absent';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idabsent', 'iduser', 'status'], 'integer'],
            [['shift'], 'string', 'max' => 5],
            [['pic'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddetail' => 'Iddetail',
            'idabsent' => 'Idabsent',
            'iduser' => 'Iduser',
            'shift' => 'Shift',
            'pic' => 'Pic',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsent()
    {
        return $this->hasOne(Absent::className(), ['idabsent' => 'idabsent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserForm()
    {
        return $this->hasOne(User::className(), ['id' => 'iduser']);
    }
}
