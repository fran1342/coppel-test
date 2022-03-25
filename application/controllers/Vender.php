<?php 

class Vender extends CI_Controller{

    public function __construct(){
        parent::__construct();
        //$this->_check_session();
        $this->load->library('session');
        $this->load->model('DAO');
    }

    public function index(){
        if (!$this->session->has_userdata('carrito'))
            $this->session->set_userdata('carrito',array());
        $carrito = $this->session->carrito;

        $this->load->view('includes/header');
        $this->load->view('includes/menu');
        $this->load->view('includes/navbar');
        $this->load->view('vender/Vender',array("carrito" => $carrito));
        $this->load->view('includes/footer');

    }

    public function quitarDelCarrito($indice){
        $carrito = $this->session->carrito;
        array_splice($carrito, $indice, 1);
        $this->session->set_userdata("carrito", $carrito);
        redirect("vender/");
    }

    public function cancelarVenta(){
        $this->vaciarCarrito();
        $this->session->set_flashdata(array(
            "mensaje" => "Venta cancelada correctamente",
            "clase" => "success",
        ));
        redirect("vender/");
    }

    private function vaciarCarrito(){
        $this->session->set_userdata("carrito", array());
    }

    public function terminarVenta(){
        $carrito = $this->session->carrito;
        //Primero ver si hay algo en el carrito, si no, indicarlo
        if(count($carrito) < 1){
            $this->session->set_flashdata(array(
                "mensaje" => "Para vender, primero tienes que agregar productos al carrito",
                "clase" => "warning",
            ));
            redirect("vender/");
        }
        $this->load->model("VentaModel");
        $resultado = $this->VentaModel->nueva($carrito);
        if($resultado){
            $this->vaciarCarrito();
            $this->session->set_flashdata(array(
                "mensaje" => "Venta realizada correctamente",
                "clase" => "success",
            ));
            redirect("vender/");
        }else{
            $this->session->set_flashdata(array(
                "mensaje" => "Error realizando la venta, intente de nuevo",
                "clase" => "danger",
            ));
            redirect("vender/");
        }        
    }

    private function agregarAlCarrito($producto){
        $carrito = $this->session->carrito;
        $producto->cantidad_detalleV = 1;
        $producto->total = $producto->cantidad_detalleV * $producto->precio_producto;
        array_push($carrito, $producto);
        $this->session->set_userdata("carrito", $carrito);
    }

    private function obtenerIndiceSiExiste($codigo){
        $carrito = $this->session->carrito;
        $conteo = count($carrito);
        for($indice = 0; $indice < $conteo; $indice++){
            if($carrito[$indice]->id_producto === $codigo) return $indice;
        }
        return -1;
    }

    private function aumentarCantidad($indice,$id){
        $carrito = $this->session->carrito;
        $producto = $carrito[$indice];
        
        $filtro=array("id_producto"=>$id,"estatus_producto" => "Activo");
        $stock = $this->DAO->consultarEntidad('tb_productos',$filtro,TRUE);
        
        if($producto->cantidad_detalleV < $stock->stock_producto){
            $producto->cantidad_detalleV++;
            $producto->total = $producto->cantidad_detalleV * $producto->precio_producto;
            $carrito[$indice] = $producto;
            $this->session->set_userdata("carrito", $carrito);
        }else{
            $this->session->set_flashdata(array(
                "estatus" => "error",
                "mensaje" => "No hay suficiente existencia del producto",
                "clase" => "warning"
            ));
        }
    }

    public function agregar(){
        $id = $this->input->post("pro_v");
        $filtro=array("id_producto"=>$id,"estatus_producto" => "Activo");
        $indice = $this->obtenerIndiceSiExiste($id);
        # Si el producto ya estaba en el carrito...
        if($indice !== -1){
            # Simplemente le aumentamos la cantidad
            $this->aumentarCantidad($indice,$id);   
        }else{
            #Si no, es uno nuevo
            
            //$this->load->model("DAO");
            $producto = $this->DAO->consultarEntidad('tb_productos',$filtro,TRUE);

            # Pero puede que no exista un producto con ese código
            if(null === $producto){
                $this->session->set_flashdata(array(
                    "estatus" => "error",
                    "mensaje" => "No existe un producto registrado con el ID que se ingresó",
                    "clase" => "warning"
                ));
                
            # O que no tenga existencia 
            }else if($producto->stock_producto < 1){
                $this->session->set_flashdata(array(
                    "estatus" => "error",
                    "mensaje" => "No hay suficiente existencia del producto",
                    "clase" => "warning"
                ));
            }else{
                # Y caso de que sí exista y la existencia sea suficiente...
                $this->agregarAlCarrito($producto);
                
            }
        }
        
        # Al final, en cualquier caso redireccionamos, ya sea con o sin mensajes
        redirect("vender/");
    }

    /*private function _check_session(){
        $session=$this->session->userdata('veterinaria_sess');
        if (!@$session->user_usuario) {
                redirect('login');
        }
    }*/
}

?>