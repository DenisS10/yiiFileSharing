<?php
namespace app\models;
use yii\base\Model;
class MyAccountForm extends Model
{
    public $oldPass;
    public $newPass;
    public $repeatNewPass;
    public function rules()
    {
        return [
            ['oldPass','required','message' => 'Необходимо заполнить поле',],
            ['newPass','required','message' => 'Необходимо заполнить поле',],
            ['repeatNewPass','required','message' => 'Необходимо заполнить поле',],
            ['newPass', 'compare', 'compareAttribute' => 'repeatNewPass','message' => 'Passwords don\'t equal'],
            ['repeatNewPass', 'compare', 'compareAttribute' => 'newPass','message' => 'Passwords don\'t equal'],
            // ['username','string','min' => 3,'tooShort' => 'You nickname is very short'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'oldPass' => 'Enter old password',
            'newPass' => 'Enter new password',
            'repeatNewPass' => 'Repeat new password',
        ];
    }
}