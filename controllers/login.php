<?php 
require("../models/usuarios.class.php");

$objUtilidades=new utilidades;
$objUsuario=new usuario;
$con=$objUsuario->conexion();

switch($_REQUEST["accion"]){
	case 'loguear_user':
		$respuesta=$objUsuario->loguear_user($con,$_GET["usu"],$_GET["cla"]);
		if ($respuesta->num_rows>0)
		{
			$datos=$respuesta->fetch_assoc();
				if ($datos["status"]=='I')
				{
					echo 4; //Empleado inactivo
				}
				else
				{
					if ($datos["pass"]==$_GET["cla"])
					{
						echo 1; //Clave correcta
						session_start();
						$_SESSION["nombre"]=$datos["nombre"];
						
					}
					else
						echo 2; //Clave incorrecta
				}
		}
		else
			echo 3; //Empleado no existe
		$respuesta = 9;
		break;

}	

?>