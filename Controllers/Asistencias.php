<?php
class Asistencias extends Controller{
    public function __construct() {
        session_start();
        if(empty($_SESSION['user_activo'])) 
            header("location:".base_url);
        parent::__construct();
    }

    public function index() {
        $usuario_id = $_SESSION['user_activo'];
        $verificar = $this->model->verificarPermiso($usuario_id, 'asistencias');
        if (empty($verificar) || $usuario_id == 1) {
            $this->views->getView($this, "index");
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
    }
    
    public function registrar() {
        $carnet = $_POST['carnet'];
        $verificar = $this->model->consultarCarnet($carnet);
        //print_r($verificar);
        if(empty($verificar)) {
            $msg = array('msg' => 'No existe el cliente en la base de datos.','icono' => 'error');
        }
        else {
            $atleta_id = $verificar['atleta_id'];
            $data = $this->model->registrarAsistencia($atleta_id);
            if($data=="ok") $msg = array('msg' => "La asistencia ha sido registrada con exito.",'icono' =>'success', 'data' => $verificar['nombre']);
            else $msg = array('msg' => 'Error al registrar asistencia.','icono' =>'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function historial() {
        $this->views->getView($this, "historial");
    }

    public function listarHistorial() {
        $data = $this->model->getHistorialAsistencias();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href="' . base_url . "Asistencias/generarPDF/". $data[$i]['asistencias_id'] .'" target="_blank"><i class="fas fa-file-pdf"></i></a>
            </div>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
    
?>