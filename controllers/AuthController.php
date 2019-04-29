<?php
/**
 * Created by PhpStorm.
 * User: Ден
 * Date: 29.04.2019
 * Time: 19:10
 */

namespace app\controllers;


use app\models\LoginForm;
use app\models\MyAccountForm;
use app\models\SignupForm;
use app\models\Users;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionLogin()
    {
        // if (!Yii::$app->session->get('auth') || Yii::$app->session->get('auth') != 'ok')
        //$this->redirect('login');
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $_user = Users::findByLogin($model->username);
                if ($_user->login == $model->username && password_verify($model->password, $_user->password) == true) {
                    Yii::$app->session->setFlash('success', 'Вы успешно вошли в систему');
                    if (Yii::$app->session->isActive) {
                        Yii::$app->session->open();
                        Yii::$app->session->set('id', $_user->id);
                        Yii::$app->session->set('auth', 'ok');
                    }
                    $this->redirect("/file/view");
                }
            } else
                Yii::$app->session->setFlash('error', 'Ошибка');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
//        return $this->render('/auth/login', [
//            'model' => $model,
//        ]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        $newUser = new Users();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if ($model->password === $model->passwordReload) {
                    $_password = password_hash($model->password, PASSWORD_DEFAULT);
                    $newUser->login = $model->username;
                    $newUser->password = $_password;
                    $newUser->first_time = time();
                    $newUser->save();
                    $this->refresh();
                    // $newUser->errors;
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);

    }

    public function actionMyaccount()
    {
        $currUser = Users::getUserBySessionId();
        $model = new MyAccountForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (password_verify($model->oldPass, $currUser->password) == true) {
                if ($model->newPass === $model->repeatNewPass) {
                    $_password = password_hash($model->repeatNewPass, PASSWORD_DEFAULT);
                    $currUser->password = $_password;
                    $currUser->mod_time = time();
                    $currUser->save();
                    //echo 'password = '.$currUser->password;
                }
            }
        }
        return $this->render('myAccount', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        if (Yii::$app->session->get('auth') == 'ok' || Yii::$app->session->get('auth') != 'ok')
            $this->redirect('login');
        return Yii::$app->session->destroy();
    }
}