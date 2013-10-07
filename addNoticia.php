<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar nueva noticia</title>
</head>
<body>
	<header><h1>Nueva noticia</h1></header>
	<?php
		include "includes/conexion_bbdd.php";
		include "includes/funciones.php";
		if($conexion = crear_conexion())
		{
	?>
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
				<label for="titulo">Título</label>
				<input type="text" name="titulo" id="titulo"><br>
				<label for="detalle">Detalle</label>
				<textarea name="detalle" id="detalle" rows="5" cols="50"></textarea><br>
				<label for="fecha">Fecha</label>
				<input type="text" name="fecha" id="fecha" placeholder="dd-mm-aaaa"><br>
				<label for="foto">Foto</label>
				<input type="file" name="foto" id="foto"><br>
				<input type="submit" value="Añadir">
			</form>
			<br><a href="listado.php">Volver al listado</a>
	<?php
			if($_POST){
				if($_POST['titulo'] != '')
				{
					if(strlen($_POST['detalle']) >= 100)
					{
						if($_POST['fecha'] == '' || fecha_correcta($_POST['fecha']))
						{
							if($_POST['fecha'] == '')
								$fecha = date("Y-m-d");
							else
								$fecha = convertir_fecha($_POST['fecha']);
							//si se relleno el campo foto
							if($_FILES["foto"]["name"] != "")
							{
								//si la foto seleccionada es de tipo jpeg o gif o png y su tamaño es menor o igual a 100kb
								if(($_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/gif" || $_FILES['foto']['type'] == "image/png") && ($_FILES['foto']['size'] <= 102400))
								{
									//subimos la foto al servidor
									if($respuesta = move_uploaded_file($_FILES["foto"]["tmp_name"], "images/".$_FILES["foto"]["name"]))
									{
										if($noticia = consulta_bbdd($conexion, "insert into noticia (titulo, detalle, fecha, foto) values ('".$_POST['titulo']."','".$_POST['detalle']."','".$fecha."','images/".$_FILES["foto"]["name"]."')"))
											echo "<br><br>Noticia añadida correctamente";
										else
											echo "<br><br>Error al insertar la noticia";	
									}
									else
										echo "Error al guardar la foto";
								}
								else
									echo "<br><br>¡Error! la foto debe tener una extensión jpg, gif o png y no debe de exceder de 100kb de tamaño";
							}
							else
							{
								if($noticia = consulta_bbdd($conexion, "insert into noticia (titulo, detalle, fecha, foto) values ('".$_POST['titulo']."','".$_POST['detalle']."','".$fecha."', NULL)"))
									echo "<br><br>Noticia añadida correctamente";
								else
									echo "<br><br>Error al insertar la noticia";
							}
			
						}
						else
							echo "<br><br>¡Error! la fecha introducida no es correcta";
					}
					else
						echo "<br><br>¡Error! el campo detalle debe tener al menos 100 carácteres";
				}
				else
					echo "<br><br>¡Error! el campo título es requerido";
			}
			cerrar_conexion($conexion);
		}
		else
			echo 'Error de conexión a la base de datos';
	?>
</body>
</html>