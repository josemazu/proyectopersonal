<?php
class Compras extends Controller{
    public function __construct() {
        session_start();
        if(empty($_SESSION['user_activo'])) 
            header("location:".base_url);
        parent::__construct();
    }

    public function index() {
        $data['plan'] = $this->model->getPlanes();
        $data['clientes'] = $this->model->getClientes();
        $this->views->getView($this, "index", $data);
    }

    public function buscarPlan($plan_id){
        $data = $this->model->getPlan($plan_id);
        // print_r($data);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function buscarCliente($atleta_id) {
        $data =$this->model->getCliente($atleta_id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function buscarHorario($plan_id) {
        $data = $this->model->getPlanHorario($plan_id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function ingresar() {
        //print_r($_POST);
        $plan = $_POST['id'];
        $datos = $this->model->getPlan($plan);
        $plan_id = $datos['plan_id'];
        $horarios_id = $_POST['horarios_id'];
        $usuario_id = $_SESSION["user_activo"];
        $atleta_id = $_POST['atleta_id'];
        $precio = $datos['precio'];
        $cantidad = $_POST['cantidad'];
        $comprobar = $this->model->consultarDetalle($plan_id, $usuario_id, $atleta_id);
        if(empty($comprobar)) {
            $sub_total = $precio * $cantidad;
            $data = $this->model->registrarDetalle($plan_id, $horarios_id, $usuario_id, $atleta_id, $precio, $cantidad, $sub_total);
            if( $data == "ok") $msg = array('msg' => 'Plan ingresado a la compra', 'icono' => 'success');
            else $msg = array('msg' => 'Error al ingresar la compra', 'icono' => 'error');;
        } else {
            $detalle_id = $_POST['detalle_id'];
            $total_cantidad = $comprobar['cantidad'] + $cantidad;
            $sub_total = $total_cantidad * $precio;
            $data = $this->model->actualizarDetalle($atleta_id, $precio, $total_cantidad, $sub_total, $horarios_id, $plan_id, $usuario_id);
            if( $data == "modificado") $msg = array('msg' => 'Compra actualizada correctamente.', 'icono' => 'success');
            else $msg = array('msg' => 'Error al actualizar la compra', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function listar() {
        $usuario_id = $_SESSION['user_activo'];
        $data['detalle'] = $this->model->getdetalle($usuario_id);
        //print_r($data['detalle']);
        $data['total_pagar'] = $this->model->calcularCompra($usuario_id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function delete($detalle_id) {
        $data = $this->model->deleteDetalle($detalle_id);
        if( $data == "ok") $msg = "ok";
        else $msg = 'error';
        //print_r($data);
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    function registrarCompra() {
        $usuario_id = $_SESSION['user_activo'];
        $total = $this->model->calcularCompra($usuario_id);
        $data = $this->model->registrarCompra($total['total']);
        if($data == 'ok') {
            $detalle = $this->model->getDetalle($usuario_id);
            $compra_id = $this->model->compra_id();
            foreach ($detalle as $row) {
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];
                $plan_id = $row['plan_id'];
                $horarios_id = $row['horarios_id'];
                $atleta_id = $row['atleta_id'];
                $sub_total = $cantidad * $precio;
                $this->model->registrarDetalleCompra($compra_id['id'], $plan_id, $horarios_id, $atleta_id, $cantidad, $precio, $sub_total);
            }
            $vaciar = $this->model->vaciarDetalle($usuario_id);
            if($vaciar == 'ok') {
                $msg = array('msg' => 'ok', 'compra_id' => $compra_id['id']);
            }
        } 
        else $msg = 'Error al realizar la compra';
        echo json_encode($msg);
        die();
    }

    public function historial() {
        $this->views->getView($this, "historial");
    }

    public function listarHistorial() {
        $data = $this->model->getHistorialCompras();
        for ($i = 0; $i < count($data); $i++) {
            if($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge alert-success">Completado</span>';
                $data[$i]['acciones'] = '<div>
                    <button class="btn btn-warning" onclick="btnAnularCompra('. $data[$i]['compra_id'] .')"><i class="fas fa-ban"></i></button>
                    <a class="btn btn-danger" href="' . base_url . "Compras/generarPDF/". $data[$i]['compra_id'] .'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                </div>';
            } else {
                $data[$i]['estado'] = '<span class="badge alert-danger">Anulado</span>';
                $data[$i]['acciones'] = '<div>
                    <a class="btn btn-danger" href="' . base_url . "Compras/generarPDF/". $data[$i]['compra_id'] .'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                </div>';
            }
            
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function anularCompra($compra_id) {
        $anular = $this->model->getAnular($compra_id);
        if($anular == 'ok') $msg = array('msg' => 'Compra anulada', 'icono' => 'success');
        else $msg = array('msg' => 'Error al anular la compra', 'icono' => 'error');
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPDF($compra_id){
        $data = $this->model->getPlanCompra($compra_id);
        // print_r($data);
        // exit;
        require('libraries/fpdf/fpdf.php');
        ob_start();
        $pdf = new FPDF('P', 'mm', 'A5');
        $pdf->AddPage();
        $pdf->SetMargins(5,0,0);

        $pdf->setTitle('Reporte de Clientes');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'WonderWoman', 0, 1, 'C');
        $pdf->Image(base_url . 'Assets/img/logonbg.png', 100, 16, 40, 25);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, 'NIT: ',0,0,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, '999999',0,1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_decode('Teléfono: '),0,0,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, '999999',0,1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_decode('Dirección: '),0,0,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, utf8_decode('Potosi #5, Av. Villarroel y Lira'),0,1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_encode('Usuario: '),0,0,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, utf8_decode($_SESSION['user_activo']),0,0,'L');
        $pdf->Ln();
        // Colores, ancho de línea y fuente en negrita
        $pdf->SetFillColor(121,128,129);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(155,155,155);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',10);
        $pdf->Ln();
        // Cabecera
        $header = array('Cant.', utf8_decode('Cliente'), utf8_decode('Descripción'), 'Precio', 'Sub Total');
        
        $w = array(10, 45, 45, 20, 20);
        for($i=0;$i<count($header);$i++)
            $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $pdf->Ln();
        // Restauración de colores y fuentes
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');        // Datos
        $fill = false;
        $total = 0.00;
        foreach($data as $row)
        {
            // if($row['estado'] == 1) $estado = 'Activo';
            // else $estado = 'Inactivo';
            $total = $total + $row['sub_total'];
            $pdf->Cell($w[0], 6, $row['cantidad'], 'LR', 0 , 'C', $fill);
            $pdf->Cell($w[1], 6, $row['nombre'], 'LR', 0 , 'C', $fill);
            $pdf->Cell($w[2], 6, utf8_decode($row['obs']), 'LR',0,'L',$fill);
            $pdf->Cell($w[3], 6, $row['precio'],'LR',0, 'L', $fill);
            $pdf->Cell($w[4], 6, number_format($row['sub_total'], 2, '.', ','), 'LR', 1, 'C', $fill);
            //$pdf->Ln();
            $fill = !$fill;
            
        }
        $pdf->SetFillColor(121,128,129);$pdf->SetTextColor(255);
        $pdf->Cell(120, 6, 'Total a pagar', 'LR', 0, 'R', !$fill);
        $pdf->SetTextColor(0);
        $pdf->Cell(20, 6, number_format($total, 2, '.', ','), 'LR', 1, 'C', $fill);

        // Línea de cierre
        $pdf->Cell(array_sum($w),0,'','T');
        $pdf->Output();
        ob_end_flush();
    }
    
    public function pdf(){
        $desde = $_POST['desde'];
        $hasta = $_POST['hasta'];
        // print_r($desde);
        // print_r($hasta);
        if(empty($desde || empty($hasta))) {
            $data = $this->model->getHistorialCompras();
        }
        else {
            $data = $this->model->getRangoFechas($desde, $hasta);
            $total_c = $this->model->getTotalRangoFechas($desde, $hasta);
            // print_r($data);
            // print_r($total_c);
            // exit;
        }
        $empresa = $this->model->getDatosEmpresa();
        require('libraries/fpdf/fpdf.php');
        ob_start();
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetMargins(15,15,15);

        $pdf->setTitle('Reporte de compras');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Image(base_url . 'Assets/img/logonbg.png', 135, 6, 60, 25);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(0, 0, '', 0, 1,'L');
        $pdf->Cell(20, 5, 'NIT: ', 0, 0,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, utf8_decode($empresa['nit']),0, 1, 'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_decode('Teléfono: '),0,0,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, $empresa['telefono'],0,1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_decode('Dirección: '),0,0,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, utf8_decode($empresa['direccion']),0,1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_encode('Usuario: '),0,0,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, utf8_decode($_SESSION['user_activo']),0,0,'L');
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Reporte de Compras', 0, 1, 'C');
        // Colores, ancho de línea y fuente en negrita
        $pdf->SetFillColor(121,128,129);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(155,155,155);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',10);
        
        // Cabecera

        $pdf->SetFont('Arial','',10);
        $header = array('Id', 'Nombre', 'Plan Adquirido', 'Precio', 'Fecha y hora');
        $w = array(10, 60, 25, 40, 45);
        for($i=0;$i<count($header);$i++)
            $pdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $pdf->Ln();
        // Restauración de colores y fuentes
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');        // Datos
        $fill = false;
        
        foreach($data as $row)
        {
            $pdf->Cell($w[0], 6, $row['compra_id'], 'LR', 0 , 'L', $fill);
            $pdf->Cell($w[1], 6, $row['nombre'], 'LR', 0, 'L', $fill);
            $pdf->Cell($w[2], 6, $row['plan'], 'LR', 0,'C',$fill);
            $pdf->Cell($w[3], 6, $row['precio'], 'LR', 0,'C',$fill);
            $pdf->Cell($w[4], 6, $row['fecha'],'LR', 1, 'C', $fill);    
            $fill = !$fill;
        }
        $pdf->SetFillColor(121,128,129);
        $pdf->SetTextColor(255);
        $pdf->Cell(95, 6,'Total recaudado',1,0,'C',true);
        $pdf->SetTextColor(0);
        $pdf->Cell(40, 6, $total_c['total'], 'LR', 0, 'C', false);
        $pdf->Cell(45, 6, '', 'LR', 1, 'C', true);
        //Línea de cierre
        $pdf->Cell(array_sum($w),0,'','T');

        $pdf->Output();
        ob_end_flush();
    }
    
}
    
?>