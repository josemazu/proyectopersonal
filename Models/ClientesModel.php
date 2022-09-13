<?php
class ClientesModel extends Query{
    private $ci, $nombre, $direccion, $email, $celular, $estado, $fecha_ingreso, $atleta_id;
    public function _construct() {
        parent::__construct();
    }

    
    public function getClientes() {
        $sql = "SELECT * FROM atletas";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarCliente( string $ci, string $nombre, string $direccion, string $email, string $celular, int $estado, string $fecha_ingreso, string $plan ) {
        $this->ci = $ci;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->email = $email;
        $this->celular = $celular;
        $this->estado = $estado;
        $this->fecha_ingreso = $fecha_ingreso;
        $verificar = "SELECT * FROM atletas WHERE atleta_id = '$this->atleta_id'";
        $existe = $this->select($verificar);
        if(empty($existe)) {
            $sql = "INSERT INTO atletas(ci, nombre, direccion, email, celular, estado, fecha_ingreso) VALUES (?,?,?,?,?,?,STR_TO_DATE(?,'%Y-%m-%d'))";
            $datos = array( $this->ci, $this->nombre, $this->direccion, $this->email, $this->celular, $this->estado, $this->fecha_ingreso);
            $data = $this->save( $sql, $datos );
            if( $data == 1 ) $res = 'ok';
            else $res = 'error';
            
        }
        else $res = "existe";
        return $res;
    }

    public function modificarCliente( string $ci, string $nombre, string $direccion, string $email, string $celular, int $estado, string $fecha_ingreso, int $atleta_id ) {
        $this->ci = $ci;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->celular = $celular;
        $this->estado = $estado;
        $this->fecha_ingreso = $fecha_ingreso;
        $this->atleta_id = $atleta_id;
        $sql = "UPDATE atletas SET ci = ?, nombre = ?, direccion = ?, email = ?, celular = ?, estado = ?, fecha_ingreso = STR_TO_DATE(?,'%Y-%m-%d') WHERE atleta_id = ?";
        $datos = array( $this->ci, $this->nombre, $this->direccion, $this->email, $this->celular, $this->estado, $this->fecha_ingreso, $this->atleta_id);
        $data = $this->save( $sql, $datos );
        if( $data == 1 ) $res = 'modificado';
        else $res = 'error';
        return $res;
    }


    public function editarCliente(int $atleta_id) {
        $sql = "SELECT * FROM atletas WHERE atleta_id = $atleta_id";
        $data = $this->select($sql);
        return $data;
    }

    public function accionCliente(int $estado, int $atleta_id) {
        $this->estado = $estado;
        $this->atleta_id = $atleta_id;
        $sql = "UPDATE atletas SET estado = ? WHERE atleta_id = ?";
        $datos = array($this->estado, $this->atleta_id);
        $data = $this->save($sql, $datos);
        return $data;
    }

    public function verificarPermiso(int $usuario_id, string $nombre) {
        $sql = "SELECT p.permisos_id, p.permiso, d.detalle_permisos_id, d.usuario_id, d.permiso_id FROM permisos p
        INNER JOIN detalle_permisos d ON p.permisos_id = d.permiso_id
        WHERE d.usuario_id = $usuario_id AND p.permiso = '$nombre'";
        $data = $this->selectAll($sql);
        return $data;
    }
}
?>