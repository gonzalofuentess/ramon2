<?php


require_once '../static/modelo.php';

$idhora = $_POST['idhora'];



$elimina = new Consulta();
$elimina ->eliminaHora($idhora);

echo "Datos Actualizados";

?>