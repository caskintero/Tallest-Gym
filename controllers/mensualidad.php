<?php
require("../models/mensualidad.class.php");

$objUtilidades=new utilidades;
$objMensualidad=new mensualidad;
$con=$objMensualidad->conexion();

switch($_REQUEST["accion"])
{	
	case 'agregar_mensualidad':
		
		$fecha_inicio=$objUtilidades->voltearFecha($_POST["fecha_inicio"]); //Recordar que la fecha viene en formato dd/mm/aaaa+
		$fecha_final=$objUtilidades->voltearFecha($_POST["fecha_final"]); //Recordar que la fecha viene en formato dd/mm/aaaa
		$respuesta=$objMensualidad->agregar_mensualidad($con,$_POST["id_cliente"],$_POST["pago"],$fecha_inicio,$fecha_final,$_POST["referencia"]);
		break;


	case 'editar_mensualidad':

		//$fec_nac=$objUtilidades->voltearFecha($_POST["fecha_nac"]); //Recordar que la fecha viene en formato dd/mm/aaaa
		$respuesta=$objMensualidad->editar_mensualidad($con,$_POST["id_cliente"],$_POST["pago"],$_POST["fecha_inicio"],$_POST["fecha_final"],$_POST["referencia"],$_POST["id_pago"]);

		break;

	case 'eliminar_mensualidad':
		$respuesta=$objMensualidad->eliminar_mensualidad($con,$_POST["id_pago"]);
		break;

		case 'eliminar_registro':
		$respuesta=$objMensualidad->eliminar_registro($con,$_POST["id_pago"]);
		break;

		
}
if ($respuesta==1)
{
?>

<?php
	header('Location: ../views/mensualidad/index.php?mensaje=mensaje_exito');
}
elseif ($respuesta==0)
{
?>
	
<?php
	header('Location: ../views/mensualidad/index.php?mensaje=mensaje_error');
}
?>