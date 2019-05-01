<?php
/**
 * Created by PhpStorm.
 * User: Ден
 * Date: 29.04.2019
 * Time: 19:10
 */

namespace app\controllers;


use app\models\Files;
use app\models\UploadForm;
use Yii;
use yii\web\Controller;

class FileController extends Controller
{
    public function actionUpload()
    {


        $model = new UploadForm();
        // $paths = __DIR__.'../file_dump'

        if (isset($_FILES['UploadForm'])) {
            $name = md5(time() . rand(1, 1000) . $_FILES['UploadForm']['name']['userFile']);
            $key = $name[0] . $name[1] . $name[2] . $name[3] . $name[4] . $name[5] . $name[6] . $name[7];
            Yii::$app->session->open();
            Yii::$app->session->set('keyLink', $key);


            $ext = explode('.', $_FILES['UploadForm']['name']['userFile']);

            $ext = $ext[count($ext) - 1];

            $pathOld = '../file_dump/' . $name[0] . '/' . $name[1] . '/';//;

            $path = str_replace('\\', '/', $pathOld);

            $link = $path . $name;

            //$this->Files->uploadFile($link, $key, $ext);


            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if (!isset($_FILES['UploadForm']['tmp_name'])) {
                header('location: index');
                exit();
            }
            move_uploaded_file($_FILES['UploadForm']['tmp_name']['userFile'],
                $path . '/' . $name . '.' . $ext);
            if(file_exists($path)) {
                $newFile = new Files();
                $newFile->user_id = Yii::$app->session->get('id');
                $newFile->file_key = $key;
                $newFile->file_link = $link;
                $newFile->extension = $ext;
                $newFile->creation_date = time();
                $newFile->file_name = $_FILES['UploadForm']['name']['userFile'];
                $newFile->save();
            }
//            if (isset($_POST['file_key']))
//                header('location: index.php/File/download');

        }
        return $this->render('upload', ['model' => $model]);

    }

    public function actionView()
    {
        $id = Yii::$app->session->get('id');
        $fileArr = Files::find()->andWhere(['user_id' => $id])->all();


        return $this->render('viewfiles', ['fileArr' => $fileArr]);
    }

    public function actionDownload($key)
    {
        $saveFile = Files::find()->andWhere(['file_key' => $key])->one();
        if($saveFile != null) {
            $pathOld = __DIR__ . '/' . $saveFile->file_link . '.' . $saveFile->extension;
            $path = str_replace('\\', '/', $pathOld);

            if (file_exists($path))
                return \Yii::$app->response->sendFile($path);
            else {

                $delNotExistsFile = Files::find()->andWhere(['file_key' => $key])->one();
                $delNotExistsFile->delete();
                return $this->redirect('/file/view');
            }
        }

    }
}