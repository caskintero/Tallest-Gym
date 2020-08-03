<?php
require("../models/asistencia.class.php");

$objUtilidades=new utilidades;
$objAsistencia=new asistencia;
$con=$objAsistencia->conexion();

switch($_REQUEST["accion"])
{	
	case 'agregar_asistencia':
		
		$respuesta=$objAsistencia->agregar_asistencia($con,$_POST["id_cliente"],$_POST["fecha_asistencia"]);
		break;


	case 'editar_asistencia':

		//$fec_nac=$objUtilidades->voltearFecha($_POST["fecha_nac"]); //Recordar que la fecha viene en formato dd/mm/aaaa
		$respuesta=$objAsistencia->editar_asistencia($con,$_POST["id_cliente"],$_POST["fecha_asistencia"],$_POST["id_asistencia"]);

		break;

	case 'eliminar_asistencia':
		$respuesta=$objAsistencia->eliminar_asistencia($con,$_POST["id_asistencia"]);
		break;

		
}
if ($respuesta==1)
{
?>

<?php
	header('Location: ../views/asistencia/index.php?mensaje=mensaje_exito');
}
elseif ($respuesta==0)
{
?>
	
<?php
	header('Location: ../views/asistencia/index.php?mensaje=mensaje_error');
}
?>