<?php
require_once("utilidades.class.php");
class cliente extends utilidades
{
	function agregar_clientes($con,$cedula,$nombre,$telefono,$direccion,$fecha_nac,$fecha_reg,$status)
	{
		$sql="insert into clientes(`cedula`, `nombre_client`, `telefono`,`direccion`, `fecha_nac`, `fecha_reg`,`status`) VALUES 
				('$cedula','$nombre','$telefono','$direccion','$fecha_nac','$fecha_reg','$status');";
		$ok=$con->query($sql);
		if ($ok==true)
			return 1;
		else
			return 0;
	}
	function editar_cliente($con,$cedula,$nombre,$telefono,$direccion,$fecha_nac,$fecha_reg,$status,$id_cliente)
	{
		$sql="update clientes set cedula='$cedula',nombre_client='$nombre',telefono='$telefono',direccion='$direccion',fecha_nac='$fecha_nac',fecha_reg='$fecha_reg' ,status='$status' where id_cliente=$id_cliente;";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			return 1;
		else
			return 0;
	}
	function eliminar_cliente($con,$id_cliente)
	{
		$sql="delete from clientes where id_cliente='$id_cliente'";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			return 1;
		else
			return 0;
	}
	

	function mostrar_clientes($con)
	{
		$sql="select * from clientes;";
		$ok=$con->query($sql);
		return $ok;
	}

	function buscar_producto($con,$codigo_producto)
	{
		$sql="select * from producto where codigo_producto='$codigo_producto';";
		$ok=$con->query($sql);
		$datos=$ok->fetch_assoc();
		if ($datos["nombre_producto"]=="")
			echo 0;//"Producto no encontrado##";
		else
			echo $datos["codigo_producto"]."#".$datos["nombre_producto"]."#".$datos["unidad_medida"]."#".$datos["id_producto"];
		return 9;
	}

	function buscar_cedula($con,$cedula)
	{
		$sql="select * from clientes where cedula='$cedula';";
		$ok=$con->query($sql);
		$datos=$ok->fetch_assoc();
		if ($datos["nombre_client"]=="")
			echo 0;//"Usuario no encontrado##";
		else
			echo $datos["nombre_client"]."#".$datos["id_cliente"];
		return 9;
	}

}
?>