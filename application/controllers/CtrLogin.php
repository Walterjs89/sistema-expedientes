<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrLogin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->model('Modelo_usuario');

		$this->load->library('Form_validation');
        $this->load->library('session');
        
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

	public function login()
	{
		switch ($this->session->userdata('permiso')) 
		{
			case '':
				$data['token'] = $this->token();
				$data['titulo'] = 'Escribe tus credenciales para iniciar sesion.';
				$this->load->view('login',$data);
				break;
			case 'Admin':
				redirect(base_url().'principal');
				break;
			default: 
				$data['titulo'] = 'Error, usuario o contraseña incorrecta.';
				$data['token'] = $this->token();
				$this->load->view('login',$data);
				break; 
		}	
	}

	public function verificar()
	{
		if($this->input->post('token',true) == $this->session->userdata('token',true))
		{	
			$this->form_validation->set_rules('usuario', 'Usuario','required|min_length[4]|max_length[60]|trim');
			$this->form_validation->set_rules('contrasena', 'Contrasena', 'required|min_length[4]|max_length[60]|trim');

            if ($this->form_validation->run()) 
			{		
				$username = $this->input->post('usuario',true);
				$password = $this->input->post('contrasena',true);

				if(!empty($username) && !empty($password))
				{		 	
					$salt     = '$sautzruukmi$/';
			        $username = sha1(md5($salt . $username));
			        $password = sha1(md5($salt . $password));

					$check_user = $this->Modelo_usuario->get_usuario($username,$password);
					if($check_user == TRUE)
					{
						$data = array(
			                'is_logued_in' 	=> 		TRUE,
			                'id'		 	=> 		$check_user->id_usuario,
			                'nombre'		=>		$check_user->nombre,
			                'permiso'		=>		$check_user->permisos,
		        		);		
		        		$usuario = $check_user->id_usuario;		        		
						$this->session->set_userdata($data);
						$this->session->set_flashdata('usuario', $usuario);
						$this->login();
						echo "entre";
					}else{
						$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
						// echo "aqui";
						redirect(base_url().'login','refresh');
					}
	   		    }else{
	   		    	// echo "aqui 2";
	         		redirect(base_url().'login','refresh');	
	   			}
			}else{
				// echo "aqui 3";
         		redirect(base_url().'login','refresh');	
         	}   	
		}else{
			// echo "aqui 4";
     		redirect(base_url().'login','refresh');	
     	}
	}

	public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}

	public function logout_ci()
	{
		$this->session->sess_destroy();
		$this->login();
	}
}
