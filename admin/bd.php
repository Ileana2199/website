<?php


$servidor="localhost";
$baseDeDatos="website";
$usurario="root";
$contrasenia="";

try{

    $conexion=new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usurario,$contrasenia);


}catch(Exception $error){

    echo $error->getMessage();


}

?>