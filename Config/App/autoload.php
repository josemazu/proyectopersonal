<?php
spl_autoload_register(function($class) {
    $ruta = "Config/App/" . $class . ".php";
    if(file_exists($ruta)) {
        require_once $ruta;
    }
}
)

?>