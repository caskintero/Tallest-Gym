<?php
require_once("utilidades.class.php");
class mensualidad extends utilidades
{
	function agregar_mensualidad($con,$id_cliente,$pago,$fecha_inicio,$fecha_final,$referencia)
	{
		$sql="insert into mensualidad(`id_cliente`,`pago`,`fecha_inicio`,`fecha_final`,`referencia`) VALUES 
				('$id_cliente','$pago','$fecha_inicio','$fecha_final','$referencia');";
		$ok=$con->query($sql);
		$sql2="insert into registros(`id_cliente`,`pago`,`fecha_inicio`,`fecha_final`,`referencia`) VALUES 
				('$id_cliente','$pago','$fecha_inicio','$fecha_final','$referencia');";
		$ok2=$con->query($sql2);
		if ($ok==true)
			return 1;
		else
			return 0;
	}
	function editar_mensualidad($con,$id_cliente,$pago,$fecha_inicio,$fecha_final,$referencia,$id_pago)
	{
		$sql="update mensualidad set id_cliente='$id_cliente',pago='$pago',fecha_inicio='$fecha_inicio',fecha_final='$fecha_final',referencia='$referencia' where id_pago=$id_pago;";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			return 1;
		else
			return 0;
	}
	function deudor($con,$id_pago,$valor)
	{
		$sql="update registros set pago='$valor' where id_pago=$id_pago;";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			return 1;
		else
			return 0;
	}


	function eliminar_mensualidad($con,$id_pago)
	{
		$sql="delete from mensualidad where id_pago='$id_pago'";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			return 1;
		else
			return 0;
	}
		function eliminar_registro($con,$id_pago)
	{
		$sql="delete from registros where id_pago='$id_pago'";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			return 1;
		else
			return 0;
	}

	//$Finalizado=$objMensualidad->eliminar_mensualidad($con,$mensualidad['pago']);

	function mostrar_mensualidad($con)
	{
		$sql="select *,clientes.nombre_client as nombre, clientes.cedula as cedula from mensualidad inner join clientes on mensualidad.id_cliente=clientes.id_cliente  ORDER BY `mensualidad`.`fecha_inicio` ASC";
		$ok=$con->query($sql);
		return $ok;
	}

	function mostrar_registros($con)
	{
		$sql="select *,clientes.nombre_client as nombre, clientes.cedula as cedula from registros inner join clientes on registros.id_cliente=clientes.id_cliente  ORDER BY `registros`.`fecha_inicio` ASC";
		$ok=$con->query($sql);
		return $ok;
	}




}
?>