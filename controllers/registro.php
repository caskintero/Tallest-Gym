<?php
require("../models/registro.class.php");

$objUtilidades=new utilidades;
$objRegistro=new registro;
$con=$objRegistro->conexion();

switch($_REQUEST["accion"])
{	
	

		case 'eliminar_registro':
		$respuesta=$objRegistro->eliminar_registro($con,$_POST["id_pago"]);
		break;

		
}
if ($respuesta==1)
{
?>

<?php
	header('Location: ../views/registros/index.php?mensaje=mensaje_exito');
}
elseif ($respuesta==0)
{
?>
	
<?php
	header('Location: ../views/registros/index.php?mensaje=mensaje_error');
}
?>