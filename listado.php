<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listado de noticias</title>
</head>
<body>
	<header><h1>Listado de noticias</h1></header>
	<?php
		include "includes/conexion_bbdd.php";
		if($conexion = crear_conexion())
		{
	?>
			<table border=1>
			<tr>
				<td><strong>Ver</strong></td><td><strong>Editar</strong></td><td><strong>Eliminar</strong></td><td><strong>Título</strong></td>
			</tr>
	<?php
			$noticias = consulta_bbdd($conexion, "select id, titulo from noticia");
			while($fila=mysqli_fetch_array($noticias))
			{
				echo '<tr>';
				echo "<td><a href='ver.php?id_noticia=".$fila["id"]."'>Ver</a></td>";
				echo "<td><a href='editar.php?id_noticia=".$fila["id"]."'>Editar</a></td>";
	?>
				<td><a href="eliminar.php?id_noticia=<?php echo $fila["id"]?>" onclick="if (!confirm('seguro que quieres borrarlo?')) return false">Eliminar</a></td>
	<?php			
				echo '<td>'.$fila['titulo'].'</td>';
				echo '</tr>';
			}
	?>
			</table><br>
			<input type="button" value="Añadir noticia" onclick="window.location='addNoticia.php';">
	<?php
			cerrar_conexion($conexion);
		}
		else
			echo 'Error de conexión a la base de datos';
	?>
</body>
</html>