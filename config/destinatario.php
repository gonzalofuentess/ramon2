<?php

require_once '../static/modelo.php';

$correo = $_POST['correo'];



if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $actualiza = new Consulta();
    if ($actualiza->agregarDestinatario($correo, 1) == 1) {
        echo "Datos Actualizados";
    } else {
        echo "Destinatario ya existe ingrese otro correo";
}
} else {
    echo "!Ingrese un correo en formato Válido¡";
}
?>
