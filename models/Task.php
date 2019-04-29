<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int $user_id
 * @property string $task
 * @property int $deadline
 * @property int $creation_date
 * @property int $mod_date
 *
 * @property Users $user
 */
class Task extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'task', 'deadline', 'creation_date', 'mod_date'], 'required'],
            [['user_id', 'deadline', 'creation_date', 'mod_date'], 'integer'],
            [['task'], 'string', 'max' => 200],
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
            'task' => 'Task',
            'deadline' => 'Deadline',
            'creation_date' => 'Creation Date',
            'mod_date' => 'Mod Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return array|ActiveRecord[]
     */
    public static function getTasksByUserId()
    {
        $id=Yii::$app->session->get('id');
        return Task::find()->andWhere(['user_id' => $id])->all();
    }

    public static function getTaskById($id)
    {

        return Task::find()->andWhere(['id' => $id])->one();
    }
}
