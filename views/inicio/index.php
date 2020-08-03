<?php
require("../../models/usuarios.class.php");
require("../../models/clientes.class.php");
require("../../models/mensualidad.class.php");
$objUtilidades=new utilidades;
 $net=$objUtilidades->conexion();
 //usuarios
$objUsuario=new usuario;
  $ok1=$objUsuario->mostrar_usuarios($net);
  $total_user=mysqli_num_rows($ok1);
$con=$objUtilidades->conexion();
  /*===============================
  Calcular cuantos departamentos existen.
===========================*/
  $objClientes= new cliente;
  $ok3=$objClientes->mostrar_clientes($net);
  $total_clientes=mysqli_num_rows($ok3);

 


  $objMensualidad=new mensualidad;


?>


<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/Chart.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
</head>
<body>
<?php 
  require("../menu/menu.php");
  ?>
<div class="pt-5">
	<h3 class="text-center tittles text-info pb-5" style="font-weight: bold;">Notificaciones</h3>
      <!-- Tiles -->
      <?php 

      	if ($nivel=='Administrador') {
      		echo '
      <article class="full-width tile">
        <div class="tile-text">
          <span class="text-condensedLight">
           '.$total_user.'<br>
            <small>Usuarios</small>
          </span>
        </div>
        <i class="zmdi zmdi-account tile-icon"></i>
      </article>';
      	}
      
      ?>
      
      <article class="full-width tile">
        <div class="tile-text">
          <span class="text-condensedLight">
             <?=$total_clientes?><br>
            <small>Clientes</small>
          </span>
        </div>
        <i class="zmdi zmdi-accounts tile-icon"></i>
      </article>
     	<div>

       <table class="table table-hover" style="">
        <thead class="thead-dark">
        	<tr>
          <th class="text-center" colspan="6">Mensualidad</th>
        </tr>
          <tr>
          	<th scope="col" class="text-center">Cedula</th>
            <th scope="col" class="text-center">Nombre</th>
            <th scope="col" class="text-center">Fecha de inicio</th>
            <th scope="col" class="text-center">Fecha Final</th>
           	<th scope="col" class="text-center">Se vence</th>
           	<th scope="col" class="text-center">Referencia</th>
           
          </tr>
        </thead>
<?php 
	
	$agregar=$objUtilidades->recuperar($con,"clientes");
   	$agregar2=$objUtilidades->recuperar_mensualidad($con);
   	$agregar3=$objUtilidades->recuperar_registros($con);
	$fecha_actual = new DateTime(date('Y-m-d'));

		while ($clientes=mysqli_fetch_array($agregar)) {
			
			echo "<tbody>";

		while ($mensualidad=mysqli_fetch_array($agregar2)) {
			
				

			if ($mensualidad['pago']=="Cancelado" ) {
				$id_cliente=[$mensualidad['id_cliente']];
				$fecha_final = new DateTime($mensualidad['fecha_final']);
		    	$dias = $fecha_actual->diff($fecha_final)->format('%r%a');	
				 // Si la fecha final es igual a la fecha actual o anterior

		    if ($dias <= 0) {
		    			
		    			
		    			$id_pago=$mensualidad['id_pago'];
		    			$Finalizado=$objMensualidad->eliminar_mensualidad($con,$id_pago);

		    			$Deudor=$objMensualidad->deudor($con,$id_pago,'Finalizado');

		    } if ($dias <= 5 && $dias>1) {
		    		 	echo "<tr>";
						echo "<td class='text-center green'>".$mensualidad['cedula']."</td>";
						echo "<td class='text-center green'>".$mensualidad['nombre_client']."</td>";
						echo "<td class='text-center green'>".$mensualidad['fecha_inicio']."</td>";  
					    echo "<td class='text-center green'>".$mensualidad['fecha_final']."</td>";
		        		echo '<td class="text-center green">Está a ' . ($dias) . ' días de vencer</td>';
		        		echo "<td class='text-center green'>".$mensualidad['referencia']."</td>";
		   				echo "</tr>";
		    }
		    if ($dias == 1) {
		    		 	echo "<tr>";
						echo "<td class='text-center green'>".$mensualidad['cedula']."</td>";
						echo "<td class='text-center green'>".$mensualidad['nombre_client']."</td>";
						echo "<td class='text-center green'>".$mensualidad['fecha_inicio']."</td>";  
					    echo "<td class='text-center green'>".$mensualidad['fecha_final']."</td>";
		        		echo '<td class="text-center green">Está a ' . ($dias) . ' día de vencer</td>';
		        		echo "<td class='text-center green'>".$mensualidad['referencia']."</td>";
		   				echo "</tr>";
		    }


			}
			

		}
			
			
			while ($registros=mysqli_fetch_array($agregar3)) {
				
				
				if ($registros['pago']=="Finalizado") {
				
				
				
		    	$fecha_final = new DateTime($registros['fecha_final']);
		    	$dias = $fecha_actual->diff($fecha_final)->format('%r%a');


		    // Si la fecha final es igual a la fecha actual o anterior
		   
		   
		    if ($dias == 0) {
		    	echo "<tr>";
		    	
		    	echo "<td class='text-center red'>".$registros['cedula']."</td>";
				echo "<td class='text-center red'>".$registros['nombre_client']."</td>";
				echo "<td class='text-center red'>".$registros['fecha_inicio']."</td>";  
		    	echo "<td class='text-center red'>".$registros['fecha_final']."</td>";
		        echo "<td class='text-center red' >Mensualidad vencida Hoy</td>";
		        echo "<td class='text-center red'>".$registros['referencia']."</td>";
		        echo "</tr>";
		    }
		    
				}
			

			}
			


		    
		    echo "</tbody>";

		
	    
	}


		?>
	</table>

	</div>
</body>
  <script src="../js/main.js" ></script>
  <script src="../js/material.min.js" ></script>
   <script type="text/javascript" src="../js/validaciones.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
<script language="javascript" type="text/javascript"></script>
</html>
