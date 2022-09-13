<?php
class Conexion {
    private $conect;
    public function __construct() {
        $pdo = 'mysql:dbname='.database.';host='.host;
        try {
            $this->conect = new PDO($pdo, 'root', '');
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo "Error en la conexion". $e->getMessage();
        }
    }

    public function conect() {
        return $this->conect;
    }
}
