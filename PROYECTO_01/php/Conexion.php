<?php
$servidor="localhost";
$ususario="root";
$contraseña="";
$db="usuarios";

$conexion =new mysqli($servidor,$ususario,$contraseña,$db);

if($conexion->connect_error){
	die("Connection Failed".$conexion->connect_error);
}else{
	/*echo '<script>alert("coneccion exitosa")</script>';*/
}
