<?php
class Administracion extends Controller {
    public function __construct() {
        session_start();
        if(empty($_SESSION['user_activo'])) 
            header("location:".base_url);
        parent::__construct();
    }
    public function index() {
        $usuario_id = $_SESSION['user_activo'];
        $verificar = $this->model->verificarPermiso($usuario_id, 'administracion');
        if (empty($verificar) || $usuario_id == 1) {
            $data = $this->model->getEmpresa();
            $this->views->getView($this, "index", $data);
        } else {
            header('Location: ' . base_url . 'Errors/permisos');
        }
        
    }

    public function home() {
        $data['usuarios'] = $this->model->getDatos('usuarios');
        $data['clientes'] = $this->model->getDatos('atletas');
        $data['planes'] = $this->model->getDatos('planes');
        $this->views->getView($this, "home", $data);
    }

    public function modificarEmpresa() {
        $nombre = $_POST['nombre'];
        $nit = $_POST['nit'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $mensaje = $_POST['mensaje'];
        $id = $_POST['id'];
        $data = $this->model->modificar($nombre, $nit, $telefono, $direccion, $mensaje, $id);
        if ($data == "ok") $msg = "ok";
        else $msg = "error";
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function graficaPlan() {
        $data = $this->model->getPlanGrafica();
        echo json_encode($data);
    }

    public function graficaHorarios() {
        $data = $this->model->getHorarioGrafica();
        echo json_encode($data);
    }
}

?>