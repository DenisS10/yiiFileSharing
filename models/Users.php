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
 * @property int $mod_time
 *
 * @property Task[] $tasks
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
            [['login', 'password', 'first_time', 'mod_time'], 'required'],
            [['first_time', 'mod_time'], 'integer'],
            [['login'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 200],
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
            'mod_time' => 'Mod Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['user_id' => 'id']);
    }

    public static function getPassById($id)
    {
        return Users::find()->andWhere(['id' => $id])->all()[0]->password;
    }
    public static function getLoginById($id)
    {
        return Users::find()->andWhere(['id' => $id])->all()[0]->login;
    }
    public static function findByLogin($login)
    {
        return Users::find()->andWhere(['login' => $login])->all()[0];
    }

    public static function getUserBySessionId()
    {
        $id = Yii::$app->session->get('id');
        return Users::find()->andWhere(['id' => $id])->one();
    }
}
