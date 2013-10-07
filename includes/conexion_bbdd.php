<?php
	function crear_conexion()
	{
		return $conexion = mysqli_connect("localhost", "root", "", "practica2cursophp");
	}

	function cerrar_conexion($conexion)
	{
		return mysqli_close($conexion);
	}

	function consulta_bbdd($conexion, $consulta)
	{
		return mysqli_query($conexion,$consulta);	
	}
?>