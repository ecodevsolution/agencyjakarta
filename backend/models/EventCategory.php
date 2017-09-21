<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event_category".
 *
 * @property string $idkontrak
 * @property string $color
 * @property string $status
 */
class EventCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idkontrak'], 'required'],
            [['status'], 'string'],
            [['idkontrak', 'color'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getKontrak()
    {
        return $this->hasOne(Kontrak::className(), ['idkontrak' => 'idkontrak']);
    }
    public function attributeLabels()
    {
        return [
            'idkontrak' => 'Idkontrak',
            'color' => 'Color',
            'status' => 'Status',
        ];
    }
}
