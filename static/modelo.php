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
            $row = mysqli_fetch_array($result);

            $this->desconectarBD($conexion);
            return $row[0][0];
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

    function buscaRadio() {
        $conexion = $this->conectarBD();
        $sql = "SELECT frecuencia, descripcion FROM ramon.radio;";

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

    function actualizaBaja($baja, $activo) {
        $conexion = $this->conectarBD();
        $sql = "UPDATE  ramon.tipo_alerta set umbral=$baja, estado=$activo  where idtipo=2";
        $conexion->query($sql);


        $this->desconectarBD($conexion);
    }

    function buscaAlertas() {
        $conexion = $this->conectarBD();
        $sql = "SELECT * from ramon.alerta;";

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

    function consultaSemana() {

        $conexion = $this->conectarBD();
        $sql = "CALL ramon.semana();";

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
        return array_reverse($rawdata);
    }

    function consultaUptime() {

        $conexion3 = $this->conectarBD();
        $sql = "CALL ramon.uptime();";

        if (!$result3 = mysqli_query($conexion3, $sql)) {
            die();
        }
        $rawdata3 = array();
        $i = 0;

        while ($row3 = mysqli_fetch_array($result3)) {
            //   //guardamos en rawdata todos los vectores/filas que nos devuelve la consulta
            $rawdata3[$i] = $row3;
            $i++;
        }
        //Cerramos la base de datos

        $this->desconectarBD($conexion3);
        //devolvemos rawdata
        //return $rawdata;
        return ($rawdata3);
    }

    function resumen() {


        $conexion2 = $this->conectarBD();
        $sql1 = "SELECT SUM(duracion_seg) from ramon.alerta where idtipo=1;";

        if (!$result1 = mysqli_query($conexion2, $sql1)) {
            die();
        }


        $row1 = mysqli_fetch_array($result1);
        $silencio = $row1[0];


        //Cerramos la base de datos

        $sql2 = "SELECT SUM(duracion_seg) from ramon.alerta where idtipo=2;";
        $result2 = mysqli_query($conexion2, $sql2);
        $row2 = mysqli_fetch_array($result2);

        $baja = $row2[0];

        $sql3 = "SELECT SUM(duracion_seg) from ramon.alerta where idtipo=3;";
        $result3 = mysqli_query($conexion2, $sql3);
        $row3 = mysqli_fetch_array($result3);
        $alta = $row3[0];
        $this->desconectarBD($conexion2);

        $arreglo = array('silencio' => $silencio, 'baja' => $baja, 'alta' => $alta);
        //devolvemos rawdata
        //return $rawdata;
        return ($arreglo);
    }

    function guardaMail($arreglo) {

        if ($arreglo['autenticacion'] == 1) {

            $servidor = $arreglo['servidor'];
            $puerto = $arreglo['puerto'];
            $starttls = $arreglo['starttls'];
            $usuario = $arreglo['correousuario'];
            $clave = $arreglo['correopassword'];

            $conexion = $this->conectarBD();
            $sql = "UPDATE ramon.servidor SET servidor='$servidor',puerto=$puerto,tls=$starttls,usuario='$usuario',clave='$clave',autenticacion=1 where idservidor=1;";
            $conexion->query($sql);
        } else {

            $servidor = $arreglo['servidor'];
            $puerto = $arreglo['puerto'];
            $starttls = $arreglo['starttls'];
            $conexion = $this->conectarBD();
            $sql = "UPDATE ramon.servidor SET servidor='$servidor',puerto=$puerto,tls=$starttls,usuario=NULL,clave=NULL,autenticacion=0 where idservidor=1;";
            $conexion->query($sql);
        }


        $this->desconectarBD($conexion);


        return 1;
    }

    function consultaMail() {

        $conexion = $this->conectarBD();
        $sql = "SELECT servidor,puerto,tls,autenticacion,usuario,clave FROM ramon.servidor where idservidor=1;";

        if (!$result = mysqli_query($conexion, $sql)) {
            die();
        }
        $rawdata = array();
        //$i = 0;

        while ($row = mysqli_fetch_array($result)) {

            array_push($rawdata, $row);
        }
        //Cerramos la base de datos

        $this->desconectarBD($conexion);
        //devolvemos rawdata
        //return $rawdata;
        return $rawdata[0];
    }

    function agregarDestinatario($mail) {


        $conexion = $this->conectarBD();
        $sql = "insert into ramon.destinatario_alerta(idservidor, destinatario) values (1,'$mail');";

        $conexion->query($sql);

        //Cerramos la base de datos

        $this->desconectarBD($conexion);
        //devolvemos rawdata
        //return $rawdata;
     

        return 1;
    }
    function buscaDestinatario(){
        
        
    }

}

?>