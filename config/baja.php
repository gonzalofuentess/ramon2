<?php

require_once '../static/modelo.php';
$modelo = new Consulta();
$arreglo = $modelo->buscaConfiguracion();

$baja = $_POST['baja'];
$bajacriticaltext = $_POST['bajacriticaltext'];

$umbral = $arreglo[1]['umbral'];

if ($baja == "true") {
    $estado = 1;
} else {

    $estado = 0;
}

$modelo->actualizaBaja($bajacriticaltext, $estado);

echo "Datos Actualizados";


?>