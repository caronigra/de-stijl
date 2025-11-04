<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registro</title>
</head>

<body>

<?php
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$email = $_POST['email'];
	$usuario = $_POST['usuario'];
	$password = $_POST['password'];

/*if(isset($_POST['newsletter'])){
	$news="si";
}else{
	$news="no";
}*/
	if ($_POST['newsletter'] === "") {
		$news="no";
	} else {
		$news="si";
	}


	include("conexion_login.php");

	session_start();
	$_SESSION['nombre'] = $nombre;

	$consulta = mysqli_query($conexion, "INSERT INTO usuarios (nombre, apellido, email, usuario, password, newsletter) VALUES('$nombre','$apellido','$email', '$usuario', '$password', '$news')");

	// En lugar de redirigir, simplemente terminar
	// El JavaScript manejará la respuesta
	echo "Registro exitoso";

?>


</body>
</html>