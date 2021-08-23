<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_cliente extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function get_clienteExpte($id)
	{
		$query = $this->db->get_where('expediente', array('ref_cliente' => $id));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function update_cliente($id,$data)
	{
		$this->db->set($data)->where("id_cliente", $id)->update("cliente");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return false;
        }
	}

	function get_datosCliente($id)
	{
		$query = $this->db->get_where('cliente', array('id_cliente' => $id));
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function getCliente()
	{
		$query = $this->db->query("SELECT * FROM cliente");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function getEstado()
	{
		$query = $this->db->query("SELECT * FROM tipo_estado");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}	
	}

	function getClientes($start,$length,$search)
	{
		$srch = "";
		if ($search) {
			$srch = "WHERE (p.cliente like '%".$search."%' OR 
							p.telefono like '%".$search."%' OR 
							p.correo like '%".$search."%' OR 
							p.direccion like '%".$search."%') ";
		}


		$qnr = "SELECT count(1) cant FROM cliente p ".$srch;
		$qnr = $this->db->query($qnr);
		$qnr = $qnr->row();
		$qnr = $qnr->cant;

		$q = "SELECT * FROM cliente p ".$srch." ORDER BY p.id_cliente DESC limit $start, $length";
		$r = $this->db->query($q);

		$retornar = array(
			'numDataTotal' => $qnr,
			'datos' => $r, 
		);

		return $retornar;
	}

	function agregar_cliente($datos)
	{
		$this->db->insert('cliente', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}
}
?>