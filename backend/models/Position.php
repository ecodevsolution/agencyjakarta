<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "position".
 *
 * @property string $idposition
 * @property string $position_name
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'position';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idposition'], 'required'],
            [['idposition'], 'string', 'max' => 2],
            [['position_name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idposition' => 'Idposition',
            'position_name' => 'Position Name',
        ];
    }
}
