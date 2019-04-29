<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property int $first_time
 *
 * @property Files[] $files
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'password', 'first_time'], 'required'],
            [['first_time'], 'integer'],
            [['login'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 70],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'first_time' => 'First Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['user_id' => 'id']);
    }

    public static function getUserBySessionId()
    {
        $id = Yii::$app->session->get('id');
        return Users::find()->andWhere(['id' => $id])->one();
    }

    public static function findByLogin($login)
    {
        return Users::find()->andWhere(['login' => $login])->one();
    }
}
