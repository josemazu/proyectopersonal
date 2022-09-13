<?php
class Horarios extends Controller{
    public function __construct() {
        session_start();
        if(empty($_SESSION['user_activo'])) 
            header("location:".base_url);
        parent::__construct();
    }
    public function index() {
        $data['plan'] = $this->model->getPlanes();
        $this->views->getView($this, "index", $data);
    }

    public function listar() {
        $data = $this->model->getHorarios();
        for ($i=0; $i < count($data); $i++) { 
            if($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge alert-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                    <button class="btn btn-primary" type="button" onclick="btnEditarHorario(\''.$data[$i]['horarios_id'].'\');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarHorario(\''.$data[$i]['horarios_id'].'\');"><i class="fas fa-trash-alt"></i></button>
                </div>
            ';
            } else {
                $data[$i]['estado'] = '<span class="badge alert-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarHorario(\''.$data[$i]['horarios_id'].'\');"><i class="fas fa-circle"></i></button>
                </div>
            ';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function buscarPlanH($plan_id){
        $data = $this->model->getPlan($plan_id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }


    public function registrar() {
        $plan_id = $_POST['plan_id'];
        $horarioi = $_POST['horario_i'];
        $horariof = $_POST['horario_f'];
        $estado = $_POST['estado'];
        $horarios_id = $_POST['horarios_id'];
        
        $comprobar = $this->model->consultarHorario($plan_id, $horarioi, $horariof);
        if(empty($comprobar)) {
            if( empty($plan_id) ||empty($horarioi) || empty($horariof) )
                $msg = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
            else {
                if($horarios_id == "") {
                    $data = $this->model->registrarHorario( $plan_id, $horarioi, $horariof, $estado );
                    if ( $data == 'ok' ) $msg = array('msg' => 'Registro de horario correcto.', 'icono' => 'success');
                    else if ($data == "existe") $msg = array('msg' => 'El horario ya existe', 'icono' => 'warning');
                    else $msg = array('msg' => 'Error al registrar el horario', 'icono' => 'error');
                }
                else {
                    $data = $this->model->modificarHorario( $plan_id, $horarioi, $horariof, $estado, $horarios_id );
                    if ( $data == 'modificado' ) $msg = array('msg' => 'Horario modificado con éxito.', 'icono' => 'success');
                    else $msg = array('msg' => 'Error al modificar el horario', 'icono' => 'error');
                }
            }
        }
        else { $msg = array('msg' => 'El plan y horario ya existen', 'icono' => 'error'); }
        echo json_encode( $msg, JSON_UNESCAPED_UNICODE );
        die();
    }

    public function editar($horarios_id) {
        $data = $this->model->editarHorario($horarios_id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $horarios_id) {
        //print_r($horarios_id);
        $data = $this->model->accionHorario(0, $horarios_id);
        if($data == 1) $msg="ok";
        else $msg = "Error al eliminar el horario.";
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(string $horarios_id) {
        $data = $this->model->accionHorario(1, $horarios_id);
        if($data == 1) $msg="ok";
        else $msg = "Error al reingresar el horario.";
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
    
?>
