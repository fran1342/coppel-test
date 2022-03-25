<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

        function __construct(){
                parent::__construct();
                $this->_check_session();
                $this->load->model('DAO');
                //$this->load->model("VentaModel");
        }

	    public function index(){
                $this->load->view('includes/header');
                $this->load->view('includes/menu');
                $this->load->view('includes/navbar');
                $data['ventas'] = $this->DAO->consultarEntidad('vista_ventas');                
                $this->load->view('ventas/Ventas_page',$data);
                $this->load->view('includes/footer');
                $this->load->view('ventas/Ventasjs');

        }

        function abrir_formulario(){
            if($this->input->is_ajax_request()){
                /*$filtro=array(
                        'categoria_estatus' => 'Activo'
                );
                $data['categorias'] = $this->DAO->consultarEntidad('tb_categorias',$filtro);*/
                    if ($this->input->get('codigo_venta') && $this->input->get('accion')) {
                            $filtro = array(
                                    'id_venta' => $this->input->get('codigo_venta')
                            );
                            $filtro2 = array(
                                    'fk_venta' => $this->input->get('codigo_venta')
                            );
                            $venta_buscar = $this->DAO->consultarEntidad('vista_ventas',$filtro,TRUE);
                            if ($venta_buscar) {
                                    $data['accion']=$this->input->get('accion');
                                    $data['venta_seleccionada'] = $venta_buscar;
                                    $data['detalle'] = $this->DAO->consultarEntidad('vista_ticket',$filtro2);
                                    echo $this->load->view('ventas/Ventas_form',$data,TRUE);
                            } else {
                                    echo "error";
                            }
                            
                    }else{
                            echo $this->load->view('ventas/Ventas_form',null,TRUE);
                    }
            }else{
                    redirect('home');
            }
        }

        function mostrarContenido(){
            if($this->input->is_ajax_request()){
                    $data['ventas'] = $this->DAO->consultarEntidad('vista_ventas');
                    echo $this->load->view('ventas/Ventas_contenido',$data,TRUE);
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
