<?php

class DatosBD {

    function conectarBD() {
        require('conexion.php');
        //variable que guarda la conexión de la base de datos
        $conexion = mysqli_connect($servername, $username, $password, $dbname);
        //Comprobamos si la conexión ha tenido exito
        if (!$conexion) {
            echo 'Ha sucedido un error al internar conectar a la base de datos<br>';
        }
        //devolvemos el objeto de conexión para usarlo en las consultas  
        return $conexion;
    }

    function desconectarBD($conexion) {
        //Cierra la conexión y guarda el estado de la operación en una variable
        $close = mysqli_close($conexion);
        //Comprobamos si se ha cerrado la conexión correctamente
        if (!$close) {
            echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>';
        }
        //devuelve el estado del cierre de conexión
        return $close;
    }

    function agregaComando($comando, $estado) {

        $conexion = $this->conectarBD();
        $sql = "update ramon.comando set comando='$comando', estado=$estado where idcomando =1;";
        $conexion->query($sql);
        $this->desconectarBD($conexion);
        return 1;
    }

}

?>