<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar noticia</title>
</head>
<body>
	<?php
		if($_GET)
		{
			include "includes/conexion_bbdd.php";
			if($conexion = crear_conexion())
			{
				$noticia = consulta_bbdd($conexion, "select foto from noticia where id = ".$_GET["id_noticia"]);
				if($fila=mysqli_fetch_array($noticia))
				{
					if(consulta_bbdd($conexion, "delete from noticia where id = ".$_GET["id_noticia"]))
					{
						//eliminamos del servidor la foto
						unlink($fila["foto"]);	
						echo "Noticia borrada con éxito";
					}
					else
						echo "Error al eliminar la noticia";
				}
				else
					echo "Noticia no encontrada";
				cerrar_conexion($conexion);
			}
			else
				echo 'Error de conexión a la base de datos';	
		}
		else
			echo "Noticia no seleccionada";
	?>
	<br><br><a href="listado.php">Volver al listado</a>
</body>
</html>