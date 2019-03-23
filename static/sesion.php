
<?php
session_start();
// Controlo si el usuario ya está logueado en el sistema.
if (!isset($_SESSION['usuario'])) {
    
    header("Location: ../index.php");
   
} 

?>
