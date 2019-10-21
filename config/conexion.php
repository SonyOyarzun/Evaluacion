<?php

class Conexion {

    private $_host = "localhost";
    private $_user = "root";
    private $_pass = "";
    private $_db   = "evaluacion";

    public function conectar() {
        $conexion = new mysqli("localhost", "root","", "evaluacion");
        
        if (!$conexion) {
            die("imposible conectarse: " . mysqli_error($conexion));
        }
        if (@mysqli_connect_errno()) {
            die("Conexión falló: " . mysqli_connect_errno() . " : " . mysqli_connect_error());
        }

        return $conexion;
    }

}

?>
