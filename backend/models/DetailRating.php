<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_rating".
 *
 * @property integer $iddetail_rating
 * @property integer $idrating
 * @property string $idkontrak
 * @property string $message
 * @property integer $rating
 * @property string $date
 * @property integer $client
 */
class DetailRating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idrating', 'rating', 'client'], 'integer'],
            [['message'], 'string'],
            [['date'], 'safe'],
            [['idkontrak'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddetail_rating' => 'Iddetail Rating',
            'idrating' => 'Idrating',
            'idkontrak' => 'Idkontrak',
            'message' => 'Message',
            'rating' => 'Rating',
            'date' => 'Date',
            'client' => 'Client',
        ];
    }
}
