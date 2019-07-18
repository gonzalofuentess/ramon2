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
        return $conexion;
    }

    function desconectarBD($conexion) {
        $close = mysqli_close($conexion);
        if (!$close) {
            echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>';
        }
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
            $rawdata[$i] = $row;
            $i++;
        }
        $this->desconectarBD($conexion);
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
        $this->desconectarBD($conexion);
        return $rawdata;
    }

    function actualizaBaja($baja, $activo) {
        $conexion = $this->conectarBD();
        $sql = "UPDATE  ramon.tipo_alerta set umbral=$baja, estado=$activo  where idtipo=2";
        $conexion->query($sql);
        $this->desconectarBD($conexion);
    }

    function actualizaAlta($alta, $activo) {
        $conexion = $this->conectarBD();
        $sql = "UPDATE  ramon.tipo_alerta set umbral=$alta, estado=$activo  where idtipo=3";
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
            $rawdata[$i] = $row;
            $i++;
        }
        $this->desconectarBD($conexion);
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
            $rawdata[$i] = $row;
            $i++;
        }
        $this->desconectarBD($conexion);
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
            $rawdata3[$i] = $row3;
            $i++;
        }
        $this->desconectarBD($conexion3);
        return ($rawdata3);
    }

    function resumen() {
        $conexion = $this->conectarBD();
        $sql = "SELECT * from ramon.uptime;";

        if (!$result = mysqli_query($conexion, $sql)) {
            die();
        }
        $i = 0;
        $rawdata = array();
        while ($row = mysqli_fetch_array($result)) {
            if ($i == 0) {
                $otro = array('uptime' => $row[1]);
                $rawdata = array_merge($otro, $rawdata);
            }if ($i == 1) {
                $otro = array('silencio' => $row[1]);
                $rawdata = array_merge($otro, $rawdata);
            }if ($i == 2) {
                $otro = array('baja' => $row[1]);
                $rawdata = array_merge($otro, $rawdata);
            }if ($i == 3) {
                $otro = array('alta' => $row[1]);
                $rawdata = array_merge($otro, $rawdata);
            }
            $i++;
        }
        $this->desconectarBD($conexion);
        return $rawdata;
    }

    function guardaMail($arreglo) {
        if ($arreglo['autenticacion'] == 1) {
            $servidor = $arreglo['servidor'];
            $puerto = $arreglo['puerto'];
            $remitente = $arreglo['remitente'];
            $starttls = $arreglo['starttls'];
            $usuario = $arreglo['correousuario'];
            $clave = $arreglo['correopassword'];
            $conexion = $this->conectarBD();
            $sql = "UPDATE ramon.servidor SET servidor='$servidor',puerto=$puerto,remitente='$remitente',tls=$starttls,usuario='$usuario',clave='$clave',autenticacion=1 where idservidor=1;";
            $conexion->query($sql);
        } else {
            $servidor = $arreglo['servidor'];
            $puerto = $arreglo['puerto'];
            $remitente = $arreglo['remitente'];
            $starttls = $arreglo['starttls'];
            $conexion = $this->conectarBD();
            $sql = "UPDATE ramon.servidor SET servidor='$servidor',puerto=$puerto,remitente='$remitente',tls=$starttls,usuario=NULL,clave=NULL,autenticacion=0 where idservidor=1;";
            $conexion->query($sql);
        }
        $this->desconectarBD($conexion);
    }

    function consultaMail() {
        $conexion = $this->conectarBD();
        $sql = "SELECT servidor,puerto,remitente,tls,autenticacion,usuario,clave FROM ramon.servidor where idservidor=1;";
        if (!$result = mysqli_query($conexion, $sql)) {
            die();
        }
        $rawdata = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($rawdata, $row);
        }
        $this->desconectarBD($conexion);
        return $rawdata[0];
    }

//    function agregarDestinatario($mail, $tipo) {
//        $conexion = $this->conectarBD();
//        $sql = "insert into ramon.destinatario(idservidor,tipodestinatario,destinatario) values (1,$tipo,'$mail');";
//        $conexion->query($sql);
//        $this->desconectarBD($conexion);
//        return 1;
//    }

    function agregarDestinatario($mail, $tipo) {
        try {
            $conexion = $this->conectarBD();
            $sql = "CALL ramon.destinatario('$mail',$tipo,@salida);";
            $conexion->query($sql);
            $results = $conexion->query('SELECT @salida');          
            $row = $results->fetch_assoc() or die("Error al registrar datos" . mysqli_error($results));
            $title = $row['@salida'];
            return $title;
        } catch (Exception $ex) {
            return 2;
        }
    }

    function buscaDestinatario($tipo) {
        $conexion = $this->conectarBD();
        $sql = "select iddestinatario, destinatario from ramon.destinatario where tipodestinatario=$tipo;";
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
        return $rawdata;
    }

    function eliminaDestinatario($iddestinatario) {
        $conexion = $this->conectarBD();
        $sql = "DELETE FROM ramon.destinatario  where iddestinatario = $iddestinatario;";
        if ($conexion->query($sql) !== TRUE) {
            echo "Error Borrando datos: " . $conexion->error . "<br>";
        }
        $this->desconectarBD($conexion);
        return 1;
    }

    function agregarHora($hora) {
//        $conexion = $this->conectarBD();
//        $sql = "insert into ramon.programacion(tipodestinatario,horario) values (2,'$hora');";
//        $conexion->query($sql);
//        $this->desconectarBD($conexion);
//        return 1;
//        
        try {
            $conexion = $this->conectarBD();
            $sql = "CALL ramon.horario('$hora',@salida);";
            $conexion->query($sql);
            $results = $conexion->query('SELECT @salida');          
            $row = $results->fetch_assoc() or die("Error al registrar datos" . mysqli_error($results));
            $title = $row['@salida'];
            return $title;
        } catch (Exception $ex) {
            return 0;
        }
        
        
    }

    function listarHora() {
        $conexion = $this->conectarBD();
        $sql = "SELECT idprogramacion, date_format(horario,'%H:%i') as horario FROM ramon.programacion order by horario;";
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
        return $rawdata;
    }

    function eliminaHora($idprogramacion) {
        $conexion = $this->conectarBD();
        $sql = "DELETE FROM ramon.programacion  where idprogramacion = $idprogramacion;";
        if (!$result = mysqli_query($conexion, $sql)) {
            die();
        }
        $this->desconectarBD($conexion);
        return 1;
    }

    function buscaSenal() {
        $conexion = $this->conectarBD();
        #$sql = "SELECT * FROM ramon.senal;";
        $sql = "SELECT date_format(registro,'%Y-%m-%d %H:%i:%s') as registro,valor FROM ramon.senal WHERE registro > DATE_SUB(NOW(), INTERVAL 3 MINUTE);";

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
        return $rawdata;
    }

    function truncar() {
        $conexion = $this->conectarBD();
        $sql = "CALL ramon.truncar();";
        if ($conexion->query($sql) !== TRUE) {
            echo "Error Ejecutando Comando: " . $conexion->error . "<br>";
        }
        $this->desconectarBD($conexion);
        return 1;
    }

}

?>