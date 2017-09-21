<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "terms".
 *
 * @property integer $idterms
 * @property integer $role
 * @property string $termsofuse
 */
class Terms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'terms';
    }

    /**
     * @inheritdoc
     */
	 
	public function getRoles0()
    {
        return $this->hasOne(Role::className(), ['idrole' => 'role']);
    }
    public function rules()
    {
        return [
            [['role'], 'integer'],
            [['termsofuse'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idterms' => 'Idterms',
            'role' => 'Role',
            'termsofuse' => 'Termsofuse',
        ];
    }
}
