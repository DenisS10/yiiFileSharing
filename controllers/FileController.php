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
    public function actionView()
    {

    }

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
            $newFile = new Files();
            $newFile->user_id = Yii::$app->session->get('id');
            $newFile->file_key = $key;
            $newFile->file_link = $link;
            $newFile->extension = $ext;
            $newFile->creation_date = time();
            $newFile->comment = 'No Comment';
            $newFile->save();

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if (!isset($_FILES['UploadForm']['tmp_name'])) {
                header('location: index');
                exit();
            }
            move_uploaded_file($_FILES['UploadForm']['tmp_name']['userFile'], $path . '/' . $name . '.' . $ext);

//            if (isset($_POST['file_key']))
//                header('location: index.php/File/download');

        }
        return $this->render('upload', ['model' => $model]);

    }

    public function actionDownload($key)
    {
        $saveFile = Files::find()->andWhere(['file_key' => $key])->one();
        return Yii::$app->response->sendFile($saveFile->file_link);
//            // $file_key = $this->input->post('file_key');
//            //$this->Files->downloadFile($file_key);
//            //if (file_exists($key)) {
//
//            //exit();
//            //echo 'isset($_POST[\'file_key\']';
//            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
//            // если этого не сделать файл будет читаться в память полностью!
//            if (ob_get_level()) {
//                ob_end_clean();
//            }
//            // заставляем браузер показать окно сохранения файла
//            header('Content-Description: File Transfer');
//            header('Content-Type: application/octet-stream');
//            header('Content-Disposition: attachment; filename=' . basename($saveFile->file_key));
//            header('Content-Transfer-Encoding: binary');
//            header('Expires: 0');
//            header('Cache-Control: must-revalidate');
//            header('Pragma: public');
//            header('Content-Length: ' . filesize($saveFile->file_link));
//            // читаем файл и отправляем его пользователю
//            readfile($saveFile->file_link);

    }
}