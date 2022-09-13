<?php
class HorariosModel extends Query{
    private $horarios_id, $plan_id, $hinicio, $hfinal, $estado;
    public function _construct() {
        parent::__construct();
    }

    public function getHorarios() {
        $sql = "SELECT h.*, p.plan FROM horarios h
                INNER JOIN planes p on h.plan_id = p.plan_id";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getPlan ( string $plan_id ) {
        $sql = "SELECT * FROM planes WHERE plan_id = '$plan_id'";
        $data = $this->select($sql);
        return $data;
    }

    public function getPlanes () {
        $sql = "SELECT * FROM planes WHERE estado = 1";
        $data = $this->selectALL($sql);
        return $data;
    }

    public function registrarHorario(string $plan_id, string $hinicio, string $hfinal, int $estado) {
        $sql = "INSERT INTO horarios (plan_id, hinicio, hfin, estado) VALUES (?,?,?,?)";
        $datos = array($plan_id, $hinicio, $hfinal, $estado);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = "ok";
        else $res="error";
        return $res;
    }

    public function modificarHorario( string $plan_id, string $hinicio, string $hfinal, int $estado, int $horarios_id ) {
        $this->plan_id = $plan_id;
        $this->hinicio = $hinicio;
        $this->hfinal = $hfinal;
        $this->estado = $estado;
        $sql = "UPDATE horarios SET plan_id = ?, hinicio = ?, hfin = ?, estado = ? WHERE horarios_id = ?";
        $datos = array( $this->plan_id, $this->hinicio, $this->hfinal, $this->estado, $this->horarios_id);
        $data = $this->save( $sql, $datos );
        if( $data == 1 ) $res = 'modificado';
        else $res = 'error';
        return $res;
    }

    public function actualizarhorario(string $plan_id, string $hinicio, string $hfinal, int $horarios_id){
        $sql = "UPDATE horarios SET plan_id = ?, hinicio = ?, hfin = ? WHERE horarios_id = ?";
        $datos = array($plan_id, $hinicio, $hfinal, $horarios_id);
        $data = $this->save($sql, $datos);
        if($data == 1) $res = "modificado";
        else {$res="error"; }
        return $res;
    }

    public function consultarHorario(string $plan_id, string $horarioi, string $horariof) {
        $sql = "SELECT * FROM horarios WHERE plan_id = '$plan_id' AND hinicio = '$horarioi' AND hfin = '$horariof'";
        $data = $this->select($sql);
        return $data;
    }

    public function editarHorario(int $horarios_id) {
        $sql = "SELECT * FROM horarios WHERE horarios_id = $horarios_id";
        $data = $this->select($sql);
        return $data;
    }

    public function accionHorario(int $estado, int $horarios_id) {
        $this->estado = $estado;
        $this->plan_id = $horarios_id;
        $sql = "UPDATE horarios SET estado = ? WHERE horarios_id = ?";
        $datos = array($this->estado, $this->plan_id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
?>