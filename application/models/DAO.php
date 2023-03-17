<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DAO extends CI_Model {
    function __construct(){
        parent::__construct();
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
}
    
