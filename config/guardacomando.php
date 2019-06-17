<?php
require_once '../static/modelo2.php';
$modelo = new DatosBD();


$message = "HOLAS";

$channel = 'Inacap';
$apikey = 'fa6701be6f5967b2966a6c795ac178c62c8b5bdc';
$expire = '2019-06-22'; // In YYYY-MM-DD format

$data = array(
'body' => $message,
'message_type' => 'text/plain',
'expire' => $expire
);

$ch = curl_init("http://api.pushetta.com/api/pushes/$channel/");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Token $apikey"));

$response = json_decode(curl_exec($ch));


#$coman='curl -H "Authorization: Token fa6701be6f5967b2966a6c795ac178c62c8b5bdc" -H "Content-Type: application/json" -X POST -d "{ \"body\" : \"Prueba de Mensaje\", \"message_type\" : \"text/plain\" }" http://api.pushetta.com/api/pushes/Inacap/';
#system($coman);
#$result = curl_exec($coman);
echo "Datos Actualizados";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

