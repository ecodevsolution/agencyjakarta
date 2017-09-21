<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "support".
 *
 * @property integer $idsupport
 * @property integer $role
 * @property string $support
 */
class Support extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'support';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['support'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsupport' => 'Idsupport',
            'support' => 'Support',
        ];
    }
}
