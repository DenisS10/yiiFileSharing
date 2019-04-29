<?

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $userFile;

    public function rules()
    {
        return [
            [['userFile'], 'file', 'skipOnEmpty' => false,],
        ];
    }

    public function attributeLabels()
    {
        return [
            'userFile' => 'Enter you file',

        ];
    }

    public function upload()
    {
//        $this->load->view('header');
//        $this->load->view('files/file_sharing_index');
//        $this->load->view('footer');
//        $this->load->database();
//        // $this->load->library('upload');
//        $this->load->library('session');
//        //$this->Files->upload($file);
//        $this->load->model('Files');


    }

    public function saveFile()
    {

    }
}