<?php
class Usuarios extends Controller{
    public function __construct() {
        session_start();
        
        parent::__construct();
    }
    public function index() {
        if(empty($_SESSION['user_activo'])) 
            header("location:".base_url);
        $data['role'] = $this->model->getRoles();
        $this->views->getView($this, "index", $data);
    }

    public function listar() {
        $data = $this->model->getUsuarios();
        //for(desde; hasta; incremento)
        for ($i=0; $i < count($data); $i++) { 
            // data[i][estado] 
            if($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge alert-success">Activo</span>';
                if($data[$i]['usuario_id'] == 1) {
                    $data[$i]['acciones'] = '<div>
                        <span class="badge bg-primary">Administrador</span>
                    </div>';
                }
                else {
                    $data[$i]['acciones'] = '<div>
                    <a class="btn btn-dark" href="'.base_url.'Usuarios/permisos/'.$data[$i]['usuario_id'].'"><i class="fas fa-key"></i></a>
                        <button class="btn btn-primary" type="button" onclick="btnEditarUser('.$data[$i]['usuario_id'].');"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" type="button" onclick="btnEliminarUser('.$data[$i]['usuario_id'].');"><i class="fas fa-trash-alt"></i></button>
                    </div>';
                } 
            } else {
                $data[$i]['estado'] = '<span class="badge alert-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<div>
                    <button class="btn btn-success" type="button" onclick="btnReingresarUser('.$data[$i]['usuario_id'].');"><i class="fas fa-circle"></i></button>
                </div>
            ';
            }
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function validar() {
        if(empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos estan vacios";
        } else {
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            $hash = hash("SHA256", $clave);
            $data = $this->model->getUsuario($usuario, $clave);
            if($data) {
                $_SESSION['usuario'] = $data['usuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['role'] = $data['role'];
                $_SESSION['estado'] = $data['estado'];
                $_SESSION['user_activo'] = true;
                $msg = 'ok';
            } else {
                $msg = "Usuario o contraseña incorrecta";
            }
        }       
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar() {
        
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $confirmar = $_POST['confirmar'];
        $role = $_POST['role'];
        $estado = $_POST['estado'];
        $usuario_id = $_POST['usuario_id'];
        $hash = hash("SHA256", $clave);
        if( empty($usuario) || empty($nombre) || empty($role) || empty($estado)) {
            $msg = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
        } else {
            if ( $usuario_id ==""){
                if( $clave != $confirmar ) 
                $msg = array('msg' => 'Las contraseñas no coinciden', 'icono' => 'warning');
                else {
                    $data = $this->model->registrarUsuario( $usuario, $nombre, $clave, $role, $estado );
                    if ( $data == 'ok' ) $msg = array('msg' => 'Usuario registrado con exito', 'icono' => 'success');
                    else  if ($data == "existe") $msg = array('msg' => 'El usuario ya existe.', 'icono' => 'warning');
                    else $msg = array('msg' => 'Error al registrar el usuario', 'icono' => 'error');
                }
            }else {
                $data = $this->model->modificarUsuario( $usuario, $nombre, $role, $estado, $usuario_id );
                if ( $data == 'modificado' ) $msg = array('msg' => 'Usuario modificado con éxito', 'icono' => 'success');
                else $msg = array('msg' => 'Error al modificar usuario', 'icono' => 'error');
            }
        } 
        echo json_encode( $msg, JSON_UNESCAPED_UNICODE );
        die();
    }

    public function editar(int $usuario_id) {
        $data = $this->model->editarUsuario($usuario_id);
        //print_r($data);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar(int $usuario_id) {
        $data = $this->model->accionUser(0, $usuario_id);
        if($data == 1) $msg = array('msg' => 'Usuario dado de baja.', 'icono' => 'success');
        else $msg = array('msg' => 'Error al eliminar usuario', 'icono' => 'error');
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function reingresar(int $usuario_id) {
        $data = $this->model->accionUser(1, $usuario_id);
        if($data == 1) $msg = array('msg' => 'Usuario restaurado con éxito.', 'icono' => 'success');
        else $msg = array('msg' => 'Error al restaurar usuario', 'icono' => 'error');
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function cambiarPass() {
        $actual = $_POST['clave_actual'];
        $nueva = $_POST['clave_nueva'];
        $confirmar = $_POST['confirmar_clave'];
        if(empty($actual) || empty($nueva) || empty($confirmar)) {
            $mensaje = array('msg' => 'Todos los campos son obligatorios', 'icono' => 'warning');
        }else {
            if($nueva != $confirmar) {
                $mensaje = array('msg' => 'Las contraseñas no coinciden.', 'icono' => 'warning');
            } else {
                $id = $_SESSION['user_activo'];
                $data = $this->model->editarUsuario($id);
                if( $actual == $data['pass']) {
                    $verificar = $this->model->modificarPass($nueva, $id);
                    if($verificar == 1) $mensaje = array('msg' => 'Contraseña modificada con éxtio', 'icono' => 'success');
                    else $mensaje = array('msg' => 'Error al modificar la contraseña.', 'icono' => 'warning');
                } else $mensaje = array('msg' => 'La contraseña actual es incorrecta.', 'icono' => 'warning');
            }
        }    
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function permisos($usuario_id) {
        if(empty($_SESSION['user_activo'])) 
            header("Location: ".base_url);
        $data['datos'] = $this->model->getPermisos();
        $permisos = $this->model->getDetallePermisos($usuario_id);
        $data['asignados'] = array();
        foreach ($permisos as $permiso) {
            $data['asignados'][$permiso['permiso_id']] = true;
        }
        $data['usuario_id'] = $usuario_id;
        $this->views->getView($this, "permisos", $data);
    }

    public function registrarPermisos() {
        //print_r($_POST);
        $msg = '';
        $usuario_id = $_POST['usuario_id'];
        $eliminar = $this->model->eliminarPermisos($usuario_id);
        if($eliminar == 'ok') {
            foreach($_POST['permisos'] as $permiso_id) {
                $msg = $this->model->registrarPermisos($usuario_id, $permiso_id);
            }
            if($msg == 'ok') $msg = array('msg' => 'Permisos asignados', 'icono' => 'success');
            else $msg = array('msg' => 'Error al asignar los permisos', 'icono' => 'error');
        } else $msg = array('msg' => 'Error al eliminar los permisos anteriores', 'icono' => 'error');
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
    }

    public function salir() {
        session_destroy();
        header("location:".base_url);
    }
}
    
?>
