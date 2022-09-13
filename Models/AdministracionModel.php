<?php
class AdministracionModel extends Query {
    public function __construct()
    {
        parent::__construct();
    }

    public function getEmpresa() {
        $sql = "SELECT * FROM empresa";
        $data = $this->select($sql);
        return $data;
    }

    public function getDatos(string $table) {
        $sql = "SELECT COUNT(*) AS total FROM $table";
        $data = $this->select($sql);
        return $data;
    }

    public function modificar(string $nombre, string $nit, string $telefono, string $direccion, string $mensaje, int $empresa_id) {
        $sql = "UPDATE empresa SET nombre = ?, nit = ?, telefono = ?, direccion = ?, mensaje =  ? WHERE empresa_id =?";
        $datos = array($nombre, $nit, $telefono, $direccion, $mensaje, $empresa_id);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = "ok";
        else $res = "error";
        return $res;
    }

    public function getPlanGrafica() {
        $sql = "SELECT COUNT(p.plan) as total, p.plan FROM atletas a
                INNER JOIN planes p ON a.plan = p.plan_id
                GROUP BY p.plan_id ORDER BY total DESC LIMIT 10";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getHorarioGrafica() {
        $sql = "SELECT COUNT(d.horarios_id) as total, h.hinicio, h.hfin FROM detalle_compras d
                INNER JOIN horarios h ON h.horarios_id = d.horarios_id
                GROUP BY d.horarios_id ORDER BY total DESC LIMIT 10";
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