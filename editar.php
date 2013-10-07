<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Editar Noticia</title>
</head>
<body>
	<header><h1>Editar</h1></header>
	<?php
		include "includes/conexion_bbdd.php";
		include "includes/funciones.php"; 
		if($_GET)
		{
			if($conexion = crear_conexion())
			{
				$noticia = consulta_bbdd($conexion, "select * from noticia where id = ".$_GET["id_noticia"]);
				if($fila=mysqli_fetch_array($noticia))
				{
	?>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $_GET["id_noticia"];?>">
						<label for="titulo">Título</label>
						<input type="text" name="titulo" id="titulo" value ="<?php echo $fila["titulo"];?>"><br>
						<label for="detalle">Detalle</label>
						<textarea name="detalle" id="detalle" rows="5" cols="50"><?php echo $fila["detalle"];?></textarea><br>
						<label for="fecha">Fecha</label>
						<input type="text" name="fecha" id="fecha" placeholder="dd-mm-aaaa" value="<?php echo convertir_fecha($fila["fecha"]);?>"><br>
						<label for="conservar_foto">Conservar foto</label>
						<input type="checkbox" name="conservar_foto"><br>
						<label for="foto">Foto</label>
						<input type="file" name="foto" id="foto"><br>
						<input type="submit" value="Editar">
					</form>
	<?php
				}
				else
					echo "Noticia no encontrada";
				cerrar_conexion($conexion);
			}
			else
				echo 'Error de conexión a la base de datos';	
		}
		else
		{
			if($_POST)
			{			
				if($conexion = crear_conexion())
				{
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
								//si seleccionamos que queriamos conservar la foto antigua
								if(isset($_POST["conservar_foto"]))
								{
									if($noticia = consulta_bbdd($conexion, "update noticia set titulo='".$_POST['titulo']."', detalle='".$_POST['detalle']."', fecha='".$fecha."' where id=".$_POST["id"]))
										echo "<br><br>Noticia modificada correctamente";
									else
										echo "<br><br>Error al modificar la noticia";
								}
								else
								{
									//si se relleno el campo foto
									if($_FILES["foto"]["name"] != "")
									{
										//si la foto seleccionada es de tipo jpeg o gif o png y su tamaño es menor o igual a 100kb
										if(($_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/gif" || $_FILES['foto']['type'] == "image/png") && ($_FILES['foto']['size'] <= 102400))
										{
											//subimos la foto al servidor
											if($respuesta = move_uploaded_file($_FILES["foto"]["tmp_name"], "images/".$_FILES["foto"]["name"]))
											{
												//una vez subida la foto al servidor eliminamos la anterior si existe
												$foto_antigua = consulta_bbdd($conexion, "select foto from noticia where id=".$_POST["id"]);
												if($fila=mysqli_fetch_array($foto_antigua))
												{
													if($fila["foto"] != NULL)
														unlink($fila["foto"]);
												}
												if($noticia = consulta_bbdd($conexion, "update noticia set titulo='".$_POST['titulo']."', detalle='".$_POST['detalle']."', fecha='".$fecha."', foto='images/".$_FILES["foto"]["name"]."' where id=".$_POST["id"]))
													echo "<br><br>Noticia modificada correctamente";
												else
													echo "<br><br>Error al modificar la noticia";	
											}
											else
												echo "Error al guardar la foto";
										}
										else
											echo "<br><br>¡Error! la foto debe tener una extensión jpg, gif o png y no debe de exceder de 100kb de tamaño";
									}
									else
									{
										//eliminamos la foto anterior si existe
										$foto_antigua = consulta_bbdd($conexion, "select foto from noticia where id=".$_POST["id"]);
										if($fila=mysqli_fetch_array($foto_antigua))
										{
											if($fila["foto"] != NULL)
												unlink($fila["foto"]);
										}
										if($noticia = consulta_bbdd($conexion, "update noticia set titulo='".$_POST['titulo']."', detalle='".$_POST['detalle']."', fecha='".$fecha."', foto=NULL where id=".$_POST["id"]))
											echo "<br><br>Noticia modificada correctamente";
										else
											echo "<br><br>Error al modificar la noticia";
									}
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
					cerrar_conexion($conexion);
				}
				else
					echo 'Error de conexión a la base de datos';
			}
			else
				echo "Noticia no seleccionada";
		}
			
	 ?>
	 <br><br><a href="listado.php">Volver al listado</a>
</body>
</html>