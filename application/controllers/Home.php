<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

        function __construct(){
                parent::__construct();
                $this->load->model('DAO');
        }

	public function index(){
                $this->load->view('includes/header');
                $this->load->view('includes/menu');
                $this->load->view('includes/navbar');
                $this->load->view('Home_page');
                $this->load->view('includes/footer');
                $this->load->view('PruebaJs');
        }

        function abrir_modal_informacion(){
                if($this->input->is_ajax_request()){  
                        echo $this->load->view('Consulta',null,TRUE);
                }else{
                        redirect('home');
                }
        }

        function abrir_formulario(){
                $data['departamentos'] = $this->DAO->consultarEntidad("departamentos",null);
                if($this->input->is_ajax_request()){  

                        echo $this->load->view('Form',$data,TRUE);
                }else{
                        redirect('home');
                }
        }

        function procesar_formulario(){
                if (@$this->input->post('accion')) {
                        if ($this->input->post('accion') == "borrar") {
                                $validar_extra = FALSE;
                        }
                }else {
                        $validar_extra = TRUE;
                }
    
                if ($validar_extra) {
                        $this->form_validation->set_rules('sku_p','Sku','required|max_length[6]|numeric');
                        $this->form_validation->set_rules('articulo_p','Articulo','required|max_length[15]');
                        $this->form_validation->set_rules('marca_p','Marca','required|max_length[15]');
                        $this->form_validation->set_rules('modelo_p','Departamento','required|max_length[20]');    
                        $this->form_validation->set_rules('stock_p','Stock','required|numeric');    
                        $this->form_validation->set_rules('cantidad_p','Cantidad','required|numeric');    
                }
    
                if ($this->form_validation->run() || $validar_extra == false) {
    
                        $today = date("Y-m-d");
                        if ($validar_extra) {
                        if($this->input->post('descontinuado_p') != null){
                                        $valueCheckbox = 1;
                                }else{
                                        $valueCheckbox = 0;
                                }
                                $data = array(
                                        "producto_sku" => $this->input->post('sku_p'),
                                        "producto_articulo" => $this->input->post('articulo_p'),
                                        "producto_marca" => $this->input->post('marca_p'),
                                        "producto_modelo" => $this->input->post('modelo_p'),
                                        "fk_departamento" => $this->input->post('depa_p'),
                                        "fk_clase" => $this->input->post('clase_p'),
                                        "fk_familia" => $this->input->post('familia_p'),
                                        "producto_stock" => $this->input->post('stock_p'),
                                        "producto_cantidad" => $this->input->post('cantidad_p'),        
                                        "producto_descontinuado" => $valueCheckbox,
                                        "producto_fecha_alta" => $today
                                );
                                if ($valueCheckbox == 1) {
                                        $data['producto_fecha_baja'] = $today;
                                }else{
                                        $data['producto_fecha_baja'] = "1900-01-01";
                                }
                        } else {
                                $data = array(
                                        "producto_fecha_baja" => $today,
                                        "producto_status" => "Inactivo"
                                );
                                
                        }
                        
                        $filtroSku = array(
                                "producto_sku" => $this->input->post('sku_p')
                        );
                        $sku = $this->DAO->consultarEntidad("productos",$filtroSku,TRUE);
                        $filtro = array();
                        if (@$this->input->post('accion') || @$sku) {
                                $filtro = array(
                                        "producto_sku" => $this->input->post('sku_p')
                                );
                                unset($data["producto_fecha_alta"]);
                        }
    
                        $completado = $this->DAO->guardarEditarDatos('productos',$data,$filtro);
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

        function obtener_clases(){
                $id_departamento = $this->input->post("departamento");
                $filtro = array("fk_departamento"=>$id_departamento);
                $clases = $this->DAO->consultarEntidad("clases",$filtro);
                if (@$clases) {
                        echo json_encode($clases);
                }
        }

        function obtener_familias(){
                $id_clase = $this->input->post("clase");
                $filtro = array("fk_clase"=>$id_clase);
                $familias = $this->DAO->consultarEntidad("familias",$filtro);
                if (@$familias) {
                        echo json_encode($familias);
                }
        }

        function consultar_sku(){
                $sku = $this->input->post("sku");
                // $filtro=array("producto_sku" => $sku);
                // $producto = $this->DAO->consultarEntidad("productos",$filtro,TRUE);
                $producto = $this->DAO->consultarQueryNativo("call seleccionar_producto(".$sku.")",null,TRUE);
                if(@$producto){
                        $respuesta = array(
                                "status" => "correcto",
                                "mensaje" => "El producto es existente",
                                "data" => $producto
                        );
                }else{
                        $respuesta = array(
                                "status" => "error",
                                "mensaje" => "El producto no existe, registre uno nuevo",
                                "data" => null
                        );
                }
                if (@$this->input->post("accion")) {
                        echo $this->load->view("Consulta_contenido",$respuesta,TRUE);
                }else{
                        echo json_encode($respuesta);
                }
        }

        function consultar_opciones(){
                $depa = $this->input->post("depa_id");
                $clase = $this->input->post("clas_id");

                $opcionesClases = $this->DAO->consultarEntidad("clases",array("fk_departamento"=>$depa));
                $opcionesFamilias = $this->DAO->consultarEntidad("familias",array("fk_clase"=>$clase));

                if (@$opcionesClases && $opcionesFamilias) {
                        $response = array(
                                "status" => "correcto",
                                "mensaje" => "Se encontraron las opciones",
                                "clases" => $opcionesClases,
                                "familias" => $opcionesFamilias
                        );
                }else{
                        $response = array(
                                "status" => "error",
                                "mensaje" => "No se encontraron las opciones",
                        );
                }
                echo json_encode($response);

        }
      
}
