<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enviar</title>
</head>

<body>
<?php

//se arma el array POST
$nombre=$_POST['nombre'];
$email=$_POST['email'];
$comentario=$_POST["comentario"];


$conexion = mysqli_connect("localhost","root","", "martes") or die('No se pudo conectar al servidor');

$consulta = mysqli_query($conexion, "INSERT INTO contactos (nombre,email,comentario)VALUES ( '$nombre','$email','$comentario')") or die(mysqli_error($conexion));

mysqli_close($conexion);

if($consulta){
	header("Location: contacto.php?enviado=1");
	exit();
}else{
	header("Location: contacto.php?error=1");
	exit();
}

?>
</body>
</html>