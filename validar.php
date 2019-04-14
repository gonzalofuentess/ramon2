<?php
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
require('./static/conexion.php');
// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);
// Verifica la conexión
if ($conn->connect_error) {
    #die("Conexión falló: " . $conn->connect_error);
     #exit();
     echo '<span style="color:red;">Error al conectar con la base de datos</span>';
}else{  

$sql = "select nombre from ramon.usuario where nombre='$user' and clave = md5('$pass')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  //  echo "ok";  
    $_SESSION['usuario']=$user;
    //echo '<script>location.href = "usuario.php"</script>';
    //header("location:usuario.php");
    // echo "EXISTE";
    echo '<script>location.href = "./main/"</script>';
}else{    
    #header("location:login.html");
    echo '<span style="color:red;">El usuario y/o clave son incorrectas, vuelva a intentarlo</span>';
}
}
?>