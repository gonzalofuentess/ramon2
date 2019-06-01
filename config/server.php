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
if ($switchtls) {
    $tls = 1;
} else {
    $tls = 0;
}
if ($autenticacion == "NO") {
    $anonimo = 0;
} else {
    $anonimo = 1;
}

if ($anonimo == 0) {

    $arreglo = array('servidor' => $servidor, 'puerto' => $puerto, 'starttls' => $tls, 'anonimo' => 0);
} else {
    $arreglo = array('servidor' => $servidor, 'puerto' => $puerto, 'starttls' => $tls, 'anonimo' => 1, 'correousuario' => $correousuario, 'correopassword' => $correopassword);
}

require_once '../static/modelo.php';
$guardar = new Consulta();
$guardar->guardaMail($arreglo);



?>
