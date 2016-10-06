<?php

echo 'Enviando correo';

try {
	$headers = "From: HWW@healthwithoutworries.com";
	$correo_destino= "mrlsjavi@gmail.com";
	$titulo = "Password Reset";
	$mensaje  = "prueba de correo";
	mail($correo_destino, $titulo, $mensaje, $headers);



} catch (Exception $e) {
	echo $e;
}



?>