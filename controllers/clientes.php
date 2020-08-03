<?php
require("../models/clientes.class.php");

$objUtilidades=new utilidades;
$objCliente=new cliente;
$con=$objCliente->conexion();

switch($_REQUEST["accion"])
{	
	case 'agregar_clientes':
		$fec_reg=$objUtilidades->voltearFecha($_POST["fecha_reg"]); //Recordar que la fecha viene en formato dd/mm/aaaa
		$fec_nac=$objUtilidades->voltearFecha($_POST["fecha_nac"]); //Recordar que la fecha viene en formato dd/mm/aaaa
		$respuesta=$objCliente->agregar_clientes($con,$_POST["cedula"],$_POST["nombre_client"],$_POST["telefono"],$_POST["direccion"],$fec_nac,$fec_reg,$_POST["status"]);
		break;


	case 'editar_cliente':


		$fec_nac=$objUtilidades->voltearFecha($_POST["fecha_nac"]); //Recordar que la fecha viene en formato dd/mm/aaaa
		$respuesta=$objCliente->editar_cliente($con,$_POST["cedula"],$_POST["nombre_client"],$_POST["telefono"],$_POST["direccion"],$fec_nac,$_POST["fecha_reg"],$_POST["status"],$_POST["id_cliente"]);

		break;

	case 'eliminar_cliente':
		$respuesta=$objCliente->eliminar_cliente($con,$_POST["id_cliente"]);
		break;

		case 'buscar_cedula':
		$respuesta=$objCliente->buscar_cedula($con,$_GET["ced"]);
		break;

		case 'buscar_producto':
		$respuesta=$objCliente->buscar_producto($con,$_GET["prod"]);
		break;
}
if ($respuesta==1)
{
?>

<?php
	header('Location: ../views/clientes/indexc.php?mensaje=mensaje_exito');
}
elseif ($respuesta==0)
{
?>
	
<?php
	header('Location: ../views/clientes/indexc.php?mensaje=mensaje_error');
}
?>