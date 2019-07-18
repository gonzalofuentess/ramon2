<?php

require_once '../static/modelo.php';

$horario = $_POST['horario'];

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

if (validateDate($horario, 'H:i')) {
    $actualiza = new Consulta();
    if($actualiza->agregarHora($horario)==1){
        echo "Datos Actualizados";
    }else{
     echo "Horario ya registrado";   
    }    
} else {
    echo "Ingrese una hora en formato válido";
}
