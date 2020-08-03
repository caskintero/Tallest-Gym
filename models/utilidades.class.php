<?php
class utilidades
{
	function conexion()
	{
		$con=new mysqli("localhost","root","","tallestgym");
		if ($con->connect_errno)
		{
		    echo "Fallo al conectar al servidor: (" . $con->connect_errno . ") " . $con->connect_error;
		}		
		else		
			return $con;
	}

	function buscar($con,$tabla,$columna,$valor)
	{
		$sql="select * from $tabla where $columna='$valor'";
		$ok=$con->query($sql);
		return $ok;
	}

	function recuperar($con,$tabla)
	{
		$sql="select * from $tabla";
		$ok=$con->query($sql);
		return $ok;
	}

	function select_comunidad($con)
	{
		$sql="SELECT * from clientes WHERE clientes.id_cliente NOT IN (SELECT id_cliente FROM mensualidad)";
		$ok=$con->query($sql);
		return $ok;
	}

	function recuperar_registros($con)
	{
		$sql="select *,clientes.nombre_client as nombre, clientes.cedula as cedula from registros inner join clientes on registros.id_cliente=clientes.id_cliente";
		$ok=$con->query($sql);
		return $ok;
	}

	function recuperar_mensualidad($con)
	{
		$sql="select *,clientes.nombre_client as nombre, clientes.cedula as cedula from mensualidad inner join clientes on mensualidad.id_cliente=clientes.id_cliente";
		$ok=$con->query($sql);
		return $ok;
	}
		
	function voltearFecha($fecha)
	{
		$fechareves=substr($fecha,6,4).'-'.substr($fecha,3,2).'-'.substr($fecha,0,2);
		return $fechareves;
	}
}
?>