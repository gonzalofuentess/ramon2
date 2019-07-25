<?php

$apass = $_POST['apass'];
$npass = $_POST['npass'];
require_once ('../static/modelo.php');
require_once ('../static/modelo2.php');
// Crea la conexión


$modelo = new Consulta();
$dato = $modelo ->validaUsuario($user, $pass);

// Verifica la conexión

    if ($dato==1) {
       
    }else{
        echo '0';
    } 

