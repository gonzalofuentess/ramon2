<?php

session_start();
$senal = $_POST['senal'];
$descripcion = $_POST['descripcion'];
$tiempo = $_POST['tiempo'];

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

if ($senals != $senal) {
    //echo "Debe Modificar la Frecuencia";    

    $sql2 = "UPDATE  ramon.radio set frecuencia=$senal where idradio=1";
    if ($conn2->query($sql2) !== TRUE) {
        echo "Error insertando datos: " . $conn->error . "<br>";
    } else {
        echo shell_exec("sudo /usr/bin/python3 /var/www/html/config/actualizaini.py -f 101.3");
        $cont = 1;
    }
} if ($descripcions != $descripcion) {
    #echo 'sudo /usr/bin/python3 /var/www/html/config/actualizaini.py -c ' . $descripcion;
    $sql3 = "UPDATE  ramon.radio set descripcion='$descripcion' where idradio=1";
    if ($conn2->query($sql3) !== TRUE) {
        echo "Error insertando datos: " . $conn->error . "<br>";
    } else {
        exec('sudo /usr/bin/python3 /var/www/html/config/actualizaini.py -c ' . $descripcion);
        $cont = 1;
    }
} if ($tiempos != $tiempo) {

    $sql4 = "UPDATE  ramon.radio set silencio=$tiempo where idradio=1";
    if ($conn2->query($sql4) !== TRUE) {
        echo "Error insertando datos: " . $conn->error . "<br>";
    } else {
        system("sudo /usr/bin/python3 /var/www/html/config/actualizaini.py -s $tiempo");
        $cont = 1;
    }
}

if ($cont === 1) {
    echo "Datos Actualizados";
    shell_exec('sudo systemctl restart ramon.service');
} else {

    echo "No se ha cambiado nada";
}
$conn->close();
?>
