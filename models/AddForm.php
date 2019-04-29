<?php
/**
 * Created by PhpStorm.
 * User: Ден
 * Date: 28.04.2019
 * Time: 16:11
 */

namespace app\models;


use yii\base\Model;

class AddForm extends Model
{
    public $task;
    public $deadline;




    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['task', 'required', 'message' => 'Необходимо заполнить поле',],
            // ['username','string','min' => 3,'tooShort' => 'You nickname is very short'],
            ['deadline', 'required', 'message' => 'Необходимо заполнить поле'],
            ['deadline', 'integer', 'message' => 'Введенные данные не являются числом'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'task' => 'Task',
            'deadline' => 'Deadline',
        ];
    }
}












