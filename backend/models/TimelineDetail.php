<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timeline_detail".
 *
 * @property integer $idtimeline
 * @property integer $idkontrak
 * @property integer $idkategori
 * @property double $harga
 */
class TimelineDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timeline_detail';
    }

    /**
     * @inheritdoc
     */
	public function getUserCategory()
    {
        return $this->hasOne(UserCategory::className(), ['idcategory' => 'idkategori']);
    }

	
    public function rules()
    {
        return [
            [['idtimeline', 'idkontrak', 'idkategori'], 'required'],
            [['idtimeline', 'idkontrak', 'idkategori'], 'integer'],
            [['harga'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtimeline' => 'Idtimeline',
            'idkontrak' => 'Idkontrak',
            'idkategori' => 'Idkategori',
            'harga' => 'Harga',
        ];
    }
}
