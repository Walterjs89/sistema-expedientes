<?php if ( ! defined('BASEPATH')) exit('no se permite acceso directo al scrip');

class Modelo_expediente extends CI_Model
{	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	function agregar_expte($datos)
	{
		$this->db->insert('expediente', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}

	function agregar_relacion($datos)
	{
		$this->db->insert('relacion_expediente', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}

	function agregar_historial($datos)
	{
		$this->db->insert('historial_act', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}

	function agregar_actividad($datos)
	{
		$this->db->insert('actividad', $datos);
		if ($this->db->affected_rows() === 1) {
            $id = $this->db->insert_id();
            return $id;
        }
        else {
            return false;
        }
	}

	function updateEstadoExpte($id,$data)
	{
		$this->db->set($data)->where("id_expte", $id)->update("expediente");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return null;
        }
	}

	function update_expte($id,$data)
	{
		$this->db->set($data)->where("id_expte", $id)->update("expediente");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return null;
        }
	}

	function update_actividad($id,$data)
	{
		$this->db->set($data)->where("id_actividad", $id)->update("actividad");
		if ($this->db->trans_status() === true) {
            return true;
        } else {
            return null;
        }
	}

	function get_relacion($id)
	{
		$query = $this->db->query("SELECT * FROM relacion_expediente r INNER JOIN expediente e ON r.hijo_expte = e.id_expte WHERE r.hijo_expte = $id ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function getRelacion($id)
	{
		$query = $this->db->query("SELECT * FROM relacion_expediente r WHERE hijo_expte = $id ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function getHistorial($id)
	{
		$query = $this->db->query("SELECT * FROM historial_act WHERE ref_actividad = $id order by id_hact desc");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function getDatosExpte($id)
	{
		$query = $this->db->query("SELECT * FROM expediente WHERE id_expte = $id");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function get_expediente($id)
	{
		// $query = $this->db->get_where('expediente', array('id_expte' => $id));
		$query = $this->db->query("SELECT * FROM expediente e INNER JOIN cliente c ON e.ref_cliente = c.id_cliente WHERE e.id_expte = $id ");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}
	}

	function eliminar_expte($id)
	{
		$this->db->where("id_expte", $id)->delete("expediente");
        if ($this->db->trans_status() === true) {
            return true;
        }else{
            return null;
        }
	}

	function get_expedienteReporte($cliente,$estado,$mes,$fecha)
	{
		$e = $m = $c = $and = $f = "";
		if ($cliente != "Vacio") {
			$c = " e.ref_cliente = '$cliente'";
			$and = "AND";
		}
		if ($estado != "Vacio") {
			$e = $and." e.estado_expte = '$estado'";
			$and = "AND";
		}
		if ($mes != "Vacio") {
			$m = $and." e.periodo = '$mes'";
		}
		if ($fecha != "Vacio") {
			$f = $and." e.alta_expte = '$fecha' ";
		}
		if ($cliente == "Vacio" && $estado == "Vacio" && $mes == "Vacio" && $fecha == "Vacio") {
			$query = $this->db->query("SELECT * FROM expediente e INNER JOIN cliente c ON e.ref_cliente = c.id_cliente");
		}else{
			$query = $this->db->query("SELECT * FROM expediente e INNER JOIN cliente c ON e.ref_cliente = c.id_cliente WHERE ".$c.$e.$m.$f." ");
		}
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_expedienteClienteEstado($estado)
	{
		$query = $this->db->query("SELECT * FROM expediente e INNER JOIN cliente c ON e.ref_cliente = c.id_cliente WHERE e.estado_expte = '$estado' ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}	
	}

	function get_expedienteClienteMes($mes)
	{
		$query = $this->db->query("SELECT * FROM expediente e INNER JOIN cliente c ON e.ref_cliente = c.id_cliente WHERE e.mes = '$mes' ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}	
	}

	function getEstado()
	{
		$query = $this->db->get('tipo_estado');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_expedienteClienteCliente($cliente)
	{
		$query = $this->db->query("SELECT * FROM expediente e INNER JOIN cliente c ON e.ref_cliente = c.id_cliente WHERE e.ref_cliente = '$cliente' ");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}		
	}

	function get_expedienteCliente()
	{
		$query = $this->db->query("SELECT * FROM expediente e INNER JOIN cliente c ON e.ref_cliente = c.id_cliente");
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function getExpedientes()
	{
		$query = $this->db->get('expediente');
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_actividad($id)
	{
		$query = $this->db->get_where('actividad', array('ref_expte' => $id));
		if ($query->num_rows() > 0) {
			return $query;
		}else{ 
			return false;
		}
	}

	function get_excelExpediente($cliente,$estado,$mes)
	{
		// Nº Expte Periodo Monto Nº Pedido Estado

		$e = $m = $c = $and = "";
		if ($cliente != "Vacio") {
			$c = " e.ref_cliente = '$cliente'";
			$and = "AND";
		}
		if ($estado != "Vacio") {
			$e = $and." e.estado_expte = '$estado'";
			$and = "AND";
		}
		if ($mes != "Vacio") {
			$m = $and." e.periodo = '$mes'";
		}
		if ($cliente == "Vacio" && $estado == "Vacio" && $mes == "Vacio") {
			$query = $this->db->query("SELECT c.cliente as NOMBRE, e.num_expte as NUM_EXPTE, e.monto as MONTO, e.num_pedido as PEDIDO, e.estado_expte as ESTADO  FROM expediente e INNER JOIN cliente c ON e.ref_cliente = c.id_cliente");
			$fields = $query->field_data();
		}else{
			$query = $this->db->query("SELECT c.cliente as NOMBRE, e.num_expte as NUM_EXPTE, e.monto as MONTO, e.num_pedido as PEDIDO, e.estado_expte as ESTADO FROM expediente e INNER JOIN cliente c ON e.ref_cliente = c.id_cliente WHERE ".$c.$e.$m." ");
			$fields = $query->field_data();
		}
		return array("fields" => $fields, "query" => $query);
	}

	function getExpediente($start,$length,$search,$cliente,$numero,$periodo,$num_pedido,$estado)
	{
		$srch = $srch1 = $srch2 = $srch3 = $srch4 = $srch5 = "";
		if ($search) {
			$srch = "AND (p.num_expte like '%".$search."%' OR 
							p.periodo like '%".$search."%' OR 
							p.num_pedido like '%".$search."%' OR 
							c.cliente like '%".$search."%' OR 
							p.monto like '%".$search."%') ";
		}
		if ($cliente) {
			$srch1 = "AND (c.cliente like '%".$cliente."%')";
		}
		if ($numero) {
			$srch2 = "AND (p.num_expte like '%".$numero."%')";
		}
		if ($periodo) {
			$srch3 = "AND (p.periodo like '%".$periodo."%')";
		}
		if ($num_pedido) {
			$srch4 = "AND (p.num_pedido like '%".$num_pedido."%')";
		}
		if ($estado) {
			$srch5 = "AND (p.estado_expte like '%".$estado."%') ";
		}


		$qnr = "SELECT count(1) cant FROM expediente p INNER JOIN cliente c ON p.ref_cliente = c.id_cliente WHERE estado_expte != '' ".$srch." ".$srch1." ".$srch2." ".$srch3." ".$srch4." ".$srch5;

		$qnr = $this->db->query($qnr);
		$qnr = $qnr->row();
		$qnr = $qnr->cant;

		$q = "SELECT * FROM expediente p INNER JOIN cliente c ON p.ref_cliente = c.id_cliente WHERE estado_expte != '' ".$srch." ".$srch1." ".$srch2." ".$srch3." ".$srch4." ".$srch5." ORDER BY p.id_expte DESC limit $start, $length";
		$r = $this->db->query($q);

		$retornar = array(
			'numDataTotal' => $qnr,
			'datos' => $r, 
		);

		return $retornar;
	}

	function getExpedienteMonto($search = null,$cliente=null,$numero=null,$periodo=null,$num_pedido=null,$estado=null)
	{
		$srch = $srch1 = $srch2 = $srch3 = $srch4 = $srch5 = "";
		if ($search) {
			$srch = "AND (p.num_expte like '%".$search."%' OR 
							p.periodo like '%".$search."%' OR 
							p.num_pedido like '%".$search."%' OR 
							c.cliente like '%".$search."%' OR 
							p.monto like '%".$search."%') ";
		}
		if ($cliente) {
			$srch1 = "AND (c.cliente like '%".$cliente."%')";
		}
		if ($numero) {
			$srch2 = "AND (p.num_expte like '%".$numero."%')";
		}
		if ($periodo) {
			$srch3 = "AND (p.periodo like '%".$periodo."%')";
		}
		if ($num_pedido) {
			$srch4 = "AND (p.num_pedido like '%".$num_pedido."%')";
		}
		if ($estado) {
			$srch5 = "AND (p.estado_expte like '%".$estado."%') ";
		}


		$query = $this->db->query("SELECT SUM(p.monto) as total FROM expediente p INNER JOIN cliente c ON p.ref_cliente = c.id_cliente WHERE estado_expte != '' ".$srch." ".$srch1." ".$srch2." ".$srch3." ".$srch4." ".$srch5." ");
		if ($query->num_rows() > 0) {
			return $query->row();
		}else{ 
			return false;
		}		
	}
}
?>