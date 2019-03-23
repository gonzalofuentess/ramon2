
<?php
session_start();
// Controlo si el usuario ya está logueado en el sistema.
if (isset($_SESSION['usuario'])) {
    
    header("Location: ./main/index.php");
   
} else {
    // Si no está logueado lo redireccion a la página de login.
    include './login.html';
}


?>
