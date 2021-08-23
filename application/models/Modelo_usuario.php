<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_usuario extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function agregar_usuario($datos)
	{
		$this->db->insert('usuario', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}

	function agregar_estado($datos)
	{
		$this->db->insert('tipo_estado', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}

	function update_usuario($id,$data)
	{
		$this->db->set($data)->where("id_usuario", $id)->update("usuario");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return null;
        }
	}

	function eliminar_usuario($id)
	{
		$this->db->where("id_usuario", $id)->delete("usuario");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}

	function eliminar_estado($id)
	{
		$this->db->where("id_estado", $id)->delete("tipo_estado");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}

	function get_usuario($username,$password)
	{
		$this->db->select("*")->from("usuario");
		$this->db->where('correo', $username);
		$this->db->where('password', $password);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}
	function getEstado($start,$length,$search)
	{
		$srch = "";
		if ($search) {
			$srch = "WHERE (p.estado like '%".$search."%' OR 
							p.alta_estado like '%".$search."%') ";
		}


		$qnr = "SELECT count(1) cant FROM tipo_estado p ".$srch;
		$qnr = $this->db->query($qnr);
		$qnr = $qnr->row();
		$qnr = $qnr->cant;

		$q = "SELECT * FROM tipo_estado p ".$srch." ORDER BY p.id_estado DESC limit $start, $length";
		$r = $this->db->query($q);

		$retornar = array(
			'numDataTotal' => $qnr,
			'datos' => $r, 
		);

		return $retornar;
	}

	function getUsuario($start,$length,$search)
	{
		$srch = "";
		if ($search) {
			$srch = "WHERE (p.nombre like '%".$search."%' OR 
							p.correo like '%".$search."%' OR 
							p.permisos like '%".$search."%') ";
		}


		$qnr = "SELECT count(1) cant FROM usuario p ".$srch;
		$qnr = $this->db->query($qnr);
		$qnr = $qnr->row();
		$qnr = $qnr->cant;

		$q = "SELECT * FROM usuario p ".$srch." ORDER BY p.id_usuario DESC limit $start, $length";
		$r = $this->db->query($q);

		$retornar = array(
			'numDataTotal' => $qnr,
			'datos' => $r, 
		);

		return $retornar;
	}
}
?>