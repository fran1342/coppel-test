<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mascotas extends CI_Controller {

        function __construct(){
                parent::__construct();
                $this->_check_session();
                $this->load->model('DAO');
        }

	public function index(){
                $this->load->view('includes/header');
                $this->load->view('includes/menu');
                $this->load->view('includes/navbar');
                //$data['mascotas'] = $this->DAO->consultarEntidad('tb_mascotas');
                $this->load->view('mascotas/Mascotas_page');
                $this->load->view('includes/footer');
                $this->load->view('mascotas/Mascotasjs');
        }

        function abrir_formulario(){
                if($this->input->is_ajax_request()){
                        $sql =  "SELECT * FROM tb_usuarios WHERE tipo_usuario in(?) AND estatus_usuario = 'Activo'";
                        $data['clientes'] = $this->DAO->consultarQueryNativo($sql,array('Cliente'));
                        if ($this->input->get('codigo_mascota') && $this->input->get('accion')) {
                                $filtro = array(
                                        'id_mascota' => $this->input->get('codigo_mascota')
                                );
                                $mascota_buscar = $this->DAO->consultarEntidad('mascota_usuario',$filtro,TRUE);
                                if ($mascota_buscar) {
                                        $data['accion']=$this->input->get('accion');
                                        $data['mascota_seleccionada'] = $mascota_buscar;
                                        echo $this->load->view('mascotas/Mascotas_form',$data,TRUE);
                                } else {
                                        echo "error";
                                }
                                
                        }else{
                                echo $this->load->view('mascotas/Mascotas_form',$data,TRUE);
                        }
                }else{
                        redirect('home');
                }
        }

        function procesar_formulario(){
                if (@$this->input->post('accion')) {
                        $this->form_validation->set_rules('clave_e','Clave mascota','required');
                        if ($this->input->post('accion') == "borrar") {
                                $validar_extra = FALSE;
                        }else if($this->input->post('accion') == "editar"){
                                $validar_extra = TRUE;
                        }
                }else {
                        $validar_extra = TRUE;
                }
    
                if ($validar_extra) {
                        $this->form_validation->set_rules('nombre_m','Nombre','required|min_length[2]|max_length[120]');
                        $this->form_validation->set_rules('raza_m','Raza','required|min_length[2]|max_length[200]');
                        $this->form_validation->set_rules('edad_m','Edad','required|min_length[3]|max_length[20]');
                        $this->form_validation->set_rules('foto_m','Foto','callback_validar_foto');
                        $this->form_validation->set_rules('dueno_m','Dueño','required');      
                }
    
                if ($this->form_validation->run()) {
                        if ($validar_extra) {
                                
                                $config['upload_path'] = "./files/";
                                $config['allowed_types'] = "png|jpg";
                                $config['max_size'] = 2048;
                                $config['encrypt_name'] = TRUE;
                                $this->load->library('upload',$config);
                                if ($this->upload->do_upload('foto_m')) {
                                        $data_mascota = array(
                                                "nombre_mascota" => $this->input->post('nombre_m'),
                                                "raza_mascota" => $this->input->post('raza_m'),
                                                "edad_mascota" => $this->input->post('edad_m'),
                                                "foto_mascota" => site_url().'files/'.$this->upload->data()['file_name'],
                                                "fk_usuario" => $this->input->post('dueno_m'),
                                        );
                                        
                                }else{
                                        $respuesta=array(
                                                "message" => "Error al subir foto" .$this->upload->display_errors()
                                        );
                                        echo json_encode($respuesta);
                                }
                        } else {
                                $data_mascota = array(
                                        "estatus_mascota" => "Inactivo"
                                );
                                $data_ClienteMascota = array(
                                        "fk_cliente" => $this->input->post('dueno_m')
                                );
                        }
                        $filtro = array();
                        $filtro2=array();
                        if (@$this->input->post('accion')) {
                                $filtro = array(
                                        "id_mascota" => $this->input->post('clave_e')
                                );
                                $filtro2=array(
                                        "fk_mascota" => $this->input->post('clave_e')
                                );
                        }
                        
                        $this->DAO->iniciar_transaccion();

                        $respuesta = $this->DAO->guardarEditarDatos('tb_mascotas',$data_mascota,$filtro);
                        if($filtro){
                                $id_mascota = $this->input->post('clave_e');
                        }else{
                                $id_mascota = $this->DAO->obtener_id_insertado();

                        }
                        
                        $data_ClienteMascota = array(
                                "fk_cliente" => $this->input->post('dueno_m'),
                                "fk_mascota" => $id_mascota 
                                        
                        );
                                        
                        $this->DAO->guardarEditarDatos('tb_clienteMascota',$data_ClienteMascota,$filtro2);
                                        
                        $this->DAO->terminar_transaccion();
                                        
                        echo json_encode($respuesta);
                
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
               
                $filtro=array(
                    "estatus_mascota" => "Activo"
                );
                $data['mascotas'] = $this->DAO->consultarEntidad('mascota_usuario',$filtro);
                echo $this->load->view('mascotas/Mascotas_contenido',$data,TRUE);
            }else{
                redirect('home');
            }
            
        }

        function validar_foto($valor){
                if (isset($_FILES['foto_m']) && $_FILES['foto_m'] && !empty($_FILES['foto_m']['name'])) {
                    return true;
                } else {
                    $this->form_validation->set_message('validar_foto','El campo {field} no es valido');
                    return false;
                }
                
            }

        private function _check_session(){
                $session=$this->session->userdata('veterinaria_sess');
                if (!@$session->user_usuario) {
                        redirect('login');
                }
        }

      
}
