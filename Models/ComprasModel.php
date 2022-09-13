<?php
class ComprasModel extends Query{
    private $ci, $nombre, $direccion, $email, $celular, $estado, $fecha_ingreso, $plan, $atleta_id;
    public function _construct() {
        parent::__construct();
    }

    public function getPlan ( string $plan_id ) {
        $sql = "SELECT * FROM planes p WHERE plan_id = '$plan_id'";
        $data = $this->select($sql);
        return $data;
    }
    public function getPlanes () {
        $sql = "SELECT * FROM planes WHERE estado = 1";
        $data = $this->selectALL($sql);
        return $data;
    }

    public function getCliente($atleta_id) {
        $sql = "SELECT * FROM atletas WHERE atleta_id = $atleta_id AND estado = 1";
        $data = $this->select($sql);
        return $data;
    }

    public function getClientes() {
        $sql = "SELECT * FROM atletas WHERE estado = 1";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getPlanHorario($plan_id) {
        $sql = "SELECT h.horarios_id, h.hinicio, h.hfin FROM horarios h
                INNER JOIN planes p on p.plan_id = h.plan_id
                WHERE h.plan_id = '$plan_id'";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarDetalle(string $plan_id , int $horarios_id, int $usuario_id, int $atleta_id, string $precio, int $cantidad, string $sub_total){
        $sql = "INSERT INTO detalle (plan_id, horarios_id, usuario_id, atleta_id, precio, cantidad, sub_total) VALUES (?,?,?,?,?,?,?)";
        $datos = array($plan_id, $horarios_id, $usuario_id, $atleta_id, $precio, $cantidad, $sub_total);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = "ok";
        else $res="error";
        return $res;
    }

    public function actualizarDetalle(int $atleta_id, string $precio, int $cantidad, string $sub_total, int $horarios_id, string $plan_id, int $usuario_id){
        $sql = "UPDATE detalle SET precio = ?, cantidad = ?, sub_total = ?, horarios_id = ? 
                WHERE plan_id = ? AND usuario_id = ? AND atleta_id = ?";
        $datos = array($precio, $cantidad, $sub_total, $horarios_id, $plan_id, $usuario_id, $atleta_id);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = "modificado";
        else {$res="error"; }
        return $res;
    }
    
    public function getDetalle(int $usuario_id) {
        $sql = "SELECT d.*, p.*, a.nombre, a.atleta_id, h.hinicio,h.hfin FROM detalle d
        INNER JOIN planes p ON p.plan_id = d.plan_id 
        INNER JOIN horarios h ON h.plan_id = p.plan_id
        INNER JOIN atletas a ON a.atleta_id = d.atleta_id 
        WHERE d.usuario_id = $usuario_id and d.horarios_id = h.horarios_id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function calcularCompra(int $usuario_id) {
        $sql = "SELECT sub_total, SUM(sub_total) AS total FROM detalle WHERE usuario_id = $usuario_id";
        $data = $this->select($sql);
        return $data;
    }

    public function deleteDetalle(int $detalle_id) {
        $sql = "DELETE FROM detalle WHERE detalle_id = ?";
        $datos = array($detalle_id);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = "ok";
        else $res="error";
        return $res;
    }

    public function consultarDetalle(string $plan_id, int $usuario_id, int $atleta_id) {
        $sql = "SELECT * FROM detalle WHERE plan_id = '$plan_id' AND usuario_id = $usuario_id AND atleta_id = $atleta_id";
        $data = $this->select($sql);
        return $data;
    }
    
    public function registrarCompra(string $total) {
        $sql = "INSERT INTO compras (total, estado) VALUES (?,?)";
        $datos = array($total,1);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = "ok";
        else $res="error";
        return $res;
    }

    public function compra_id() {
        $sql = "SELECT MAX(compra_id) AS id FROM compras";
        $data = $this->select($sql);
        return $data;
    }

    public function registrarDetalleCompra(int $compra_id, string $plan_id, int $horarios_id, int $atleta_id, int $cantidad, string $precio, string $sub_total) {
        $sql = "INSERT INTO detalle_compras (compra_id, plan_id, atleta_id, horarios_id, cantidad, precio, sub_total) VALUES (?,?,?,?,?,?,?)";
        $datos = array($compra_id, $plan_id, $horarios_id, $atleta_id, $cantidad, $precio, $sub_total);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = "ok";
        else $res="error";
        return $res;
    }
    public function vaciarDetalle(int $usuario_id) {
        $sql = "DELETE FROM detalle WHERE usuario_id = ? ";
        $datos = array($usuario_id);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = "ok";
        else $res="error";
        return $res;
    }

    function getPlanCompra($compra_id) {
        $sql = "SELECT c.*, d.*, a.nombre,a.ci, p.obs FROM compras AS c
                INNER JOIN detalle_compras AS d
                ON d.compra_id = c.compra_id
                INNER JOIN planes AS p
                ON d.plan_id = p.plan_id
                INNER JOIN atletas AS a
                ON d.atleta_id = a.atleta_id
                WHERE c.compra_id = $compra_id";
        $data = $this->selectAll($sql);
        return $data;
    }

    function getHistorialCompras() {
        $sql = "SELECT * FROM compras";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getRangoFechas(string $desde, string $hasta) {
        $sql = "SELECT a.atleta_id, a.nombre, d.*, c.*, p.plan FROM atletas a
                INNER JOIN detalle_compras d ON d.atleta_id = a.atleta_id
                INNER JOIN compras c ON c.compra_id = d.compra_id
                INNER JOIN planes p ON d.plan_id = p.plan_id
                WHERE c.fecha BETWEEN'$desde' AND '$hasta' ORDER BY a.nombre";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getTotalRangoFechas(string $desde, string $hasta) {
        $sql = "SELECT SUM(p.precio) as total FROM atletas a
                INNER JOIN detalle_compras d ON d.atleta_id = a.atleta_id
                INNER JOIN compras c ON c.compra_id = d.compra_id
                INNER JOIN planes p ON d.plan_id = p.plan_id
                WHERE c.fecha BETWEEN'$desde' AND '$hasta'";
        $data = $this->select($sql);
        return $data;
    }

    public function getAnularCompra(int $compra_id) {
        $sql = "SELECT c.*, d.* FROM compras c
                INNER JOIN detalle_compras d ON c.compra_id = d.compra_id
                WHERE c.compra_id = $compra_id";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function getAnular(int $compra_id) {
        $sql = "UPDATE compras SET estado = ? WHERE compra_id = ?";
        $datos = array (0, $compra_id);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = "ok";
        else $res="error";
        return $res;
    }

    public function getDatosEmpresa() {
        $sql = "SELECT * FROM empresa";
        $data = $this->select($sql);
        return $data;
    }
}
?>