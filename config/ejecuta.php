<?php

session_start();
$senal = $_POST['senal'];
$descripcion = $_POST['descripcion'];
$tiempo = $_POST['tiempo'];
require '../static/modelo.php';


require '../static/conexion.php';
$conn = new mysqli($servername, $username, $password, $dbname);

if (!($res = $conn->query("CALL radio()"))) {
    echo "Falló la llamada: (" . $conn->errno . ") " . $conn->error;
}
/* E imprimimos el resultado para ver que el ejemplo ha funcionado */
$salida = $res->fetch_assoc();
$senals = $salida['frecuencia'];
$descripcions = $salida['descripcion'];
$tiempos = $salida['silencio'];

$conn2 = new mysqli($servername, $username, $password, $dbname);
$cont = 0;
$estatus=0;

try {
    $verifica = $senal * 10;
    if ($verifica > 880 && $verifica < 1080) {
        $estatus = 1;
    } else {
        echo "La frecuencia debe estar entre 88.1 a 107.9\n";
    }
} catch (Exception $ex) {
    echo 'Ingrese una frecuencia válida';
}
if ($estatus == 1) {
    if ($senals != $senal) {
        $ejecuta = new Consulta;
        $ejecuta->truncar();
        $sql2 = "UPDATE  ramon.radio set frecuencia=$senal where idradio=1";
        if ($conn2->query($sql2) !== TRUE) {
            echo "Error insertando datos: " . $conn->error . "<br>";
        } else {
            $cont = 1;
        }
    }
} if ($descripcions != $descripcion) {

    $sql3 = "UPDATE  ramon.radio set descripcion='$descripcion' where idradio=1";
    if ($conn2->query($sql3) !== TRUE) {
        echo "Error insertando datos: " . $conn->error . "<br>";
    } else {
        $cont = 1;
    }
} if ($tiempos != $tiempo) {
    $sql4 = "UPDATE  ramon.tipo_alerta set umbral=$tiempo where idtipo=1";
    if ($conn2->query($sql4) !== TRUE) {
        echo "Error insertando datos: " . $conn->error . "<br>";
    } else {
        $cont = 1;
    }
}

if ($cont === 1) {
    #shell_exec('sudo systemctl start actualiza.service');
    shell_exec('sudo systemctl restart ramon.service');
    echo "Datos Actualizados";
} else {
    echo "Datos No Actualizados";
}
$conn->close();
?>
