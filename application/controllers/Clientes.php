<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

        function __construct(){
                parent::__construct();
                $this->_check_session();
                $this->load->model('DAO');
        }

	public function index(){
                $this->load->view('includes/header');
                $this->load->view('includes/menu');
                $this->load->view('includes/navbar');
                $this->load->view('clientes/Clientes_page');
                $this->load->view('includes/footer');
                $this->load->view('clientes/Clientesjs');
        }

        function abrir_formulario(){
                if($this->input->is_ajax_request()){
                        if ($this->input->get('codigo_cliente') && $this->input->get('accion')) {
                                $filtro = array(
                                        'id_usuario' => $this->input->get('codigo_cliente')
                                );
                                $cliente_buscar = $this->DAO->consultarEntidad('tb_usuarios',$filtro,TRUE);
                                if ($cliente_buscar) {
                                        $data['accion']=$this->input->get('accion');
                                        $data['cliente_seleccionado'] = $cliente_buscar;
                                        echo $this->load->view('clientes/Clientes_form',$data,TRUE);
                                } else {
                                        echo "error";
                                }
                                
                        }else{
                                echo $this->load->view('clientes/Clientes_form',null,TRUE);
                        }
                }else{
                        redirect('home');
                }
        }

        function procesar_formulario(){
                if (@$this->input->post('accion')) {
                        $this->form_validation->set_rules('clave_e','Clave cliente','required');
                        if ($this->input->post('accion') == "borrar") {
                                $validar_extra = FALSE;
                        }else if($this->input->post('accion') == "editar"){
                                $validar_extra = TRUE;
                        }
                }else {
                        $validar_extra = TRUE;
                }
    
                if ($validar_extra) {
                        $this->form_validation->set_rules('nombre_e','Nombre','required|min_length[4]|max_length[150]');
                        $this->form_validation->set_rules('apellido_e','Apellidos','required|min_length[4]|max_length[150]');
                        $this->form_validation->set_rules('tel_e','Telefono','required|min_length[7]|max_length[10]|numeric');
                        $this->form_validation->set_rules('user_e','Usuario','required|min_length[4]|max_length[150]');   
                }

                if ($this->form_validation->run()) {

                        $password = $this->randomPassword();

                        if ($validar_extra) {
                                $data = array(
                                        "nombre_usuario" => $this->input->post('nombre_e'),
                                        "apellidos_usuario" => $this->input->post('apellido_e'),
                                        "tel_usuario" => $this->input->post('tel_e'),
                                        "user_usuario" => $this->input->post('user_e'),
                                        "password_usuario" => $password,
                                        "tipo_usuario" => "Cliente",
                                );
                        } else {
                                $data = array(
                                        "estatus_usuario" => "Inactivo"
                                );
                        }
    
                        $filtro = array();
                        if (@$this->input->post('accion')) {
                                $filtro = array(
                                        "id_usuario" => $this->input->post('clave_e')
                                );
                        }
    
                        $completado = $this->DAO->guardarEditarDatos('tb_usuarios',$data,$filtro);
                        if ($completado) {
                                $respuesta=array(
                                        "estatus" => "correcto",
                                        "mensaje" => "Cliente registrado correctamente : [Usuario: ". 
                                        $this->input->post('user_e') ." Contraseña: ". $password ."]"
                                );
                                echo json_encode($respuesta);
                        } else {
                                $respuesta = array(
                                        "estatus" => "incorrecto",
                                        "mensaje" => $this->form_validation->error_array()
                                );
                                echo json_encode($respuesta);
                        }
                        
                        
                }else{
                        $respuesta = array(
                                "estatus" => "incorrecto",
                                "errores" => $this->form_validation->error_array()
                        );
                        echo json_encode($respuesta);
                }
        }

        function mostrarContenido(){
                if ($this->input->is_ajax_request()) {
                   
                    $sql =  "SELECT * FROM tb_usuarios WHERE tipo_usuario in(?) AND estatus_usuario = 'Activo'";
                    $data['clientes'] = $this->DAO->consultarQueryNativo($sql,array('Cliente'));
                    $filtro=array(
                            "estatus_mascota"=>"Activo"
                        );
                    $data['mascotas'] = $this->DAO->consultarEntidad('vista_clienteMascota',$filtro);
                    echo $this->load->view('clientes/Clientes_contenido',$data,TRUE);
                }else{
                    redirect('home');
                }
                
            }

        private function randomPassword() {
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $pass = array(); 
                $alphaLength = strlen($alphabet) - 1; 
                for ($i = 0; $i < 8; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                }
                return implode($pass); 
        }

        private function _check_session(){
                $session=$this->session->userdata('veterinaria_sess');
                if (!@$session->user_usuario) {
                        redirect('login');
                }
        }

      
}
