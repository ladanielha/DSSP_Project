<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends MY_Controller {
    public function __construct(){
        parent:: __construct();
        $this->load->model('UserModel');
    }
    public function index(){
        if($this->session->userdata('authenticated')) // Jika user sudah login (Session authenticated ditemukan)
            redirect('page/dashboard'); // Redirect ke page dashboard
            
        $data['curr_page'] = "login";
        $this->render_backend('login', $data); // Load view login.php
    }
    public function login(){

        $this->load->library('encryption');
        $key = 'super-secret-key';
        
        $email = $this->input->post('email');       
        $password = md5($this->input->post('password'));
        $data     = $this->UserModel->get($email);
        
        if(empty($data['user'])){ // Jika hasilnya kosong / user tidak ditemukan
            $this->session->set_flashdata('message', 'email tidak ditemukan'); // Buat session flashdata
            redirect('auth'); // Redirect ke halaman login
        }else{
            if($password != $data['user']->password){ // Jika password yang diinput tidak sama dengan password yang didatabase
                $this->session->set_flashdata('message', 'Password salah'); // Buat session flashdata
                redirect('auth'); // Redirect ke halaman login
            }else{ // Jika password yang diinput sama dengan password yang didatabase
                $session = array(
                    'authenticated' => true,                        // Buat session authenticated dengan value true
                    'email'         => $data['user']->email,        // Buat session email
                    'first_name'    => $data['user']->first_name,   // Buat session fname
                    'last_name'     => $data['user']->last_name,    // Buat session lname
                    'role'          => $data['role']                // Buat session role
                );
                if($data['role'] == 'guru') $session['nomor_induk'] = $data['user']->nip;
                else if($data['role'] == 'siswa') $session['nomor_induk'] = $data['user']->nisn;

                $this->session->set_userdata($session); // Buat session sesuai $session
                redirect('page/dashboard'); // Redirect ke halaman dashboard
            }
        }
    }
    public function logout(){
        $this->session->sess_destroy(); // Hapus semua session
        redirect('auth'); // Redirect ke halaman login
    }
}
?>