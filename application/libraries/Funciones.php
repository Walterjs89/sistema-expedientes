<?php if ( ! defined('BASEPATH')) exit('No esta permitido el acceso'); 
//La primera línea impide el acceso directo a este script
class Funciones {

	public function __construct()
    {
        $CI =& get_instance();

        $CI->load->library('session');
        $CI->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    function colores($tipo)
    {
    	$tipo = strtolower($tipo);
    	if ($tipo == "entregado") {
    		return "success";
    	}else if($tipo == "en camino"){
    		return "primary";
    	}else if($tipo == "pendiente"){
    		return "default";
    	}
    }

    function resultado($peticion,$url,$msg,$num)
	{
		if($peticion)
		{
			$result = array(
				'respuesta' => 'correcto',
				'msg'       => '<div class="alert alert-success" role="alert">'.$msg.'</div>',
				'url'		=> $url,
                'num'       => $num
			);
		}else{
			$result = array(
				'respuesta' => 'error',
				'msg'       => '<div class="alert alert-danger" role="alert">'.$msg.'</div>',
				'url'		=> $url,
                'num'       => $num,
			);
		}
		return $result;
	}
}