<?php
session_start();

$_SESSION["names"] = $_POST['nombre'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin título</title>
</head>

<body>
 <p>SE CREÓ LA SESION</p>
 <h2>   <a href="sesion3.php">Siguiente >>  </a>   </h2>
</body>
</html>
