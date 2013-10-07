<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalles de la noticia</title>
</head>
<body>
	<header><h1>Detalles de la noticia</h1></header>
	<?php
		if($_GET)
		{
			include "includes/conexion_bbdd.php";
			include "includes/funciones.php";
			if($conexion = crear_conexion())
			{
				$noticia = consulta_bbdd($conexion, "select * from noticia where id = ".$_GET["id_noticia"]);
				if($fila=mysqli_fetch_array($noticia))
				{
					echo "Título: ".$fila["titulo"]."<br>";
					echo "Detalle:<br> <textarea name='detalle' id='detalle' rows='5' cols='50' readonly>".$fila["detalle"]."</textarea><br>";
					echo "Fecha: ".convertir_fecha($fila["fecha"])."<br>";
					if($fila["foto"] != NULL)
						echo "Foto: <img src='".$fila["foto"]."' alt='Foto noticia' width='60px'>";
					else
						echo "Foto:";
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