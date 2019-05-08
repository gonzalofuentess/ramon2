<?php

class Consulta {

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

    function validaUsuario($username, $password) {

        try {

            $conexion = $this->conectarBD();
            $sql = "CALL ramon.usuario('$username','$password',@salida);";

            if (!$result = mysqli_query($conexion, $sql)) {
                die();
            }
            $rawdata = array();
            $i = 0;

            while ($row = mysqli_fetch_array($result)) {
                $rawdata[$i] = $row;
                $i++;
            }
            $this->desconectarBD($conexion);
            return $rawdata[0][0];
        } catch (Exception $ex) {
            return 2;
        }
    }

    function buscaConfiguracion() {
        $conexion = $this->conectarBD();
        $sql = "select * from ramon.tipo_alerta";
        if (!$result = mysqli_query($conexion, $sql)) {
            die();
        }
        $rawdata = array();
        $i = 0;

        while ($row = mysqli_fetch_array($result)) {
            //   //guardamos en rawdata todos los vectores/filas que nos devuelve la consulta
            $rawdata[$i] = $row;
            $i++;
        }
        //Cerramos la base de datos

        $this->desconectarBD($conexion);
        //devolvemos rawdata
        //return $rawdata;
        return $rawdata;
    }

}

?>