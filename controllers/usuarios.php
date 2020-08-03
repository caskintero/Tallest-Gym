<?php
//require("../models/utilidades.class.php");
require("../models/usuarios.class.php");

$objUtilidades=new utilidades;
//$con=$objUtilidades->conexion();
$objUsuario=new usuario;
$con=$objUsuario->conexion();

switch($_REQUEST["accion"])
{	
	case 'agregar_usuario':
		
		$respuesta=$objUsuario->agregar_usuario($con,$_POST["user"],$_POST["pass"],$_POST["nombre"],$_POST["nivel"],$_POST["status"]);
		break;

	case 'editar_usuario':
		
		$respuesta=$objUsuario->editar_usuario($con,$_POST["user"],$_POST["pass"],$_POST["nombre"],$_POST["nivel"],$_POST["status"],$_POST["id_user"]);

		break;

	case 'eliminar_usuario':
		$respuesta=$objUsuario->eliminar_usuario($con,$_POST["id_usuario"]);
		break;

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
						$_SESSION["status"]=$datos["status"];
						$_SESSION["nivel"]=$datos["nivel"];
					}
					else
						echo 2; //Clave incorrecta
				}
		}
		else
			echo 3; //Empleado no existe
		$respuesta = 9;
		break;
		
		case 'buscar_usuario':
		$respuesta=$objUsuario->buscar_usuario($con,$_GET["user"]);
		break;

		default:
		$respuesta=$dbController->consultar($_POST['id_usuario'],$boton);
		break;
}
if ($respuesta==1)
{
?>
	
<?php
	header('Location: ../views/usuarios/index.php?mensaje=mensaje_exito');
	
}
elseif ($respuesta==0)
{
?>
	
<?php
	header('Location: ../views/usuarios/index.php?mensaje=mensaje_error');
}
?>
