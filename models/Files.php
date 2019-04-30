<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int $user_id
 * @property string $file_key
 * @property string $file_link
 * @property string $extension
 * @property int $creation_date
 * @property string $file_name
 *
 * @property Users $user
 */
class Files extends ActiveRecord
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
            [['user_id', 'file_key', 'file_link', 'extension', 'creation_date', 'file_name'], 'required'],
            [['user_id', 'creation_date'], 'integer'],
            [['file_key'], 'string', 'max' => 50],
            [['file_link', 'file_name'], 'string', 'max' => 250],
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
            'file_name' => 'File name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public static function findFileByKey($key)
    {
        Files::find()->andWhere(['file_key' => $key]);
    }
}
