<?php

require_once '../static/modelo.php';

$correo = $_POST['correo'];



if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {


    $actualiza = new Consulta();
    $actualiza->agregarDestinatario($correo);
    echo "Datos Actualizados";
} else {
    echo "!Ingrese un correo en formato Válido¡";
}
?>
