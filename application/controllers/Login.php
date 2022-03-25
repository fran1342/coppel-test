<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		$this->load->view('Login_page');
	}

	public function autenticar(){
		$this->load->model('DAO');

		if ($this->input->post('pUser') && $this->input->post('pPassword')){
			$user_exists = $this->DAO->login($this->input->post('pUser'),$this->input->post('pPassword'));
			if($user_exists['status'] == 'success'){
				$this->session->set_userdata('veterinaria_sess',$user_exists['data']);
				redirect('home');
			}else{
				$this->session->set_flashdata('error_login',$user_exists['message']);
				redirect('login');
			}
		}else{
			$this->session->set_flashdata('error_login','Datos no enviados');
				redirect('login');
		}
	}

}
