<?php if ( ! defined('BASEPATH')) exit('No esta permitido el acceso'); 

class Permisos {

	public function __construct()
    {
        $CI =& get_instance();
        $CI->load->library('session');
    }

    function redireccion()
    {
        $CI =& get_instance();
        $permiso = $CI->session->userdata('permiso');
        if($permiso == FALSE || $permiso != "Admin" ){
            redirect(base_url().'login');
        }
    }
}