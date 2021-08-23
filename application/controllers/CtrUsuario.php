<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrUsuario extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Permisos');

        $this->permisos->redireccion();
        
        $this->load->model('Modelo_usuario');
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

	public function usuario()
	{
		$data = array(
            "vuser"     => "active",
    		"title"     => "Usuarios",
    		"subtitle"  => "Alta de usuarios",
    		"contenido" => "admin/usuario/usuario",
    		"menu"      => "menu/menu_admin",
        );
		$this->load->view('universal/plantilla',$data);
	}

    public function estado()
    {
        $data = array(
            "vestado"   => "active",
            "title"     => "Usuarios",
            "subtitle"  => "Alta de usuarios",
            "contenido" => "admin/usuario/alta_estado",
            "menu"      => "menu/menu_admin",
        );
        $this->load->view('universal/plantilla',$data);
    }

    public function agregar_estado()
    {
        $data = array(
            'estado'       => $this->input->post("estado"),
            'alta_estado' => date("Y-m-d H:i:s"),
        );
        $peticion = $this->Modelo_usuario->agregar_estado($data);
        if ($peticion) {
            $msg = "Exito, Usuario subido correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        }else{
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));  
        }
    }

    public function agregar_usuario()
    {
        $usuario  = $this->input->post("correo");
        $password = $this->input->post("contrasena");
        $salt     = '$sautzruukmi$/';
        $username = sha1(md5($salt . $usuario));
        $password = sha1(md5($salt . $password));

        $data = array(
            'nombre'       => $this->input->post("nombre"),
            'correo_2'     => $usuario,
            'correo'       => $username,
            'password'     => $password,
            'permisos'     => $this->input->post("permisos"),
            'alta_usuario' => date("Y-m-d H:i:s"),
        );
        $peticion = $this->Modelo_usuario->agregar_usuario($data);
        if ($peticion) {
            $msg = "Exito, Usuario subido correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        }else{
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));  
        }
    }

    public function update_usuario()
    {
        $id_usuario  = $this->input->post("mid");
        $usuario     = $this->input->post("mcorreo");
        $password    = $this->input->post("mpassword");
        $salt        = '$sautzruukmi$/';
        $username    = sha1(md5($salt . $usuario));
        $password    = sha1(md5($salt . $password));

        $data = array(
            'nombre'       => $this->input->post("mnombre"),
            'correo_2'     => $usuario,
            'correo'       => $username,
            // 'password'     => $password,
            'permisos'     => $this->input->post("mpermisos"),
        );
        $peticion = $this->Modelo_usuario->update_usuario($id_usuario,$data);
        if ($peticion) {
            $msg = "Exito, Usuario subido correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        }else{
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));  
        }   
    }

    public function getEstado()
    {
        $start      = $this->input->post("start");
        $length     = $this->input->post("length");
        $search     = $this->input->post("search")['value'];
        
        $result     = $this->Modelo_usuario->getEstado($start,$length,$search);
        $resultado  = $result['datos'];
        $totalDatos = $result['numDataTotal'];

        $datos = array();
        foreach ($resultado->result_array() as $row) {
            $array = array();
            $array['id']         = $row['id_estado'];
            $array['estado']     = $row['estado'];
            $array['fecha']      = $row['alta_estado'];

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

    public function getUsuario()
    {
        $start      = $this->input->post("start");
        $length     = $this->input->post("length");
        $search     = $this->input->post("search")['value'];
        
        $result     = $this->Modelo_usuario->getUsuario($start,$length,$search);
        $resultado  = $result['datos'];
        $totalDatos = $result['numDataTotal'];

        $datos = array();
        foreach ($resultado->result_array() as $row) {
            $array = array();
            $array['id']         = $row['id_usuario'];
            $array['nombre']     = $row['nombre'];
            $array['correo']     = $row['correo_2'];
            $array['password']   = $row['password'];
            $array['permisos']   = $row['permisos'];

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

    public function eliminar_estado()
    {
        $id_usuario = $this->input->post("meid");
        $peticion   = $this->Modelo_usuario->eliminar_estado($id_usuario);
        if ($peticion) {
            $msg = "Exito, Estado eliminado correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        }else{
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));  
        }
    }

    public function eliminar_usuario()
    {
        $id_usuario = $this->input->post("meid");
        $peticion   = $this->Modelo_usuario->eliminar_usuario($id_usuario);
        if ($peticion) {
            $msg = "Exito, Usuario eliminado correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        }else{
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));  
        }
    }

    public function generar_reporte()
    {
        // print_r($this->input->post());
        // $tipo = $this->input->post("tipo");
        // if ($tipo == "cliente") {
        // }else if($tipo == "estado"){
        // }else{
        // }
        $cliente = $this->input->post("cliente");
        $estado  = $this->input->post("estado");
        $mes     = $this->input->post("mes");
        $fecha   = $this->input->post("fecha");

        if (empty($fecha)) {
            $fecha = "Vacio";
        }
        $result = array(
            'pdf'   => "<a href='".base_url()."reportes/".$cliente."/".$estado."/".$mes."/".$fecha."' target='_blank'><u>Descargar PDF</u></a>",
            'excel' => "<a href='".base_url()."excel/".$cliente."/".$estado."/".$mes."/".$fecha."' target='_blank'><u>Descargar EXCEL</u></a>",
        );

        echo json_encode($result);
        // echo "<a href='".base_url()."reportes/".$cliente."/".$estado."/".$mes."' target='_blank'><u>Descargar PDF</u></a>";
        // echo "<a href='".base_url()."excel/".$cliente."/".$estado."/".$mes."' target='_blank'><u>Descargar EXCEL</u></a>";
    }
}
