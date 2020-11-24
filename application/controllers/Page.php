<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends MY_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('DatabaseModel');
    }
    public function dashboard(){
        if($this->input->get('filter') !== NULL) $data['curr_filter'] = $this->input->get('filter');
        else $data['curr_filter'] = 'all';
        $data['curr_page'] = "dashboard";
        $data['direksi'] = $this->DatabaseModel->getDatas('direksi');
        $data['dokumen'] = $this->DatabaseModel->getDatas('dokumen');
        // function render_backend tersebut dari file core/MY_Controller.php
        $this->render_backend('dashboard', $data); // load view dashboard.php
    }

    public function viewmail()
	{
        if($this->input->get('filter') !== NULL) $data['curr_filter'] = $this->input->get('filter');
        else $data['curr_filter'] = 'all';
        $data['curr_page'] = "dashboard";
        $data['uri'] = $this->uri->segment(3);
        $data['direksi'] = $this->DatabaseModel->getDatas('direksi');
        $data['dokumen'] = $this->DatabaseModel->getDatas('dokumen');
		//check
		$data['dokumen_detail'] = $this->db->query("SELECT dokumen_id, name, location, upload_date, due_date,status FROM dokumen WHERE dokumen_id = '$uri'");
        $this->render_backend('viewmail', $data); // load viewmail.php
	}

    public function _get_auto_generate_id(){
        $this->load->model('DatabaseModel');
        $lastId = $this->DatabaseModel->getLastId($this->curr_table);
        if($lastId == NULL){
            switch($this->curr_table){
                case 'mata_pelajaran':
                    $lastId = 'MP0000';
                    break;
                case 'kelas':
                    $lastId = 'KS0000';
                    break;
                case 'lesson':
                    $lastId = 'LS0000';
                    break;
                case 'nilai':
                    $lastId = 'NL0000';
                    break;
            }
        }
        $newId = $this->DatabaseModel->getAutoId($lastId, 2, 4);
        return '<input id="field-id" class="form-control" name="id" type="text" value="'.$newId.'" maxlength="6" readonly>';
    }

    public function _callback_column_akhir($value, $row){
        $tugas=$row->tugas;
        $uts=$row->uts;
        $uas=$row->uas;
        $akhir= ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);
        return $akhir;
    }

    public function _callback_column_matpel($value, $row){
        $this->load->model('DatabaseModel');
        $lesson = $this->DatabaseModel->getLesson($row->lessonID);
        $matpel = $this->DatabaseModel->getMatPel($lesson->matpelID);

        return $matpel->name;

    }

    public function _callback_column_guru($value, $row){
        $this->load->model('DatabaseModel');
        $lesson = $this->DatabaseModel->getLesson($row->lessonID);
        $guru = $this->DatabaseModel->getGuru($lesson->guruNIP);

        return $guru->first_name." ".$guru->last_name;

    }

    public function _encrypt_password_callback($post_array, $primary_key = null){
        $post_array['password'] = md5($post_array['password']);
        return $post_array;
    }

}
?>