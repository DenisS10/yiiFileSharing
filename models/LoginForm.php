<?php

namespace app\models;
use Yii;
use yii\base\Model;
class LoginForm extends Model
{
    public $username;
    public $password;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['username', 'required', 'message' => 'Необходимо заполнить поле',],
            //['password','string','min' => 3,'tooShort' => 'You nickname is very short'],
            ['password', 'required', 'message' => 'Необходимо заполнить поле'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Nickname',
            'password' => 'Password',
        ];
    }
}