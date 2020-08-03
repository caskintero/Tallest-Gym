<?php
require_once("utilidades.class.php");
class registro extends utilidades
{
	
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

	

	function mostrar_registros($con)
	{
		$sql="select *,clientes.nombre_client as nombre, clientes.cedula as cedula from registros inner join clientes on registros.id_cliente=clientes.id_cliente  ORDER BY `registros`.`fecha_inicio` ASC";
		$ok=$con->query($sql);
		return $ok;
	}




}
?>