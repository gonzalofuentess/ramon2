<?php

require_once '../static/modelo.php';

$horario = $_POST['horario'];

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

if (validateDate($horario, 'H:i')) {
    $actualiza = new Consulta();
    $actualiza->agregarHora($horario);
    echo "Datos Actualizados";
} else {
    echo "Ingrese una hora en formato válido";
}
