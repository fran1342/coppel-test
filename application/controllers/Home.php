<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

        function __construct(){
                parent::__construct();
                $this->_check_session();
        }

	public function index(){
                $this->load->view('includes/header');
                $this->load->view('includes/menu');
                $this->load->view('includes/navbar');
                $this->load->view('Home_page');
                $this->load->view('includes/footer');
        }

        private function _check_session(){
                $session=$this->session->userdata('veterinaria_sess');
                if (!@$session->user_usuario) {
                        redirect('login');
                }
        }

      
}
