<?php
/**
 * Created by PhpStorm.
 * User: Ден
 * Date: 28.04.2019
 * Time: 18:49
 */

namespace app\models;


use yii\base\Model;

class ModForm extends Model
{
    public $taskMod;
    public $deadlineMod;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['taskMod', 'required', 'message' => 'Необходимо заполнить поле',],
            ['deadlineMod', 'required', 'message' => 'Необходимо заполнить поле'],
            ['deadlineMod', 'integer', 'message' => 'Введенные данные не являются числом'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'taskMod' => 'Task',
            'deadlineMod' => 'Deadline',
        ];
    }
}