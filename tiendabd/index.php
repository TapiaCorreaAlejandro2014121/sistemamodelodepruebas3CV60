<?php

	$alert = '';
	session_start();
	if (!empty($_SESSION['active']))
		
	{
		header('location: sistema/');
	}
	else
	{
	if (!empty($_POST)) {
		if (empty($_POST['usuario'])|| empty($_POST['clave']))
			{
				$alert = 'Ingrese su usuario y contraseña';
			}else
				{
					require_once "conexion.php";
					$user = mysqli_real_escape_string ($conection, $_POST['usuario']);
					$pass = md5(mysqli_real_escape_string ($conection,$_POST['clave']));
					$query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario ='$user'AND clave= '$pass'");
					$result= mysqli_num_rows($query);
					if($result > 0)
					{
						$data = mysqli_fetch_array($query);
						
						$_SESSION['active'] = true;
						$_SESSION['iduser'] = $data['idusuario'];
						$_SESSION['nombre'] = $data['nombre'];
						$_SESSION['email'] = $data['email'];
						$_SESSION['user'] = $data['usuario'];
						$_SESSION['rol'] = $data['rol'];
						header('location: sistema/');

					}else
					{
						$alert = 'El usuario y contraseña están mal, intente de nuevo';
						session_destroy();
					}
				}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>	Login | Tienda </title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<section id= "container">
		
		<form action="" method="post">
			<h3>Iniciar Sesion 	 </h3>
			<img src="img/candado.png" width="150" height="100" alt="Login">
			<input type="text" name="usuario" placeholder="Usuario">
			<input type="password" name="clave" placeholder="Contraseña">
			
			<div class= "alert"><?php echo isset($alert)? $alert : ''; ?> </div>
			<input type="submit" value="INGRESAR" >


		</form>
	</section>
</body>
</html>
