<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "timeline".
 *
 * @property integer $idtimeline
 * @property string $description
 * @property string $date_event
 * @property integer $price
 * @property string $author
 * @property string $date_created
 */
class Recomendation extends \yii\db\ActiveRecord
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
            [['description', 'title_event','idkontrak','img_event', 'date_event', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'integer'],
            [['date_created'], 'safe'],
            [['date_event'], 'string', 'max' => 50],
            [['author'], 'string', 'max' => 25]
        ];
    }

    /**
     * @inheritdoc
     */
	public function getKontrak()
    {
        return $this->hasOne(Kontrak::className(), ['idkontrak' => 'idkontrak']);
    }
	public function getTimelineApply()
    {
        return $this->hasOne(TimelineApply::className(), ['idtimeline' => 'idtimeline']);
    }
    public function attributeLabels()
    {
        return [
            'idtimeline' => 'Idtimeline',
			'idkontrak' => 'Idkontrak',
			'title_event'=>'Title event',
			'img_event' => 'Img Event',
            'description' => 'Description',
            'date_event' => 'Date Event',
            'price' => 'Price',
            'author' => 'Author',
            'date_created' => 'Date Created',
        ];
    }
}
