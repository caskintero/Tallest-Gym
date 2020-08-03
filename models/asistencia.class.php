<?php
require_once("utilidades.class.php");
class asistencia extends utilidades
{
	function agregar_asistencia($con,$id_cliente,$fecha_asistencia)
	{
		$sql="insert into asistencia(`id_cliente`,`fecha_asistencia`) VALUES 
				('$id_cliente','$fecha_asistencia');";
		$ok=$con->query($sql);
		if ($ok==true)
			return 1;
		else
			return 0;
	}
	function editar_asistencia($con,$id_cliente,$fecha_asistencia,$id_asistencia)
	{
		$sql="update asistencia set id_cliente='$id_cliente',fecha_asistencia='$fecha_asistencia' where id_asistencia=$id_asistencia;";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			return 1;
		else
			return 0;
	}
	function eliminar_asistencia($con,$id_asistencia)
	{
		$sql="delete from asistencia where id_asistencia='$id_asistencia'";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			return 1;
		else
			return 0;
	}
	

	function mostrar_asistencia($con)
	{
		$sql="select *,clientes.nombre_client as nombre, clientes.cedula as cedula from asistencia inner join clientes on asistencia.id_cliente=clientes.id_cliente  ORDER BY `asistencia`.`fecha_asistencia` DESC";
		$ok=$con->query($sql);
		return $ok;
	}




}
?>