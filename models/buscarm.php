<?php
	$servername = "localhost";
    $username = "root";
  	$password = "";
  	$dbname = "tallestgym";

	$conn = new mysqli($servername, $username, $password, $dbname);
      if($conn->connect_error){
        die("Conexión fallida: ".$conn->connect_error);
      }

    $salida = "";

    $query = "SELECT *,clientes.nombre_client as nombre, clientes.cedula as cedula from mensualidad inner join clientes on mensualidad.id_cliente=clientes.id_cliente  WHERE  nombre_client NOT LIKE ''  ORDER BY `mensualidad`.`fecha_inicio` DESC LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT *,clientes.nombre_client as nombre, clientes.cedula as cedula from mensualidad inner join clientes on mensualidad.id_cliente=clientes.id_cliente  WHERE  nombre_client LIKE '%$q%'  OR cedula LIKE '%$q%' OR referencia LIKE '%$q%' ORDER BY `mensualidad`.`fecha_inicio` DESC ";
    }

    $resultado = $conn->query($query);
    $nivel=$_POST['nivel'];
    if ($resultado->num_rows>0) {


    	$salida.="<table class='table'>
    			<thead class='thead-dark'>
                   <tr>
                      <th scope='col align-items-center'>Mensualidad</th>
                    </tr>

                      <tr>
                      <th scope='col'>Fecha Inicio</th>
                        <th scope='col'>Fecha Final</th>
                        <th scope='col'>Cedula</th>
                        <th scope='col'>Nombre</th>
                        <th scope='col'>Pago</th>
                        <th scope='col'>Referencia</th>";

                        if ($nivel=='Administrador') {
                           $salida.="
                            <th scope='col'>BORRAR</th>";
                        }
                        
    				
        $salida.="
    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					
                        <td>".$fila['fecha_inicio']."</td>
                        <td>".$fila['fecha_final']."</td>
    					<td>".$fila['cedula']."</td>
    					<td>".$fila['nombre_client']."</td>
    					<td>".$fila['pago']."</td>
    					<td>".$fila['referencia']."</td>";
                            
                        if ($nivel=='Administrador') {
                            $salida.="
                                

                                 <td align='center'> <button type='button' class='btn' data-toggle='modal' data-target='#ModalEliminarPAGO' data-id='".$fila['id_pago']."' data-nombre='".$fila['nombre']."' data-fecha='".$fila['fecha_inicio']."' ><img src='../images/borrar.png'></button></td>
                                    ";
                        }

                       
                $salida.="
    				</tr>";

    	}
    	$salida.="</tbody></table>";
    }else{
    	$salida.="NO HAY DATOS :(";
    }


    echo $salida;

    $conn->close();



?>