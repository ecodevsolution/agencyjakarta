<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timeline".
 *
 * @property integer $idtimeline
 * @property string $idkontrak
 * @property string $img_event
 * @property string $date_event
 * @property string $author
 * @property string $date_created
 *
 * @property TimelineImage[] $timelineImages
 */
class Timeline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'timeline';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img_event', 'date_event', 'author', 'date_created'], 'required'],
            [['date_event', 'date_created'], 'safe'],
            [['idkontrak'], 'string', 'max' => 10],
            [['img_event'], 'string', 'max' => 50],
            [['author'], 'string', 'max' => 25],
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
            'img_event' => 'Img Event',
            'date_event' => 'Date Event',
            'author' => 'Author',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimelineImages()
    {
        return $this->hasMany(TimelineImage::className(), ['idtimeline' => 'idtimeline']);
    }
	public function getTimelineDetail()
    {
        return $this->hasOne(TimelineDetail::className(), ['idtimeline' => 'idtimeline']);
    }
	public function getKontrak()
    {
        return $this->hasOne(Kontrak::className(), ['idkontrak' => 'idkontrak']);
    }
	public function getTimelineApply()
    {
        return $this->hasOne(TimelineApply::className(), ['idtimeline' => 'idtimeline']);
    }
	
}
