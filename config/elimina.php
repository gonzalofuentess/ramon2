<?php

require_once '../static/modelo.php';

$iddestinatario = $_POST['iddestinatario'];



$elimina = new Consulta();
$elimina ->eliminaDestinatario($iddestinatario);

echo "Datos Actualizados";


?>
