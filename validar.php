<?php

session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
require_once ('./static/modelo.php');
// Crea la conexión


$modelo = new Consulta();
$dato = $modelo ->validaUsuario($user, $pass);

// Verifica la conexión

    if ($dato==1) {
        $_SESSION['usuario'] = $user;
        echo '<script>location.href = "./main/"</script>';
    } if($dato==0){
        echo '<span style="color:red;">El usuario y/o clave son incorrectas, vuelva a intentarlo</span>';
    }else{
        
        '<span style="color:red;">Ha ocurrido un error al conectar</span>';
    }
?>