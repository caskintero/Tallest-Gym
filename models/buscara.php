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

    $query = "SELECT *,clientes.nombre_client as nombre, clientes.cedula as cedula from asistencia inner join clientes on asistencia.id_cliente=clientes.id_cliente WHERE nombre_client NOT LIKE '' ORDER BY `asistencia`.`fecha_asistencia` DESC LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT *,clientes.nombre_client as nombre, clientes.cedula as cedula from asistencia inner join clientes on asistencia.id_cliente=clientes.id_cliente WHERE nombre_client LIKE '%$q%' OR cedula LIKE '%$q%' ORDER BY `asistencia`.`fecha_asistencia` DESC";


    }

    $resultado = $conn->query($query);
    $nivel=$_POST['nivel'];
    if ($resultado->num_rows>0) {


    	$salida.="<table class='table'>
    			<thead class='thead-dark'>
                   <tr>
                      <th scope='col align-items-center'>Datos de los Clientes</th>
                    </tr>

                      <tr>
                        <th scope='col'>Dia</th>
                        <th scope='col'>Cedula</th>
                        <th scope='col'>Nombre</th>";
                        if ($nivel=='Administrador') {
                           $salida.="<th scope='col'>EDITAR</th>
                            <th scope='col'>BORRAR</th>";
                        }
                        
    				
        $salida.="
    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					
    					<td>".$fila['fecha_asistencia']."</td>
    					<td>".$fila['cedula']."</td>
    					<td>".$fila['nombre']."</td>";
                            
                        if ($nivel=='Administrador') {
                            $salida.="
                                 <td align='center'><button type='button' class='btn  ' data-toggle='modal' data-target='#ModalActualizarASIST' data-id1='".$fila['id_asistencia']."' data-id2='".$fila['id_cliente']."' data-nombre='".$fila['nombre']."' data-fecha='".$fila['fecha_asistencia']."'><img src='../images/editar.png'></button></td>

                                 <td align='center'> <button type='button' class='btn' data-toggle='modal' data-target='#ModalEliminarASIST' data-id='".$fila['id_asistencia']."' data-nombre='".$fila['nombre_client']."' data-fecha='".$fila['fecha_asistencia']."' ><img src='../images/borrar.png'></button></td>
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