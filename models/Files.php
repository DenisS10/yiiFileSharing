<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int $user_id
 * @property string $file_key
 * @property string $file_link
 * @property string $extension
 * @property int $creation_date
 * @property string $comment
 *
 * @property Users $user
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'file_key', 'file_link', 'extension', 'creation_date', 'comment'], 'required'],
            [['user_id', 'creation_date'], 'integer'],
            [['file_key'], 'string', 'max' => 50],
            [['file_link', 'comment'], 'string', 'max' => 250],
            [['extension'], 'string', 'max' => 20],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'file_key' => 'File Key',
            'file_link' => 'File Link',
            'extension' => 'Extension',
            'creation_date' => 'Creation Date',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
