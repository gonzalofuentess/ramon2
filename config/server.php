<?php

session_start();
$servidor = $_POST['servidor'];
$puerto = $_POST['puerto'];
$switchtls = $_POST['switchtls'];
$autenticacion = $_POST['autenticacion'];
$correousuario = $_POST['correousuario'];
$correopassword = $_POST['correopassword'];


$var = 0;

if (!$servidor || !$puerto) {

    echo"Favor completar los siguientes datos: \n \n";

    if (!$servidor) {

        $var = $var + 1;
        echo $var . ". Servidor \n";
    }
    if (!$puerto) {
        $var = $var + 1;
        echo $var . ". Puerto \n";
    }
}
if ($switchtls=="true") {
    $tls = 1;
} else {
    $tls = 0;
}

if ($autenticacion == "SI") {
    $arreglo = array('servidor' => $servidor, 'puerto' => $puerto, 'starttls' => $tls, 'autenticacion' => 1, 'correousuario' => $correousuario, 'correopassword' => $correopassword);
} if ($autenticacion == "NO"){
    $arreglo = array('servidor' => $servidor, 'puerto' => $puerto, 'starttls' => $tls, 'autenticacion' => 0);
}

require_once '../static/modelo.php';
$guardar = new Consulta();
$guardar->guardaMail($arreglo);

echo "Datos Actualizados";
?>
