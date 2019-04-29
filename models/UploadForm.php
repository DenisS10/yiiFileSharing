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
    public $file;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
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