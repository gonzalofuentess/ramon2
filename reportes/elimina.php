<?php

require_once '../static/modelo.php';

$iddestinatario = $_POST['iddestinatario'];



$elimina = new Consulta();
$elimina ->eliminaDestinatario($iddestinatario,2);

echo "Datos Actualizados";


?>
