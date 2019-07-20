<?php

require_once '../static/modelo2.php';
$modelo = new DatosBD();


$comando = $_POST['comando'];

$cadena_formateada = trim($comando);

if ($cadena_formateada == NULL) {
    echo "Debe Ingresar Comando en Curl";
} else {
    if (substr($cadena_formateada, 0, 4) == 'curl') {
        $modelo->agregaComando($cadena_formateada, 1);
        #echo $cadena_formateada;
        echo "Datos Actualizados";
    } else {
        echo "Debe Ingresar Comando en Curl";
    }
}
 
#echo "Datos Actualizados";

