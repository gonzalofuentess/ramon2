<?php

require_once '../static/modelo.php';
$modelo = new Consulta();
$arreglo = $modelo->buscaConfiguracion();

$alta = $_POST['alta'];
$altacriticaltext = $_POST['altacriticaltext'];

$umbral = $arreglo[1]['umbral'];

if ($alta == "true") {
    $estado = 1;
} else {

    $estado = 0;
}

$modelo->actualizaAlta($altacriticaltext, $estado);

shell_exec('sudo systemctl start actualiza.service');
sleep(1); 
shell_exec('sudo systemctl restart alertas.service');
echo "Datos Actualizados";


?>