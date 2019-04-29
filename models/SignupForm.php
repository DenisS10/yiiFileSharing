<?php
namespace app\models;
use yii\base\Model;
class SignupForm extends Model
{
    public $username;
    public $password;
    public $passwordReload;

    public function rules()
    {
        return [
            ['username','required','message' => 'Необходимо заполнить поле',],
            // ['username','string','min' => 3,'tooShort' => 'You nickname is very short'],
            ['password','required','message' => 'Необходимо заполнить поле'],
            ['passwordReload','required','message' => 'Необходимо заполнить поле'],
            // ['password', 'compare', 'compareAttribute' => 'passwordReload'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'username' => 'Nickname',
            'password' => 'Password',
            'passwordReload' => 'Repeat password'
        ];
    }
}