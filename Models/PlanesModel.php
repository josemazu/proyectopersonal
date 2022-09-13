<?php
class PlanesModel extends Query{
    private $plan, $precio, $obs, $estado, $plan_id;
    public function _construct() {
        parent::__construct();
    }

    public function getPlanes() {
        $sql = "SELECT * FROM planes";
        $data = $this->selectAll($sql);
        return $data;
    }

    public function registrarPlan( string $plan_id,string $plan, string $precio, string $estado, string $obs ) {
        $this->plan_id = $plan_id;
        $this->plan = $plan;
        $this->precio = $precio;
        $this->estado = $estado;
        $this->obs = $obs;
        $verificar = "SELECT * FROM planes WHERE plan_id = '$this->plan_id'";
        $existe = $this->select($verificar);
        if(empty($existe)) {
            $sql = "INSERT INTO planes(plan_id, plan, precio, estado, obs) VALUES (?,?,?,?,?)";
            $datos = array( $this->plan_id, $this->plan, $this->precio, $this->estado, $this->obs);
            $data = $this->save( $sql, $datos );
            if( $data == 1 ) $res = 'ok';
            else $res = 'error';
        }
        else $res = "existe";
        return $res;
    }

    public function modificarPlan( string $plan, int $precio, int $estado, string $obs, string $plan_id ) {
        $this->plan = $plan;
        $this->precio = $precio;
        $this->estado = $estado;
        $this->obs = $obs;
        $this->plan_id = $plan_id;
        $sql = "UPDATE planes SET plan = ?, precio = ?, estado = ?, obs = ? WHERE plan_id = ?";
        $datos = array( $this->plan, $this->precio, $this->estado, $this->obs,  $this->plan_id);
        $data = $this->save( $sql, $datos );
        if( $data == 1 ) $res = 'modificado';
        else $res = 'error';
        return $res;
    }


    public function editarPlan(string $plan_id) {
        $sql = "SELECT * FROM planes WHERE plan_id = '$plan_id'";
        $data = $this->select($sql);
        return $data;
    }

    public function accionPlan(int $estado, string $plan_id) {
        $this->estado = $estado;
        $this->plan_id = $plan_id;
        $sql = "UPDATE planes SET estado = ? WHERE plan_id = ?";
        $datos = array($this->estado, $this->plan_id);
        $data = $this->save($sql, $datos);
        return $data;
    }
}
?>