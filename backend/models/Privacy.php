<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "privacy".
 *
 * @property integer $idprivacy
 * @property integer $role
 * @property string $privacy
 */
class Privacy extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'privacy';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role'], 'integer'],
            [['privacy'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
	public function getRoles0()
    {
        return $this->hasOne(Role::className(), ['idrole' => 'role']);
    }
    public function attributeLabels()
    {
        return [
            'idprivacy' => 'Idprivacy',
            'role' => 'Role',
            'privacy' => 'Privacy',
        ];
    }
}
