<?php 
include "../conexion.php";
	if (!empty($_POST)) {
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['correo'])|| empty($_POST['usuario'])|| empty($_POST['rol']))
		{
			$alert= '<p class="msg_error"> Todos los campos son obligatorios. </p>';
		}else{
			
			$nombre=$_POST['nombre'];
			$email=$_POST['correo'];
			$usuario=$_POST['usuario'];
			$clave= md5($_POST['clave']);
			$rol=$_POST['rol'];

			
			$query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email");
			$result = mysqli_fetch_array($query);
			if($result >0){
				$alert = '<p class="msg_error"> El correo o usuario ya existe. </p>';
			}else
			{
				if (empty($_POST['clave'])) {
					$sql_update = mysqli_query($conection, "UPDATE usuario
						SET nombre= '$nombre' correo= '$correo' usuario= '$user' rol= '$rol'
						WHERE idusuario='$idUsuario'");
				}else{
					$sql_update = mysqli_query($conection, "UPDATE usuario
						SET nombre= '$nombre', correo= '$correo', usario= '$user', clave= '$clave', rol= '$rol'
						WHERE idusuario='$idUsuario'");
				}			
				if ($sql_update) {
					$alert = '<p class="msg_save"> Usuario actualizado correctamente. </p>';
				}else
				{
					$alert = '<p class="msg_error"> Error al actuaizar el usuario </p>';
				}
			}
	}
}

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar de Usuario</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">		
			<div class ="form_register">
					<h1> Actualizar Usuario </h1>
					<hr>
					<div class="alert"> 
						<?php 
							echo isset($alert)? $alert:'';
						 ?>
					</div>
					<form action="" method="post">
							<label for="nombre">Nombre</label>
							<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
							<label for= "correo"> Correo Electrónico</label>
							<input type="email" name="correo" id="correo" placeholder="Correo Electronico">
							<label for="usuario">Usuario</label>
							<input type="text" name="usuario" id="usuario" placeholder="Usuario">
							<label for="clave"> Clave</label>
							<input type="password" name="clave" id="Clave" placeholder="Clave de acceso" onkeydown="caracteres()">
							<script> function caracteres(){ var input = document.getElementById('input'); if(input.value.length < 8) { alert('Escribe almenos 8 carácteres.'); } } </script>
							<label for="rol"> Tipo de Usuario</label>

							<?php 
								$query_rol = mysqli_query($conection,"SELECT * FROM rol" );

								$result_rol= mysqli_num_rows($query_rol);
								
							 ?>


							<select name="rol" id="rol">	
								<?php  
									if($result_rol > 0)
								{
									while ($rol = mysqli_fetch_array($query_rol)) {
								?>	
								<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
								<?php
									{
									# code...
									}
								}
							}

								?>
								</select>
								<input type="submit" value="Crear Usuario" class="btn_save">
					</form>
			 </div>

	</section>


	<?php include "includes/footer.php"; ?>
</body>
</html>