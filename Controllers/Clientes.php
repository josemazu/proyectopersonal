<?php
class Clientes extends Controller{
    public function __construct() {
        session_start();
        if(empty($_SESSION['user_activo'])) 
            header("location:".base_url);
        parent::__construct();
    }
    public function index() {
        $usuario_id = $_SESSION['user_activo'];
        $verificar = $this->model->verificarPermiso($usuario_id, 'clientes');
        if (empty($verificar) || $usuario_id == 1) {
            $this->views->getView($this, "index");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }

    public function listar() {
        $data = $this->model->getClientes();
        
        for ($i=0; $i < count($data); $i++) { 
            if($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge alert-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                    <button class="btn btn-primary" type="button" onclick="btnEditarCliente('.$data[$i]['atleta_id'].');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarCliente('.$data[$i]['atleta_id'].');"><i class="fas fa-trash-alt"></i></button>
                </div>
            ';
            } else {
                $data[$i]['estado'] = '<span class="badge alert-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                    <button class="btn btn-success" type="button" onclick="btnReingresarCliente('.$data[$i]['atleta_id'].');"><i class="fas fa-circle"></i></button>
                </div>
            ';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        $ci = $_POST['ci'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $email = $_POST['email'];
        $celular = $_POST['celular'];
        $estado = $_POST['estado'];
        $fecha_ingreso = $_POST['fecha_ingreso'];
        $atleta_id = $_POST['atleta_id'];
        
        if( empty($ci) || empty($nombre) || 
            empty($direccion) || empty($email) || 
            empty($celular) || empty($estado) || 
            empty($email) || empty($fecha_ingreso) ) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ( $atleta_id =="") {
                $data = $this->model->registrarCliente( $ci, $nombre, $direccion, $email, $celular, $estado, $fecha_ingreso );
                if ( $data == 'ok' ) 
                    $msg = "si";
                else  if ($data == "existe") {
                    $msg = "El cliente ya existe";
                }
                else { $msg = "Error al registrar el Cliente"; }
            } else {
                $data = $this->model->modificarCliente( $ci, $nombre, $direccion, $email, $celular, $estado, $fecha_ingreso, $atleta_id );
                if ( $data == 'modificado' ) $msg = "modificado";
                else $msg = "Error al modificar el Cliente";
            }
        } 
        echo json_encode( $msg, JSON_UNESCAPED_UNICODE );
        die();
    }

    public function editar(int $atleta_id) {
        $data = $this->model->editarCliente($atleta_id);
        //print_r($data);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $atleta_id) {
        $data = $this->model->accionCliente(0, $atleta_id);
        if($data == 1) $msg="ok";
        else $msg = "Error al eliminar al cliente.";
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $atleta_id) {
        $data = $this->model->accionCliente(1, $atleta_id);
        if($data == 1) $msg="ok";
        else $msg = "Error al reingresar el cliente.";
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function generarPDF($atleta_id){
        require('libraries/fpdf/fpdf.php');
        ob_start();
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->setTitle('Reporte de Clientes');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'WonderWoman', 0, 1, 'C');
        $pdf->Image(base_url . 'Assets/img/logonbg.png', 120, 16, 40, 25);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, 'NIT: ',0,1,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, '999999',0,1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_decode('Teléfono: '),0,1,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, '999999',0,1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_decode('Dirección: '),0,1,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, utf8_decode('Potosi #5, Av. Villarroel y Lira'),0,1,'L');

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(20, 5, utf8_encode('Usuario: '),0,1,'L');
        $pdf->SetFont('Arial', '', 11);
        $pdf->Cell(20, 5, '999999',0,0,'L');
        
        // Colores, ancho de línea y fuente en negrita
        $pdf->SetFillColor(255,0,0);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(128,0,0);
        $pdf->SetLineWidth(.3);
        $pdf->SetFont('Arial','',10);
        $pdf->Ln();
        // Cabecera
        $header = array('ID', 'CI', 'Nombre', 'Estado','Celular', 'Ingreso', 'Plan');
        $data = $this->model->getClientes();
        $w = array(6, 20, 45, 15,20,20,25);
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
            if($row['estado'] == 1) $estado = 'Activo';
            else $estado = 'Inactivo';
            $pdf->Cell($w[0],6,$row['atleta_id'],'LR',0,'L',$fill);
            $pdf->Cell($w[1],6,$row['ci'],'LR',0,'L',$fill);
            $pdf->Cell($w[2],6,$row['nombre'],'LR',0,'L',$fill);
            $pdf->Cell($w[3],6,$estado,'LR',0,'C',$fill);
            $pdf->Cell($w[4],6,$row['celular'],'LR',0,'C',$fill);
            $pdf->Cell($w[5],6,$row['fecha_ingreso'],'LR',0,'C',$fill);
            $pdf->Cell($w[6],6,$row['plan'],'LR',0,'C',$fill);
            $pdf->Ln();
            $fill = !$fill;
            
        }
        // Línea de cierre
        $pdf->Cell(array_sum($w),0,'','T');
        $pdf->Output();
        ob_end_flush();
    }
    public function informes($cliente_id) {
        require('Controllers/PDF.php');
        $pdf = new PDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->setTitle('Reporte de Clientes');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'WonderWoman', 0, 1, 'C');
    }
}
    
?>
