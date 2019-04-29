<?php
/**
 * Created by PhpStorm.
 * User: Ден
 * Date: 28.04.2019
 * Time: 14:30
 */

namespace app\controllers;


use app\models\AddForm;
use app\models\ModForm;
use app\models\Task;
use app\models\Users;
use Yii;
use yii\web\Controller;

class TasksController extends Controller
{
    public function actionView()
    {


        $model = Task::getTasksByUserId();

        // $_userId = Yii::$app->session->get('id');
        if (!Yii::$app->session->get('auth') || Yii::$app->session->get('auth') != 'ok')
            $this->redirect('/auth/login');


        return $this->render('viewTasks', [
            'model' => $model,
        ]);


    }


    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
            $this->redirect('/auth/login');
        // $_userId = Yii::$app->session->get('auth');


        //Task::getTasksByUserId();
    }

    /**
     * @return string
     */
    public function actionAdd()
    {
//        if (Yii::$app->user->isGuest) {
//            $this->redirect('/auth/login');
//
//        }
        $model = new AddForm();
        if ($model->load(Yii::$app->request->post()))
        {
            if ($model->validate()) {
//                echo '<pre>';
//                print_r($model);


                $newTask = new Task();
                $newTask->user_id = Yii::$app->session->get('id');
                $newTask->task = $model->task;
                $newTask->deadline = $model->deadline;
                $newTask->creation_date = time();
                $newTask->mod_date = 0;

                $newTask->save();
                //$this->refresh();
                $this->redirect('view');
            }
        }
        return $this->render('addTask', [
            'model' => $model,
        ]);
    }

    public function actionModify()
    {
//        if (!Yii::$app->user->isGuest){
            //$this->redirect('/auth/login');
        $model = new ModForm();
        $id = Yii::$app->request->get('id');
        $currTask = Task::getTaskById($id);
        $model->taskMod = $currTask->task;
        $model->deadlineMod = $currTask->deadline;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // echo '$model->validate()';

                $currTask->user_id = Yii::$app->session->get('id');
                $currTask->task = $model->taskMod;
                $currTask->deadline = $model->deadlineMod;
                //$currTask->creation_date = $currTask->creation_date;
                $currTask->mod_date = time();

                $currTask->save();

                $this->redirect('view');
            }
        }


//        echo '<pre>';
//        print_r($currTask);
//        exit();


        return $this->render('modTask', [
            'model' => $model,
        ]);
    }

    public function actionDelete()
    {
//        if (!Yii::$app->user->isGuest) {
            $id = Yii::$app->request->get('numberOfRecord');
            $currTask = Task::getTaskById($id);


            $currTask->delete();
            $this->redirect('view');
//        } else
//            $this->redirect('/auth/login');
    }


}
//public function Login()
//    {
//        $this->load->view('header', ['title' => 'Login']);
//
//        $this->load->database();
//        $query = $this->db->query('SELECT `id`,`login`,`password`,`user_name` FROM users');
//
//
//        $login = $this->input->post('login');
//        $pass = $this->input->post('login');
//
//
//        foreach ($query->result() as $user) {
//            $logPass = password_verify($pass, $user->password);
//            if ($login == $user->login && $logPass == true) {
//                //    print_r($user->login);
//
//                $this->session->id = $user->id;
//                $this->session->auth = 'ok';
//                header('location: index');
//
//            }
//        }
//        $this->load->view('tasks/login');
//        $this->load->view('footer');
//    }
//    public function Logout()
//    {
//        if (!$this->session->auth = 'ok' || $this->session->auth != 'ok')
//            header('location: login');
//        if ($this->session->auth = 'ok' && $this->session->auth == 'ok')
//            header('location: login');
//        session_destroy();
//    }
//    public function SignUp()
//    {
//        $this->load->view('header', ['title' => 'Index']);
//        $this->load->database();
//
//        $signLogin = $this->input->post('signLogin');
//        $signPass = $this->input->post('signPass');
//        $signName = $this->input->post('signName');
//
//
//
//        $currDate = time();
//        $signHashPass = password_hash($signPass, PASSWORD_DEFAULT);
//        $this->db->query("insert into `users`(`login`, `password`, `user_name`,`first_time`) values('$signLogin','$signHashPass','$signName',$currDate)");
//        $this->load->view('tasks/signup_view');
//        $this->load->view('footer');
//    }
//
//
//    public function index()
//    {
//        if (!$this->session->auth || $this->session->auth != 'ok')
//            header('location: login');
//
//        if ($this->session->id == null)
//            header('location: login');
//        $id = $this->session->id;
//        $this->load->view('header', ['title' => 'Index']);
//        $this->load->database();
//        $query = $this->db->query("SELECT `id`,`user_id`,`task`,`deadline` FROM task WHERE `user_id` = $id");
//
//        // print_r($query->result());
////        foreach ($query->result() as $task) {
////
////        }
//
//        $this->load->view('tasks/task_view', ['res' => $query->result()]);
//        $this->load->view('footer');
//
//
//    }
//
//
//    public function Add()
//    {
//        header('location: index');
//        $this->load->database();
//        $this->load->view('header', ['title' => 'Index']);
//        $userId = $this->session->id;
//
//
//        $task = $this->input->post('task');
//        $deadline = $this->input->post('deadline');
//
//
//        $currDate = time();
//        $this->db->query("insert into `task` (`user_id`,`task`, `deadline`,`creation_date`) values($userId,'$task',$deadline,$currDate)");
//
//        //mysqli_query($this->db,$querySave);
//
//        $this->load->view('footer');
//    }
//
//    public function Delete()
//    {
//        header('location: index');
//        $this->load->database();
//        $this->load->view('header', ['title' => 'Delete']);
//        $numberOfRecord = $this->input->get('numberOfRecord');
//        $numberOfRecordMod = intval($numberOfRecord);
//
//        $this->db->query("DELETE FROM task WHERE id = $numberOfRecordMod");
//
//        $this->load->view('footer');
//    }
//
//    public function Modify()
//    {
//        $this->load->database();
//        $this->load->view('header', ['title' => 'Delete']);
//        $id = $this->input->get('id');
//
//
//        $query = $this->db->query("SELECT `task`,`deadline` FROM task WHERE `id` = $id");
//        $this->load->view('tasks/modify_view', ['res' => $query->result()]);
//
//        $this->load->view('footer');
//
//    }
//
//    public function Save()
//    {
//        header('location: index');
//        $this->load->database();
//
//        $id = isset($_GET['id']) ? $_GET['id'] : '';
//        $modTask = isset($_GET['modTask']) ? $_GET['modTask'] : '';
//        $modDeadline = isset($_GET['modDeadline']) ? $_GET['modDeadline'] : '';
//        $this->input->get('id');
//        $this->input->get('modTask');
//        $this->input->get('modDeadline');
//
//
//        $currDate = time();
//
//        $this->db->query("UPDATE `task` SET `task` = '$modTask', `deadline` = $modDeadline,`mod_date`= $currDate where id = $id");
//
//
//        $this->load->view('footer');
//    }
//
//
//
//    public function Lk() //My Account
//    {
//        $this->load->view('header', ['title' => 'Index']);
//        $this->load->database();
//        $oldPass = $this->input->post('oldPass');
//        $newPass = $this->input->post('newPass');
//        $newRepeatPass = $this->input->post('newRepeatPass');
//        $id = $this->session->id;
//        //echo $id;
//
//        $query = $this->db->query("SELECT `id`,`login`,`password`,`user_name` FROM users");
//
//
//        foreach ($query->result() as $user) {
//            //echo '<pre>';
////            print_r($user);
//
//            $logPass = password_verify($oldPass, $user->password);
//            //echo $logPass ;
//            if ($newPass == $newRepeatPass) {
//                $newHashPass = password_hash($newPass, PASSWORD_DEFAULT);
//                // echo $newHashPass;
//            } else
//                $newHashPass = '';
//            if ($user->id == $id) {
//                //  echo '$user->id == $id';
//                if ($logPass == true) {
//                    // echo '$logPass == true';
//                    //$tempUser = $user->login;
//                    $this->db->query("UPDATE `users` SET `password`= '$newHashPass' WHERE `id` = $id ");//UPDATE `users` SET `login`='www' WHERE (`id`='71')
//
//                }
//
//            }
//
//        }
//        $this->load->view('tasks/lk_view');
//        $this->load->view('footer');
//    }