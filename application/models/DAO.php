<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DAO extends CI_Model {
    function __construct(){
        parent::__construct();
    }

    function login($user, $password){
        $this->db->where('user_usuario',$user);

        $query= $this->db->get('tb_usuarios');

        $user_exists = $query->row();
        if ($user_exists && $user_exists->estatus_usuario == "Activo") {
            
            if ($user_exists->password_usuario==$password) {
                return array(
                    "status" => "success",
                    "data" => $user_exists
                );
            } else {
                return array(
                    "status" => "error",
                    "message" => "La contraseña ingresada es incorrecta"
                );
            }
            
        } else {
            return array(
                "status" => "error",
                "message" => "El usuario ingresado no existe o ya no es valido"
            );
        }    
    }

    function consultarEntidad($nombreEntidad,$filtros = array(),$unico = FALSE){
        if ($filtros) {
            $this->db->where($filtros);
        }
        $query = $this->db->get($nombreEntidad);

        if ($unico) {
            return $query->row();
        }else{
            return $query->result();
        }
    }

    function consultarQueryNativo($query,$filtros = array(),$unico = FALSE){
       /* if ($filtros) {
            $this->db->where($filtros);
        }
        */
        $statement = $this->db->query($query,$filtros);

        if ($unico) {
            return $statement->row();
        }else{
            return $statement->result();
        }
    }

    function guardarEditarDatos($nombreEntidad, $data, $filtros = array()){
        if ($filtros) {
            $this->db->where($filtros);
            $this->db->update($nombreEntidad,$data);
        } else {
            $this->db->insert($nombreEntidad,$data);
        }

        if ($this->db->error()['message'] != "") {
            return array(
                "estatus" => "incorrecto",
                "mensaje" => $this->db->error()['message']
            );
        } else {
            return array(
                "estatus" => "correcto",
                "mensaje" => "Registro correcto"
            );
        }
    }
    
    function iniciar_transaccion(){
        $this->db->trans_begin();
    }

    function terminar_transaccion(){
        $completado=FALSE;
        if ($this->db->trans_status()) {
            $completado = TRUE;
            $this->db->trans_commit();
        } else {
            $this->db->trans_rollback();
        }
        return $completado;
    }

    function obtener_id_insertado(){
        return $this->db->insert_id();
    }

    function actualizaStock($id_producto,$cantidad){
        $this->db->set('stock_producto',"stock_producto - $cantidad",false);
        $this->db->where('id_producto',$id_producto);
        $this->db->update('tb_productos');
    }
}
    
