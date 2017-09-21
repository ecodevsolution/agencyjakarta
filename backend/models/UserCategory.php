<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_category".
 *
 * @property integer $idcategory
 * @property string $grade
 * @property double $price
 * @property double $price_flat
 */
class UserCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grade', 'price'], 'required'],
            [['price', 'price_flat'], 'number'],
            [['grade'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcategory' => 'Idcategory',
            'grade' => 'Grade',
            'price' => 'Price',
            'price_flat' => 'Price Flat',
        ];
    }
}
