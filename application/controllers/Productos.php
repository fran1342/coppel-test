<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

        function __construct(){
                parent::__construct();
                $this->_check_session();
                $this->load->model('DAO');
        }

	public function index(){
                $this->load->view('includes/header');
                $this->load->view('includes/menu');
                $this->load->view('includes/navbar');
                $data['productos'] = $this->DAO->consultarEntidad('tb_productos');
                $this->load->view('productos/Productos_page',$data);
                $this->load->view('includes/footer');
                $this->load->view('productos/Productosjs');
        }

        function abrir_formulario(){
            if($this->input->is_ajax_request()){
                    if ($this->input->get('codigo_producto') && $this->input->get('accion')) {
                            $filtro = array(
                                    'id_producto' => $this->input->get('codigo_producto')
                            );
                            $producto_buscar = $this->DAO->consultarEntidad('tb_productos',$filtro,TRUE);
                            if ($producto_buscar) {
                                    $data['accion']=$this->input->get('accion');
                                    $data['producto_seleccionado'] = $producto_buscar;
                                    echo $this->load->view('productos/Productos_form',$data,TRUE);
                            } else {
                                    echo "error";
                            }
                            
                    }else{
                            echo $this->load->view('productos/Productos_form',null,TRUE);
                    }
            }else{
                    redirect('home');
            }
        }

        function procesar_formulario(){
            if (@$this->input->post('accion')) {
                    $this->form_validation->set_rules('clave_e','Clave producto','required');
                    if ($this->input->post('accion') == "borrar") {
                            $validar_extra = FALSE;
                    }else if($this->input->post('accion') == "editar"){
                            $validar_extra = TRUE;
                    }
            }else {
                    $validar_extra = TRUE;
            }

            if ($validar_extra) {
                    $this->form_validation->set_rules('nombre_p','Nombre','required|min_length[4]|max_length[150]');
                    $this->form_validation->set_rules('desc_p','Descripcion','required|min_length[4]|max_length[200]');
                    $this->form_validation->set_rules('precio_p','Precio','required|numeric');
                    $this->form_validation->set_rules('tipo_p','Tipo de producto','required');    
            }

            if ($this->form_validation->run()) {

                    if ($validar_extra) {
                            $data = array(
                                    "nombre_producto" => $this->input->post('nombre_p'),
                                    "descripcion_producto" => $this->input->post('desc_p'),
                                    "precio_producto" => $this->input->post('precio_p'),
                                    "stock_producto" => $this->input->post('stock_p'),
                                    "tipo_producto" => $this->input->post('tipo_p')
                            );
                    } else {
                            $data = array(
                                    "estatus_producto" => "Inactivo"
                            );
                    }

                    $filtro = array();
                    if (@$this->input->post('accion')) {
                            $filtro = array(
                                    "id_producto" => $this->input->post('clave_e')
                            );
                    }

                    $completado = $this->DAO->guardarEditarDatos('tb_productos',$data,$filtro);
                    if ($completado) {
                            $respuesta=array(
                                    "estatus" => "correcto",
                                    "mensaje" => "Producto registrado correctamente"
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
               
                $filtro=array(
                    "estatus_producto" => "Activo"
                );
                $data['productos'] = $this->DAO->consultarEntidad('tb_productos',$filtro);
                echo $this->load->view('productos/Productos_contenido',$data,TRUE);
            }else{
                redirect('home');
            }
            
        }

        private function _check_session(){
                $session=$this->session->userdata('veterinaria_sess');
                if (!@$session->user_usuario) {
                        redirect('login');
                }
        }

      
}
