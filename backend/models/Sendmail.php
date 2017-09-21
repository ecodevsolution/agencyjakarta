<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "send_mail".
 *
 * @property integer $idsend
 * @property integer $idspg
 * @property integer $idtimline
 * @property string $date
 */
class SendMail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'send_mail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idspg', 'idtimline'], 'integer'],
            [['date'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idsend' => 'Idsend',
            'idspg' => 'Idspg',
            'idtimline' => 'Idtimline',
            'date' => 'Date',
        ];
    }
}
