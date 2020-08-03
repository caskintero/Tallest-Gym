<?php
require_once("utilidades.class.php");
class usuario extends utilidades
{
	function agregar_usuario($con,$user,$pass,$nombre,$nivel,$status)
	{
		$sql="insert into usuarios(`user`, `pass`, `nombre`, `nivel`, `status`) VALUES 
				('$user','$pass','$nombre','$nivel','$status');";
		$ok=$con->query($sql);
		if ($ok==true)
			return 1;
		else
			return 0;
	}
	function editar_usuario($con,$user,$pass,$nombre,$nivel,$status,$id_usuario)
	{
		$sql="update usuarios set user='$user',pass='$pass',nombre='$nombre',nivel='$nivel',status='$status' where id_user=$id_usuario;";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			return 1;
		else
			return 0;
	}
	function eliminar_usuario($con,$id_usuario)
	{
		$sql="delete from usuario where id_usuario='$id_usuario'";
		$ok=$con->query($sql);
		$afectadas=$con->affected_rows;
		if ($afectadas>0)
			return 1;
		else
			return 0;
	}
	
	function loguear_user($con,$usuario,$clave)
	{
		$sql="select * from usuarios where user='$usuario'";
		$ok=$con->query($sql);
		
		return $ok;
	}

	function mostrar_usuarios($con)
	{
		$sql="select * from usuarios;";
		$ok=$con->query($sql);
		return $ok;
	}

	
	function buscar_usuario($con,$user)
	{
		$sql="select nombre id_user from usuarios where user='$user';";
		$ok=$con->query($sql);
		$datos=$ok->fetch_assoc();
		if ($datos["nombre"]=="")
			echo 0;//"Usuario no encontrado##";
		else
			echo $datos["nombre"]."#".$datos["id_usuario"];
		return 9;
	}

}
?>