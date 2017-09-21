<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "face".
 *
 * @property integer $idface
 * @property string $face
 */
class Face extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'face';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['face'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */

	public function getUserForm()
    {
        return $this->hasMany(UserForm::className(), ['face' => 'idface']);
    }
    public function attributeLabels()
    {
        return [
            'idface' => 'Idface',
            'face' => 'Face',
        ];
    }
}
