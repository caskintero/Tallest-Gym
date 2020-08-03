<?php
require("../../models/asistencia.class.php");

$mensaje="";
if(isset($_GET['mensaje'])&&($_GET['mensaje']=='mensaje_error')) {
    $mensaje='<div class="alert alert-danger alert-dismissible fade show p-1" role="alert"> <p class="mensaje"><strong>Ups!</strong>, Lo siento, el Cliente no pudo ser procesado con exito.</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
  }
  if(isset($_GET['mensaje'])&&($_GET['mensaje']=='mensaje_exito')) {
   $mensaje='<div class="alert alert-success alert-dismissible fade show p-1" role="alert"> <p class="mensaje"><strong>Excelente!</strong>, El Cliente fue procesado con exito</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
  }

 ini_set('date.timezone','America/Caracas');
$fecha= date('Y/m/d',time());
/*
$fecha="2018-02-09";
$masCuatroSemanas = date ('d-m-Y', strtotime ('+ 4 week', strtotime($fecha2)));
*/
$objUtilidades=new utilidades;
$objAsistencia=new asistencia;
$con=$objUtilidades->conexion();

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Asistencia</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/estilos.css">
  
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
</head>
<body>

<?php 
  include("../menu/menu.php");
   echo  '<input type="hidden" name="nivel" id="nivel" value='.$nivel.'>';
  ?>
  <div class="text-center pt-5 pb-5 bg-light">
   <p>
  <button class="btn botones" type="button" data-toggle="modal" data-target="#AgregarASIST">Agregar Asistencia</button>
  <button class="btn botones" type="button" data-toggle="collapse" data-target="#listar" aria-expanded="true" aria-controls="listar">Listar Asistencia</button>
  <a class="text-white" href="reporte_asistencia.php" target="_blank"><button class="btn botones" type="button" >Imprimir</button></a>
</p>
</div>



  
  <?php echo $mensaje?>
  
    <div class="input-group mb-3 formulario">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Buscar</span>
  </div>
  
  <input type="text" class="form-control" placeholder="Caja de busqueda" name="caja_busquedaA" id="caja_busquedaA" >

</div>


 <div class="modal fade" id="AgregarASIST" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h2 class="modal-title" id="exampleModalLabel">Asistencia</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class=" mt-3">
      <p class="text-danger label pt-0 mt-0 text-center">* Todos los campos son Obligatorios * </p>
      </div>
      <!--fin de la cabezera -->
      <!-- Inicio del Formulario-->
      <form method="post" action="../../controllers/asistencia.php" name="form_asist" id="form_asist">
      <input type="hidden" name="accion" value="agregar_asistencia">
        <!--Inicio del input select cliente  -->
        <div class="input-group mt-2 mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Cliente: </span>
          </div>
            <select class="custom-select" id="id_cliente" name="id_cliente">
          <option value="">Seleccione</option>
          <?php
                $agregar=$objUtilidades->recuperar($con,"clientes");
                $agregar2=$objUtilidades->recuperar_mensualidad($con,"mensualidad");

                while ($clientes=mysqli_fetch_assoc($agregar))
                { 
                    $mensualidad=mysqli_fetch_assoc($agregar2);
                    if ( $mensualidad['pago']=="Cancelado") {
                        echo "<option value=".$mensualidad['id_cliente'].">".'Cedula: '.$mensualidad["cedula"].'&nbsp;|&nbsp; Nombre:'.$mensualidad['nombre_client']."</option>\n";
                    }
                    
                }
                ?>
        </select>
          
        </div>
        <!--Cierre del input select cliente -->

        <div class="input-group flex-nowrap mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Fecha de Asistencia: </span>
          </div>
         <div class="input-group date">
            <input type="text" class="form-control" id="fecha_asistencia" name="fecha_asistencia" value="<?=$fecha;?>" readonly="true"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
          </div>
        </div>

        

        <div id="mensaje_yaexiste" class='mensaje_error'></div> <!-- Para mostrar el mensaje si el usuario ya existe -->
        <!--Cierre del select Status -->
       <div class="text-center m-4">
      <input class="btn btn-success justify-content-center" type="button" value="Aceptar" onClick="validarAsistencia()">
      <input class="btn btn-danger justify-content-center mt-3 mb-3" type="button" value="Cancelar" data-dismiss="modal">
    </div>
        </form>
        
      </div>
      </div>
  
    </div>
  </div>




<div class="">
 
  <div class="">
    <div class="collapse multi-collapse show" id="listar">
      <div class="">
         
<!-- Modal Eliminar-->
<div class="modal fade" id="ModalEliminarASIST" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       
        <div class="modal-body">
        <form method="post" action="../../controllers/asistencia.php" name="form_ok" id="form_ok">
           <input type="hidden" name="accion" value="eliminar_asistencia">
           <h3 class="pt-2"> Esta seguro de eliminar esta Asistencia?</h3>
           <hr class="bg-danger">
          <input type="hidden" name="id_asistencia" id="id_asistencia">
          <div class=" text-center p-0">
            <input class="btn btn-success justify-content-center" type="button" value="Aceptar" onClick="validarok()">
            <input class="btn btn-danger justify-content-center mt-3 mb-3" type="button" value="Cancelar" data-dismiss="modal">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal eliminar cerrar-->

<!-- Modal Actualizar-->
<div class="modal fade" id="ModalActualizarASIST" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="datos_ajax"></div>
      <!--Inicio de la cabezera "Agregar Usuarios" -->
      <div class="align-items-center">
      <p class="text-danger small pt-0 mt-0 text-center">* Todos los campos son Obligatorios * </p>
      </div>
      
       <!-- Inicio del Formulario-->
    <form method="post" action="../../controllers/asistencia.php" name="form_asistAC" id="form_asistAC">
      <input type="hidden" name="accion" value="editar_asistencia">
      <input type="hidden" name="id_asistencia" id="id_asistencia">
      <!--Inicio del input codigo del producto  -->
       <!--Inicio del input select cliente  -->
        <div class="input-group mt-2 mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Cliente: </span>
          </div>
            <select class="custom-select" id="id_cliente" name="id_cliente">
          <option value="">Seleccione</option>
               <?php
                $agregar=$objUtilidades->recuperar($con,"clientes");
                $agregar2=$objUtilidades->recuperar_mensualidad($con,"mensualidad");

                while ($clientes=mysqli_fetch_assoc($agregar))
                { 
                    $mensualidad=mysqli_fetch_assoc($agregar2);
                    if ( $mensualidad['pago']=="Cancelado") {
                        echo "<option value=".$mensualidad['id_cliente'].">".'Cedula: '.$mensualidad["cedula"].'&nbsp;|&nbsp; Nombre:'.$mensualidad['nombre_client']."</option>\n";
                    }
                    
                }
                ?>

        </select>
          
        </div>
        <!--Cierre del input select cliente -->

        <div class="input-group flex-nowrap mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Fecha de Asistencia: </span>
          </div>
         <div class="input-group date">
            <input type="text" class="form-control" id="fecha_asistencia" name="fecha_asistencia" readonly="true"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
          </div>
        </div>

<div id="mensaje_yaexiste" class='mensaje_error'></div> <!-- Para mostrar el mensaje si el usuario ya existe -->

    <div class="col-md-12 text-center m-4">
      <input class="btn btn-success justify-content-center" type="button" value="Aceptar" onClick="validarAsistenciaAC()">
      <input class="btn btn-danger justify-content-center mt-3 mb-3" type="button" value="Cancelar" data-dismiss="modal">
    </div>
      </form>
      
    </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>



</div>


<!--///////////////// Tabla dinamica //////////////////////-->
    <div id="datosA"></div>


      


        </div>
      </div>
    </div>
  </div>
</div>
        


</div>

    </div>

  </div>
</body>
  <script type="text/javascript" src="../js/validaciones.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
 <!--Jquery UI-->
    <link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.structure.min.css">
    <link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.theme.min.css">
    <script type="text/javascript" src="../js/jquery-ui/jquery-ui.min.js"></script>
  <!--Moment js-->
    <script type="text/javascript" src="../js/moment.min.js"></script>
    <script type="text/javascript" src="../js/es.js"></script>
</html>
