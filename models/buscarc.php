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

    $query = "SELECT * FROM clientes WHERE nombre_client NOT LIKE '' ORDER By id_cliente LIMIT 25";

    if (isset($_POST['consulta'])) {
    	$q = $conn->real_escape_string($_POST['consulta']);
    	$query = "SELECT * FROM clientes WHERE id_cliente LIKE '%$q%' OR nombre_client LIKE '%$q%' OR cedula LIKE '%$q%' OR status LIKE '%$q%' OR telefono LIKE '%$q%' ";
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
                        <th scope='col'>Cedula</th>
                        <th scope='col'>Nombre</th>
                        <th scope='col'>Telefono</th>
                        <th scope='col'>Status</th>";
                        if ($nivel=='Administrador') {
                           $salida.="<th scope='col'>EDITAR</th>
                        <th scope='col'>BORRAR</th>";
                        }
                        
    				
        $salida.="
    			</thead>
    			

    	<tbody>";

    	while ($fila = $resultado->fetch_assoc()) {
    		$salida.="<tr>
    					
    					<td>".$fila['cedula']."</td>
    					<td>".$fila['nombre_client']."</td>
    					<td>".$fila['telefono']."</td>
    					<td>".$fila['status']."</td>";
                            
                        if ($nivel=='Administrador') {
                            $salida.="
                                 <td align='center'><button type='button' class='btn  ' data-toggle='modal' data-target='#ModalActualizarCLIENT' data-cedula='".$fila['cedula']."' data-id='".$fila['id_cliente']."' data-nombre='".$fila['nombre_client']."' data-telefono='".$fila['telefono']."' data-dir='".$fila['direccion']."' data-fechan='".$fila['fecha_nac']."' data-fechar='".$fila['fecha_reg']."' data-status='".$fila['status']."'><img src='../images/editar.png'></button></td>

                                 <td align='center'> <button type='button' class='btn' data-toggle='modal' data-target='#ModalEliminarCLIENT' data-id='".$fila['id_cliente']."' data-nombre='".$fila['nombre_client']."' ><img src='../images/borrar.png'></button></td>
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