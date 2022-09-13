<?php
class Planes extends Controller{
    public function __construct() {
        session_start();
        if(empty($_SESSION['user_activo'])) 
            header("location:".base_url);
        parent::__construct();
    }
    public function index() {
        $this->views->getView($this, "index");
    }

    public function listar() {
        $data = $this->model->getPlanes();
        for ($i=0; $i < count($data); $i++) { 
            if($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge alert-success">Activo</span>';
                $data[$i]['acciones'] = '<div>
                    <button class="btn btn-primary" type="button" onclick="btnEditarPlan(\''.$data[$i]['plan_id'].'\');"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-danger" type="button" onclick="btnEliminarPlan(\''.$data[$i]['plan_id'].'\');"><i class="fas fa-trash-alt"></i></button>
                </div>
            ';
            } else {
                $data[$i]['estado'] = '<span class="badge alert-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                <button class="btn btn-success" type="button" onclick="btnReingresarPlan(\''.$data[$i]['plan_id'].'\');"><i class="fas fa-circle"></i></button>
                </div>
            ';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        $plan = $_POST['plan'];
        $precio = $_POST['precio'];
        $estado = $_POST['estado'];
        $obs = $_POST['obs'];
        $plan_id = $_POST['plan_id'];
        
        if( empty($plan) || empty($precio) || empty($estado) ) {
            $msg = "Todos los campos son obligatorios";
        } else {
            if ( $plan_id == ""){
                $plan_id = "P" . $precio;
                $data = $this->model->registrarPlan( $plan_id, $plan, $precio, $estado, $obs );
                if ( $data == 'ok' ) $msg = "si";
                else  if ($data == "existe") $msg = "El plan ya existe.";
                else $msg = "Error al registrar el plan.";
            } else {
                $data = $this->model->modificarPlan( $plan, $precio, $estado, $obs, $plan_id );
                if ( $data == 'modificado' ) $msg = "modificado";                
                else $msg = "Error al modificar el plan";
            }
        } 
        echo json_encode( $msg, JSON_UNESCAPED_UNICODE );
        die();
    }

    public function editar(string $plan_id) {
        $data = $this->model->editarPlan($plan_id);
        //print_r($data);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(string $plan_id) {
        $data = $this->model->accionPlan(0, $plan_id);
        if($data == 1) $msg="ok";
        else $msg = "Error al eliminar el usuario.";
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(string $plan_id) {
        $data = $this->model->accionPlan(1, $plan_id);
        if($data == 1) $msg="ok";
        else $msg = "Error al reingresar el usuario.";
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
    
?>
