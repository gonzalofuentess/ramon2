<?php
require_once 'modelo.php';

$modelo = new Consulta();

#$username='admin';
#$password='admin';
#$dato = $modelo ->validaUsuario($username, $password);

$arreglo = $modelo->buscaConfiguracion();

#print_r($arreglo);



$datos = json_encode($arreglo);

echo $arreglo[1]['idtipo'];
echo $arreglo[1]['tipo'];
echo $arreglo[1]['umbral'];
echo $arreglo[1]['estado'];
$data = json_decode($datos, true);

#print $data[0]['idtipo'];


#foreach ($data as $objeto) {
        
                                                            
            echo $data[0]['idtipo'];
            echo $data[0]['tipo']; 
             echo $data[0]['umbral'];
             echo $data[0]['estado'];
     

        
       
    
#}

