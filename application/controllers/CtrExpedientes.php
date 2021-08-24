<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CtrExpedientes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Permisos');

        $this->permisos->redireccion();

        $this->load->model('Modelo_usuario');
        $this->load->model('Modelo_expediente');
        $this->load->model('Modelo_cliente');

        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function expediente()
    {
        $data = array(
            "vexpte" => "active",
            "title" => "Expedientes",
            "subtitle" => "Control de Expte",
            "contenido" => "admin/expediente/expediente",
            "menu" => "menu/menu_admin",
            "datos" => $this->Modelo_expediente->getExpedientes(),
            "dcleinte" => $this->Modelo_cliente->getCliente(),
            "destado" => $this->Modelo_expediente->getEstado(),
            "monto" => $this->Modelo_expediente->getExpedienteMonto(),
        );
        $this->load->view('universal/plantilla', $data);
    }

    public function perfil_expte($id)
    {
        $num_expte = $this->Modelo_expediente->get_expediente($id);
        $data = array(
            "vexpte" => "active",
            "title" => "Expedientes",
            "subtitle" => "Control de Expte",
            "contenido" => "admin/expediente/perfil_expte_new",
            "menu" => "menu/menu_admin",
            "idexpte" => $id,
            "expte" => $num_expte->num_expte,
            "datosExpte" => $this->Modelo_expediente->getExpedientes(),
            "datos" => $this->Modelo_expediente->get_expediente($id),
            "dactividad" => $this->Modelo_expediente->get_actividad($id),
            "drelacion" => $this->Modelo_expediente->getRelacion($id),
            "destado" => $this->Modelo_expediente->getEstado(),
        );
        $this->load->view('universal/plantilla', $data);
    }

    public function agregar_relacion()
    {
        $id_expte = $this->input->post("mexpteid");
        $id_relacion = $this->input->post("relacion");
        $data = array(
            'hijo_expte' => $id_expte,
            'padre_expte' => $id_relacion,
            'alta_relacion' => date("Y-m-d H:i:s"),
        );
        $this->Modelo_expediente->agregar_relacion($data);
        $msg = "Exito, Relacion agregado correctamente";
        echo json_encode($this->funciones->resultado($peticion = true, $url = null, $msg, null));
    }

    public function update_actividad()
    {
        $id = $this->input->post("midact");
        $notas = $this->input->post("mnotas");
        $idexpte = $this->input->post("midexpte");

        $data = array(
            'destino' => $this->input->post("mdestino"),
            'origen' => $this->input->post("morigen"),
            'estado' => $this->input->post("mestado"),
        );
        $this->Modelo_expediente->update_actividad($id, $data);

        $datos = array(
            'tipo' => "Actualizacion de actividad a " . $this->input->post("mestado"),
            'historial' => $notas,
            'fecha_historial' => date("Y-m-d"),
            'ref_actividad' => $id,
        );
        $this->Modelo_expediente->agregar_historial($datos);

        $datos = array(
            'estado_expte' => "FUERA",
        );
        $this->Modelo_expediente->updateEstadoExpte($idexpte, $datos);

        $msg = "Exito, Actividad actualizado correctamente";
        echo json_encode($this->funciones->resultado($peticion = true, $url = null, $msg, null));
    }

    public function agregar_expediente()
    {
        $mes = "";
        // $text = $this->input->post("mes");
        // for ($i = 0; $i < count($text); $i++)
        // {
        //     $mes = $mes.",".$text[$i];
        // }
        $datos = array(
            "ref_cliente" => $this->input->post("cliente"),
            "num_expte" => $this->input->post("num_expte"),
            // "mes"          => $mes,
            "alta_expte" => $this->input->post("fecha_expte"),
            "periodo" => $this->input->post("periodo"),
            "monto" => $this->input->post("monto"),
            "num_pedido" => $this->input->post("num_perido"),
            "estado_expte" => "BASE",
        );
        $peticion = $this->Modelo_expediente->agregar_expte($datos);

        if ($this->input->post("relacion") != "NO") {
            $data = array(
                "padre_expte" => $this->input->post("relacion"),
                "hijo_expte" => $peticion,
                "alta_relacion" => date("Y-m-d H:i:s"),
            );
            $peticion = $this->Modelo_expediente->agregar_relacion($data);
        }
        if ($peticion) {
            $msg = "Exito, Expediente agregado correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        } else {
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
        }
    }

    public function eliminar_expte()
    {
        $id_usuario = $this->input->post("meid");
        $peticion = $this->Modelo_expediente->eliminar_expte($id_usuario);
        if ($peticion) {
            $msg = "Exito, Expediente eliminado correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        } else {
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
        }
    }

    public function mostrar_historial()
    {
        $id = $this->input->post("id_act");
        $fechaux = "";

        $result = $this->Modelo_expediente->getHistorial($id);
        if (!empty($result)) {
            foreach ($result->result() as $datos) {
                $fecha = (string) $datos->fecha_historial;
                if ($fecha != $fechaux) {
                    echo '<li class="time-label">
			        <span class="bg-red">
			          ' . $datos->fecha_historial . '
			        </span>
			      </li>';
                }

                echo '<li>
	            <i class="fa fa-envelope bg-blue"></i>

	            <div class="timeline-item">
	              <span class="time"><i class="fa fa-clock-o"></i>' . $datos->fecha_historial . '</span>

	              <h3 class="timeline-header"><a href="#">' . strtolower($datos->tipo) . '</a> </h3>

	              <div class="timeline-body">
	                ' . $datos->historial . '
	              </div>
	            </div>
	          </li>';
                $fechaux = $fecha;
            }
        }
        echo '<li class="time-label">
	            <span class="bg-green">
	              Inicio
	            </span>
	      </li>';
    }

    public function update_expte()
    {
        $id_expte = $this->input->post("mid");
        $data = array(
            // 'cliente'    => $this->input->post("mcliente"),
            'num_expte' => $this->input->post("mnumero"),
            'periodo' => $this->input->post("mperiodo"),
            'monto' => $this->input->post("mmonto"),
            'num_pedido' => $this->input->post("mpedido"),
            'estado_expte' => $this->input->post("mestado"),
            'alta_expte' => $this->input->post("mfecha"),
        );
        $peticion = $this->Modelo_expediente->update_expte($id_expte, $data);

        if ($peticion) {
            $msg = "Exito, Expediente subido correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        } else {
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
        }
    }

    public function update_expediente()
    {
        $id = $this->input->post("mid");
        $data = array(
            // 'ref_cliente'=> $this->input->post("mcliente"),
            'num_expte' => $this->input->post("mnumexpte"),
            'periodo' => $this->input->post("mperiodo"),
            'monto' => $this->input->post("mmonto"),
            'num_pedido' => $this->input->post("mnumpedido"),
            'alta_expte' => $this->input->post("mfecha"),
        );
        $peticion = $this->Modelo_expediente->update_expte($id, $data);
        if ($peticion) {
            $msg = "Exito, Expediente actualizado correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        } else {
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
        }
    }

    public function agregar_actividad()
    {
        $id = $this->input->post("maid");
        $data = array(
            'origen' => $this->input->post("maorigen"),
            'destino' => $this->input->post("madestino"),
            'estado' => "PENDIENTE",
            'actividad' => $this->input->post("maobservaciones"),
            'personal' => $this->input->post("maencargado"),
            'ref_expte' => $id,
            'alta_actividad' => date("Y-m-d H:i:s"),
        );
        $id_expte = $this->Modelo_expediente->agregar_actividad($data);

        $datos = array(
            'historial' => "Se agrego correctamente la actividad",
            'fecha_historial' => date("Y-m-d"),
            'ref_actividad' => $id_expte,
            'tipo' => "Alta actividad",
        );
        $peticion = $this->Modelo_expediente->agregar_historial($datos);

        if ($id_expte) {
            $msg = "Exito, Actividad subido correctamente";
            echo json_encode($this->funciones->resultado($peticion, $url = null, $msg, null));
        } else {
            $msg = "Error, no se han subido los datos";
            echo json_encode($this->funciones->resultado($peticion = false, $url = null, $msg, null));
        }
    }

    public function getExpedientes()
    {
        $start = $this->input->post("start");
        $length = $this->input->post("length");
        $search = $this->input->post("search")['value'];
        $cliente = $this->input->post("columns")['0']['search']['value'];
        $numero = $this->input->post("columns")['1']['search']['value'];
        $periodo = $this->input->post("columns")['2']['search']['value'];
        $num_pedido = $this->input->post("columns")['4']['search']['value'];
        $estado = $this->input->post("columns")['5']['search']['value'];

        $result = $this->Modelo_expediente->getExpediente($start, $length, $search, $cliente, $numero, $periodo, $num_pedido, $estado);
        $resultado = $result['datos'];
        $totalDatos = $result['numDataTotal'];

        $datos = array();
        $montoTotal = 0;

        $montoTotal = $this->Modelo_expediente->getExpedienteMonto($search, $cliente, $numero, $periodo, $num_pedido, $estado)->total;
        foreach ($resultado->result_array() as $row) {
            $array = array();
            $array['id'] = $row['id_expte'];
            $array['cliente'] = $row['cliente'];
            $array['numero'] = $row['num_expte'];
            $array['periodo'] = $row['periodo'];
            $array['monto'] = "$ " . number_format($row['monto'], 2, ",", ".");
            $array['pedido'] = $row['num_pedido'];
            $array['estado'] = $row['estado_expte'];
            $array['num_expte'] = $row['num_expte'];
            $array['prueba'] = $cliente;
            $array['monto_total'] = number_format($montoTotal, 2, ",", ".");

            $datos[] = $array;
        }

        $totalDatoObtenido = $resultado->num_rows();

        $json_data = array(
            'draw' => intval($this->input->post('draw')),
            'recordsTotal' => intval($totalDatoObtenido),
            'recordsFiltered' => intval($totalDatos),
            'totalAmount' => number_format($montoTotal, 2, ",", "."),
            'data' => $datos,
        );
        echo json_encode($json_data);
    }
}
