<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property integer $idrating
 * @property integer $iduser
 * @property integer $jml_rating
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iduser', 'jml_rating'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idrating' => 'Idrating',
            'iduser' => 'Iduser',
            'jml_rating' => 'Jml Rating',
        ];
    }
}
