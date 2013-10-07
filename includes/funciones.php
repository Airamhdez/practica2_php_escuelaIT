<?php
	/*funcion para convertir una fecha de formato
	 si $formato es dd-mm-aaaa la convierte a una fecha mysql (aaaa-mm-dd)
	 si $formato es mysql (aaaa-mm-dd) la convierte a una fecha tipo (dd-mm-aaaa)
	*/
	function convertir_fecha($fecha)
	{
			$fecha_convertida="";
			if($fecha!="")
			{
				$separar = preg_split ("/\-/", $fecha);		
				$fecha_convertida = $fecha_convertida.$separar[2].'-';
				$fecha_convertida = $fecha_convertida.$separar[1].'-';
				$fecha_convertida = $fecha_convertida.$separar[0];
	
			}
			return $fecha_convertida;
	}

	//funcion para comprobar si una fecha tiene el formato dd-mm-aaaa y es una fecha correcta
	function fecha_correcta($fecha)
	{
		$separar = preg_split ("/\-/", $fecha);
		if(count($separar) == 3)
			//la funcion checkdate recibe como parámetros los números de mes, día y año en ese orden
			return checkdate($separar[1],$separar[0],$separar[2]);
		else
			return false;
	}

?>