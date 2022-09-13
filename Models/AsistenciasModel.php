<?php
class AsistenciasModel extends Query{

    public function _construct() {
        parent::__construct();
    }

    public function consultarCarnet($carnet) {
        $sql = "SELECT * FROM atletas WHERE ci = $carnet";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarAsistencia($atleta_id) {
        $sql = "INSERT INTO asistencias (atleta_id) VALUES (?)";
        $datos = array($atleta_id);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = 'ok';
        else $res = 'error';
        return $res;
    }
    
    function getHistorialAsistencias() {
        $sql = "SELECT a.*, c.nombre as nombre FROM asistencias a
                INNER JOIN atletas c ON c.atleta_id = a.asistencias_id";
        $data = $this->selectAll($sql);
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