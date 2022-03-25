<?php
class VentaModel extends CI_model{
    public function __construct(){
        $this->load->database();
        $this->load->model('DAO');
    }

    public function porId($id){
        $venta = new StdClass();
        $venta->detalles = $this->detalleDeVenta($id);
        $venta->productos = $this->productosVendidosDeUnaVenta($id);
        return $venta;
    }

    private function detalleDeVenta($id){
        return $this->db
        ->select("tb_ventas.id_venta, tb_ventas.fecha_venta, sum(tb_detalle_venta.cantidad_detalleV * tb_detalle_venta.precio_detalleV) as total")
        ->from("tb_ventas")
        ->join("tb_detalle_venta", "tb_detalle_venta.fk_venta = tb_ventas.id_venta")
        ->where("tb_detalle_venta.fk_venta", $id)
        ->group_by("tb_ventas.id_venta")
        ->get()
        ->row();
    }

    private function productosVendidosDeUnaVenta($idVenta){
        return $this->db
        ->select("tb_productos.nombre_producto, tb_detalle_venta.precio_detalleV, tb_detalle_venta.cantidad_detalleV")
        ->from("tb_productos")
        ->join("tb_detalle_venta", "tb_detalle_venta.fk_producto = tb_productos.id_producto")
        ->where("tb_detalle_venta.fk_venta", $idVenta)
        ->get()
        ->result();
    }

    public function todas(){
        return $this->db
        ->select("tb_ventas.id_venta, tb_ventas.fecha_venta, sum(tb_detalle_venta.cantidad_detalleV * tb_detalle_venta.precio_detalleV) as total")
        ->from("tb_ventas")
        ->join("tb_detalle_venta", "tb_detalle_venta.fk_venta = tb_ventas.id_venta")
        ->group_by("tb_ventas.id_venta")
        ->get()
        ->result();
    }

    public function eliminar($id){
        return $this->db->delete("tb_ventas", array("id_venta" => $id));
    }

    public function nueva($productosVendidos){
        # Primero registramos la venta
        $session = $this->session->userdata('veterinaria_sess');
        $detalleDeVenta = array(
        "fecha_venta" => date("Y-m-d H:i:s"),
        "fk_empleado" => $session->id_usuario
        );
        $this->db->insert("tb_ventas", $detalleDeVenta);

        # Ahora tomamos su ID
        
        $idVenta = $this->db->insert_id();

        # Recorrer el carrito
        foreach($productosVendidos as $producto){
            # El producto que insertamos es diferente al del carrito, sólo necesitamos algunas cosas:
            $detalleDeProductoVendido = array(
                "fk_producto" => $producto->id_producto,
                "cantidad_detalleV" => $producto->cantidad_detalleV,
                "precio_detalleV" => $producto->total,
                "fk_venta" => $idVenta,
            );
            $this->db->insert("tb_detalle_venta", $detalleDeProductoVendido);
            $this->DAO->actualizaStock($producto->id_producto,$producto->cantidad_detalleV);
        }
        return $detalleDeProductoVendido;
    }
}
?>