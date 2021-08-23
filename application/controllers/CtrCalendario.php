<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrCalendario extends CI_Controller {

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

    public function calendario()
	{
		$data = array(
			"vcalendario" => "active",
			"title"       => "Calendario",
			"subtitle"    => "Registro",
			"contenido"   => "admin/calendario/calendario",
			"menu"        => "menu/menu_admin",
		);
		$this->load->view('universal/plantilla',$data);
	}

    public function calendario_expte()
    {
        $data = array(
            "vexpte"      => "active",
            "title"       => "Calendario",
            "subtitle"    => "Registro",
            "contenido"   => "admin/calendario/calendario_expte",
            "menu"        => "menu/menu_admin",
        );
        $this->load->view('universal/plantilla',$data);
    }
}