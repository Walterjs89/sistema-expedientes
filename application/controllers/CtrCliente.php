<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrCliente extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Permisos');

        $this->permisos->redireccion();
        
        $this->load->model('Modelo_usuario');
        $this->load->model('Modelo_cliente');
        
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function cliente()
	{
		$data = array(
			"vcliente"    => "active",
			"title"       => "Cliente",
			"subtitle"    => "Registro",
			"contenido"   => "admin/cliente/cliente",
			"menu"        => "menu/menu_admin",			
		);
		$this->load->view('universal/plantilla',$data);
	}

	public function cliente_perfil($id)
	{
		$data = array(
			"vcliente"    => "active",
			"title"       => "Cliente",
			"subtitle"    => "Registro",
			"contenido"   => "admin/cliente/cliente_perfil",
			"menu"        => "menu/menu_admin",
			"dcliente"	  => $this->Modelo_cliente->get_clienteExpte($id),
			"cliente"	  => $this->Modelo_cliente->get_datosCliente($id),
		);
		$this->load->view('universal/plantilla',$data);
	}

	public function update_cliente()
	{
		$id = $this->input->post("id_cliente");
		$data = array(
			'cliente'   => $this->input->post("nombre"),
			'telefono'  => $this->input->post("telefono"),
			'correo'    => $this->input->post("correo"),
			'direccion' => $this->input->post("direccion"),
		);
		$peticion = $this->Modelo_cliente->update_cliente($id,$data);
		if ($peticion) {
            $msg = "Exito, Cliente actualizado correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        }else{
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));  
        }
	}

	public function agregar_cliente()
	{
		$data = array(
			'cliente'      => $this->input->post("cliente"),
			'direccion'    => $this->input->post("direccion"),
			'correo'       => $this->input->post("correo"),
			'telefono'     => $this->input->post("telefono"),
			'alta_cliente' => date("Y-m-d H:i:s")
		);
		$peticion = $this->Modelo_cliente->agregar_cliente($data);
		if ($peticion) {
            $msg = "Exito, Cliente subido correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        }else{
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));  
        }
	}

	public function getClientes()
    {
        $start      = $this->input->post("start");
        $length     = $this->input->post("length");
        $search     = $this->input->post("search")['value'];
        
        $result     = $this->Modelo_cliente->getClientes($start,$length,$search);
        $resultado  = $result['datos'];
        $totalDatos = $result['numDataTotal'];

        $datos = array();
        foreach ($resultado->result_array() as $row) {
            $array = array();
			$array['id']        = $row['id_cliente'];
			$array['cliente']   = $row['cliente'];
			$array['telefono']  = $row['telefono'];
			$array['correo']    = $row['correo'];
			$array['direccion'] = $row['direccion'];
			$array['fecha']     = $row['alta_cliente'];

            $datos[] = $array;
        }

        $totalDatoObtenido = $resultado->num_rows();

        $json_data = array(
            'draw'            => intval($this->input->post('draw')), 
            'recordsTotal'    => intval($totalDatoObtenido),
            'recordsFiltered' => intval($totalDatos),
            'data'            => $datos
        );
        echo json_encode($json_data);
    }
}