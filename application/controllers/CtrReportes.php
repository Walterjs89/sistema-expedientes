<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CtrReportes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Funciones');
        $this->load->library('Permisos');

        $this->permisos->redireccion();

        $this->load->library('pdf');
        
        $this->load->model('Modelo_usuario');
        $this->load->model('Modelo_cliente');
        $this->load->model('Modelo_expediente');
        $this->load->helper('mysql_to_excel_helper');
        
        $this->load->helper('date');
        date_default_timezone_set('America/Monterrey');
    }

    public function excel($cliente,$estado,$mes)
	{
		$nombre = date("Ymdhis");
		to_excel($this->Modelo_expediente->get_excelExpediente($cliente,$estado,$mes), $nombre);
	}

    public function filtrado_reporte()
    {
    	$data = array(
			"vfiltrado"   => "active",
			"title"       => "Reportes",
			"subtitle"    => "Filtrado",
			"dcliente"    => $this->Modelo_cliente->getCliente(),
			"destado"     => $this->Modelo_cliente->getEstado(),
			"contenido"   => "admin/reportes/filtrado_reporte",
			"menu"        => "menu/menu_admin",			
		);
		$this->load->view('universal/plantilla',$data);
    }

    public function reporte($cliente,$estado,$mes,$fecha)
	{
		$this->load->library('pdf');
	    $this->pdf = new Pdf();
	    $this->pdf->AddPage();
	    $this->pdf->AliasNbPages();
	    $this->pdf->SetTitle("Reporte");
	    $this->pdf->SetLeftMargin(15);
	    $this->pdf->SetRightMargin(15);
	    $this->pdf->SetFillColor(10,61,104);

	    $mesesfecha = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
		$fecha=date('d').' de '.$mesesfecha[date('n')-1]. ' de '.date('Y');

		$this->pdf->Image('assets/img/logo-mega.png',140,10,65,30,'');
		$this->pdf->SetFont('Arial','',11);
		$this->pdf->SetXY(90, 30);
		$this->pdf->Cell(5, 6,"EXPEDIENTES", 0 , 1);
		$this->pdf->SetXY(70, 40);
		$this->pdf->Cell(5, 6,"NOMBRE DE LA EMPRESA SA DE CV", 0 , 1);
		$this->pdf->SetFont('Arial','',11);
		// $this->pdf->SetXY(60, 50);
		// $this->pdf->Cell(5, 6,"Reporte de ", 0 , 1);

		$this->pdf->SetFont('Arial','',9);
		$this->pdf->SetXY(12, 58);
		$this->pdf->Cell(5, 6,"Fecha impresion: ". date("Y-m-d"), 0 , 1);
		$this->pdf->Rect(12, 65, 190, 8,'DF');

		$this->pdf->SetTextColor(255,255,255);
		$this->pdf->SetFont('Arial','',10);
		$this->pdf->SetXY(14, 66);
		$this->pdf->Cell(5, 6,"#", 0 , 1);
		$this->pdf->SetXY(25, 66);
		$this->pdf->Cell(5, 6,"Cliente", 0 , 1);
		$this->pdf->SetXY(82, 66);
		$this->pdf->Cell(5, 6,utf8_decode("Nº Expte"), 0 , 1);
		$this->pdf->SetXY(114, 66);
		$this->pdf->Cell(5, 6,"Periodo", 0 , 1);
		$this->pdf->SetXY(142, 66);
		$this->pdf->Cell(5, 6,"Monto", 0 , 1);
		$this->pdf->SetXY(162, 66);
		$this->pdf->Cell(5, 6,utf8_decode("Nº Pedido"), 0 , 1);
		$this->pdf->SetXY(186, 66);
		$this->pdf->Cell(5, 6,utf8_decode("Estado"), 0 , 1);

	    $this->pdf->SetTextColor(0,0,0);
		$i = 1; $total = 0; $num = 76;
		// $cliente,$estado,$mes
		// $var = $parametro;
		$estado = str_replace("%20"," ",$estado);
		$resultados = $this->Modelo_expediente->get_expedienteReporte($cliente,$estado,$mes,$fecha);

		// if ($tipo == "estado") {
  //       	$resultados = $this->Modelo_expediente->get_expedienteClienteEstado($var);
		// }else if($tipo == "mes"){
		// 	$resultados = $this->Modelo_expediente->get_expedienteClienteMes($var);
		// }else{
		// 	$resultados = $this->Modelo_expediente->get_expedienteClienteCliente($var);
		// }
		$this->pdf->SetFont('Arial','',9);
        if (!empty($resultados)) {
	        foreach ($resultados ->result() as $datos) 
	        {
	        	$this->pdf->SetXY(15, $num);
				$this->pdf->Cell(5, 6,$i, 0 , 1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->SetXY(22, $num);
				$this->pdf->Cell(5, 6,substr($datos->cliente, 0, 60), 0 , 1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->SetXY(82, $num);
				$this->pdf->Cell(5, 6,$datos->num_expte, 0 , 1);
				$this->pdf->SetXY(106, $num);
				$this->pdf->Cell(5, 6,$datos->periodo, 0 , 1);
				$this->pdf->SetFont('Arial','B',9);
				$this->pdf->SetXY(142, $num);
				$this->pdf->Cell(5, 6,"$ ".number_format($datos->monto,2), 0 , 1);
				$this->pdf->SetFont('Arial','',8);
				$this->pdf->SetXY(162, $num);
				$this->pdf->Cell(5, 6,$datos->num_pedido, 0 , 1);
				$this->pdf->SetXY(182, $num);
				$this->pdf->Cell(5, 6,$datos->estado_expte, 0 , 1);
				$num = $num + 5;
				$total = $total + $datos->monto;
				$i++;
				if ($num > 270) {
					$this->pdf->AddPage();
					$num = 5;
				}
	      	}        	
        }
        $this->pdf->SetFont('Arial','',10);
        $this->pdf->SetXY(10, $num + 1);
		$this->pdf->Cell(5, 6,"- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ", 0 , 1);
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->SetX(125);
		$this->pdf->Cell(5, 6,"TOTAL: $ ".number_format($total,2), 0 , 1);
		if ($num > 270) {
			$this->pdf->AddPage();
			$num = 5;
		}
    	$this->pdf->Output("Reporte Refacciones.pdf", 'I'); 
	}
}