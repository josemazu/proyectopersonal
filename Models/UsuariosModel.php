<?php
class UsuariosModel extends Query{
    private $usuario, $nombre, $clave, $estado, $role, $usuario_id;
    public function _construct() {
        parent::__construct();
    }

    public function getUsuario(string $usuario, string $clave) {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND pass='$clave'";
        $data = $this->select($sql);
        
        return $data;
    }

    public function getRoles () {
        $sql = "SELECT role FROM usuarios";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarUsuario( string $usuario, string $nombre, string $clave, string $role, int $estado ) {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->estado = $estado;
        $this->role = $role;
        $verificar = "SELECT * FROM usuarios WHERE usuario = '$this->usuario'";
        $existe = $this->select($verificar);
        if(empty($existe)) {
            $sql = "INSERT INTO usuarios(usuario, nombre, pass, role, estado) VALUES (?,?,?,?,?)";
            $datos = array( $this->usuario, $this->nombre, $this->clave, $this->role, $this->estado);
            $data = $this->save( $sql, $datos );
            if( $data == 1 ) $res = 'ok';
            else $res = 'error';
            
        }
        else $res = "existe";
        return $res;
    }

    public function modificarUsuario( string $usuario, string $nombre, string $role, int $estado, int $usuario_id ) {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->usuario_id = $usuario_id;
        $this->estado = $estado;
        $this->role = $role;
        $sql = "UPDATE usuarios SET usuario = ?, nombre = ?, role = ?, estado = ? WHERE usuario_id = ?";
        $datos = array( $this->usuario, $this->nombre, $this->role, $this->estado, $this->usuario_id);
        $data = $this->save( $sql, $datos );
        if( $data == 1 ) $res = 'modificado';
        else $res = 'error';
        return $res;
    }


    public function editarUsuario(int $usuario_id) {
        $sql = "SELECT * FROM usuarios WHERE usuario_id = $usuario_id";
        $data = $this->select($sql);
        return $data;
    }

    public function accionUser(int $estado, int $usuario_id) {
        $this->usuario_id = $usuario_id;
        $this->estado = $estado;
        $sql = "UPDATE usuarios SET estado = ? WHERE usuario_id = ?";
        $datos = array($this->estado, $this->usuario_id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    
    public function modificarPass(string $clave, int $id) {
        $sql = "UPDATE usuarios SET pass = ? WHERE usuario_id = ?";
        $datos = array($clave, $id);
        $data = $this->save( $sql, $datos );
        return $data;
    }

    public function getPermisos () {
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarPermisos(int $usuario_id, int $permiso_id){
        $sql = "INSERT INTO detalle_permisos (usuario_id, permiso_id) VALUES (?,?)";
        $datos = array($usuario_id, $permiso_id);
        $data = $this->save($sql, $datos);
        if($data == 1) $res='ok';
        else $res = 'error';
        return $res;
    }

    public function eliminarPermisos(int $usuario_id){
        $sql = "DELETE FROM detalle_permisos WHERE usuario_id=?";
        $datos = array($usuario_id);
        $data = $this->save($sql, $datos);
        if($data == 1) $res='ok';
        else $res = 'error';
        return $res;
    }
    public function getDetallePermisos(int $usuario_id) {
        $sql = "SELECT * FROM detalle_permisos WHERE usuario_id=$usuario_id";
        $data = $this->selectAll($sql);
        return $data;
    }

}
?>