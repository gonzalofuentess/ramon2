<?php


$coman='curl -H "Authorization: Token fa6701be6f5967b2966a6c795ac178c62c8b5bdc" -H "Content-Type: application/json" -X POST -d "{ \"body\" : \"Prueba de Mensaje\", \"message_type\" : \"text/plain\" }" http://api.pushetta.com/api/pushes/Inacap/';
shell_exec($coman);

echo 'Comando Ejecutado';


?>