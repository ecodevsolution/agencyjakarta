<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timeline_apply".
 *
 * @property integer $idtimelineapply
 * @property integer $idtimeline
 * @property integer $idspg
 * @property integer $counter
 * @property string $date_apply
 */
class TimelineApply extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timeline_apply';
    }

    /**
     * @inheritdoc
     */
	public function getUserForm()
    {
        return $this->hasOne(UserForm::className(), ['id' => 'idspg']);
    }
	public function getTimeline()
    {
        return $this->hasOne(Timeline::className(), ['idtimeline' => 'idtimeline']);
    }
    	public function getTimelineDetail()
    {
        return $this->hasOne(TimelineDetail::className(), ['idtimeline' => 'idtimeline']);
    }
    public function rules()
    {
        return [
            [['idtimeline', 'idspg', 'counter', 'status', 'date_apply'], 'required'],
            [['idtimeline', 'idspg', 'counter','status'], 'integer'],
            [['date_apply'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtimelineapply' => 'Idtimelineapply',
            'idtimeline' => 'Idtimeline',
            'idspg' => 'Idspg',
            'counter' => 'Counter',
			'status' => 'Status',
            'date_apply' => 'Date Apply',
        ];
    }
}
