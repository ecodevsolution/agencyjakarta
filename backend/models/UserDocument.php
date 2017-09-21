<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_document".
 *
 * @property integer $iddocument
 * @property integer $iduser
 * @property string $title
 * @property string $file_upload
 * @property string $date_upload
 */
class UserDocument extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iduser', 'date_upload'], 'required'],
            [['iduser'], 'integer'],
            [['date_upload'], 'safe'],
			[['file_upload'], 'file', 'extensions' => 'docx, doc'],
            [['title'], 'string', 'max' => 25],
            [['file_upload'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'iddocument' => 'Iddocument',
            'iduser' => 'Iduser',
            'title' => 'Title',
            'file_upload' => 'File Upload',
            'date_upload' => 'Date Upload',
        ];
    }
}
