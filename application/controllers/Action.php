<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require $_SERVER['DOCUMENT_ROOT'] . "/DSSP_Project" . '/vendor/convertapi/convertapi-php/lib/ConvertApi/autoload.php';
use \ConvertApi\ConvertApi;
class Action extends MY_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('DatabaseModel');
        $this->load->model('UserModel');
    }
    public function file_upload(){
        $direksi_id = $this->input->post('direksi');
        if (!empty($_FILES) && isset($_FILES['fileToUpload']) && $direksi_id !== NULL) {
            $allowedExts = array(
                "pdf"
            );
            $uploadOk = false;
            switch ($_FILES['fileToUpload']["error"]) {
                case UPLOAD_ERR_OK:
                    $file_id = md5('dok'.($this->DatabaseModel->getNumRows('dokumen')+1));
                    $file_name = basename($_FILES['fileToUpload']['name']);
                    $file_ext = end(explode(".", $_FILES["fileToUpload"]["name"]));
                    $file_loc = './assets/uploads/files/';
                    $file_loc = $file_loc . $file_id . '.' . $file_ext;
                    $file_loc2 = '/assets/uploads/files/' . $file_id . '.' . $file_ext;
                    if (in_array($file_ext, $allowedExts)){
                        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $file_loc)) {
                            $msg = "The file " . $file_name . " has been uploaded successfully";
                            $uploadOk = true;
                            // generate thumbnail
                            // pastikan sudah menjalankan command "composer require convertapi/convertapi-php"
                            // tanpa tanda kutip
                            ConvertApi::setApiSecret('oZ5quO9fgxMI8b4s');
                            $result = ConvertApi::convert('thumbnail', [
                                    'File' => $file_loc,
                                    'FileName' => $file_id,
                                    'PageRange' => '1',
                                ], 'pdf'
                            ); 
                            $result->saveFiles('./assets/uploads/thumbnails');
                            $thumbnail_loc = '/assets/uploads/thumbnails/' . $file_id . '.jpg';
                            
                            // insert to database
                            // Data
                            date_default_timezone_set("Asia/Jakarta");

                            //date('m/d/Y H:i:s', strtotime("now"));
                            //strtotime("now");

                            //date('m/d/Y H:i:s', strtotime("+1 week"));
                            //strtotime("+1 week");
                            $user = $this->UserModel->getUser($this->session->userdata('email'), 'finance');
                            $data = array(
                                'dokumen_id' => $file_id,
                                'finance_id' => $user->finance_id,
                                'direksi_id' => $direksi_id,
                                'signature_id' => NULL,
                                'name' => substr($file_name, 0, strrpos($file_name, '.')),
                                'location' => $file_loc2,
                                'thumbnail' => $thumbnail_loc,
                                'upload_date' => strtotime("now"),
                                'due_date' => strtotime("+1 week"),
                                'status' => "pending",
                            );

                            // Table
                            $table = 'dokumen';

                            $this->DatabaseModel->insertData($table, $data);
                            
                        }
                        else {
                            $msg = "Sorry, there was a problem uploading your file.";
                        }
                    }
                    else{
                        $msg = "File type must PDF";
                    }
                    break;
            }
            $data['msg'] = $msg;
            $data['status'] = $uploadOk;
            $this->session->set_flashdata('data', $data);
            redirect('page/dashboard');
        }else{
            $data['msg'] = 'Something went wrong';
            if($direksi_id === NULL) $data['msg'] = 'Direksi field cannot be empty';
            $data['status'] = false;
            $this->session->set_flashdata('data', $data);
            redirect('page/dashboard');
        }
    }
}
?>