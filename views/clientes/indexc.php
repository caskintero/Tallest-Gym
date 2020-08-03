<?php
require("../../models/clientes.class.php");


$mensaje="";
if(isset($_GET['mensaje'])&&($_GET['mensaje']=='mensaje_error')) {
    $mensaje='<div class="alert alert-danger alert-dismissible fade show p-1" role="alert"> <p class="mensaje"><strong>Ups!</strong>, Lo siento, el Cliente no pudo ser procesado con exito.</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
  }
  if(isset($_GET['mensaje'])&&($_GET['mensaje']=='mensaje_exito')) {
   $mensaje='<div class="alert alert-success alert-dismissible fade show p-1" role="alert"> <p class="mensaje"><strong>Excelente!</strong>, El Cliente fue procesado con exito</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
  }

 ini_set('date.timezone','America/Caracas');
$fecha= date('d/m/Y',time());

$objUtilidades=new utilidades;
$objClientes=new cliente;
$con=$objUtilidades->conexion();
  

 
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Clientes</title>
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
  <button class="btn botones" type="button" data-toggle="modal" data-target="#AgregarProd">Agregar Cliente</button>
  <button class="btn botones" type="button" data-toggle="collapse" data-target="#listar" aria-expanded="true" aria-controls="listar">Listar Clientes</button>
  <a class="text-white" href="reporte_producto.php" target="_blank"><button class="btn botones" type="button" >Imprimir</button></a>
</p>
</div>

<?php echo $mensaje;
?>
  <div class="input-group mb-3 formulario">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Buscar</span>
  </div>
  
  <input type="text" class="form-control" placeholder="Caja de busqueda" name="caja_busquedac" id="caja_busquedac" >

</div>
  
  
  
 <div class="modal fade" id="AgregarProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h2 class="modal-title" id="exampleModalLabel">Agregar Cliente</h2>
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
      <form method="post" action="../../controllers/clientes.php" name="form_client" id="form_client">
      <input type="hidden" name="accion" value="agregar_clientes">
        <!--Inicio del input cedula  -->
        <div class="input-group mt-2 mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Cedula: </span>
          </div>
          <input type="text" class="form-control validanumericos" placeholder="Ingresar Cedula" aria-label="Cedula" maxlength="8" id="cedula" name="cedula"    onblur="buscar_cedula('1');">
        </div>
        <!--Cierre del input cedula -->
      <!--Inicio del input  Nombre del producto-->
       <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Nombre: </span>
        </div>
        <input type="text" class="form-control" id="nombre_client" name="nombre_client" placeholder="Ingrese el nombre del cliente" aria-label="Nombre">
      </div>
      <!--Cierre del input Nombre del producto-->
        <!--Cierre del input Nombre y apellido-->
        <!--Inicio del input  Telefono-->
         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Telefono: </span>
          </div>
          <input type="text" class="form-control validanumericos" id="telefono" name="telefono"  maxlength="11" placeholder="9999-9999999" aria-label="Telefono">
        </div>
        <!--Cierre del input Telefono-->
        <!--Inicio del input  Direccion-->
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Direccion </span>
          </div>
          <input type="text" class="form-control" id="direccion" name="direccion" >
        </div>

        <!--Cierre del input Direccion-->
         <!--Inicio del input  Fecha de nacimiento-->
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text" id="addon-wrapping">Fecha de nacimiento</span>
          </div>
          <input type="date" name="fecha_nac" id="fecha_nac" class="form-control" placeholder="Fecha nacimiento" aria-label="Fecha nacimiento" aria-describedby="addon-wrapping" data-validation="date" data-validation-format="yyyy/mm/dd">
        </div>

        <!--Cierre del input Fecha de nacimiento-->
         <!--Inicio del input  Fecha de registro-->
        <div class="input-group flex-nowrap mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Fecha de Registro: </span>
          </div>
         <div class="input-group date">
            <input type="text" class="form-control" id="fecha_reg" name="fecha_reg" value="<?=$fecha;?>" readonly="true"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
          </div>
        </div>

        <!--Cierre del input Fecha de registro-->
        
          <!--Inicio del select Status  -->
         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="status">Status: </label>
          </div>
          <select class="custom-select" id="status" name="status">
            <option selected>Seleccionar</option>
            <option value="A">Activo</option>
            <option value="I">Inactivo</option>
          </select>
        </div>
         <!--Cierre del select Status -->

       

        <div id="mensaje_yaexiste" class='mensaje_error'></div> <!-- Para mostrar el mensaje si el usuario ya existe -->
        <!--Cierre del select Status -->
       <div class="text-center m-4">
      <input class="btn btn-success justify-content-center" type="button" value="Aceptar" onClick="validarCliente()">
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
<div class="modal fade" id="ModalEliminarCLIENT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       
        <div class="modal-body">
        <form method="post" action="../../controllers/clientes.php" name="form_ok" id="form_ok">
           <input type="hidden" name="accion" value="eliminar_cliente">
           <h3 class="pt-2"> Esta seguro de eliminar este cliente?</h3>
           <hr class="bg-danger">
          <input type="hidden" name="id_cliente" id="id_cliente">
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
<div class="modal fade" id="ModalActualizarCLIENT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
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
    <form method="post" action="../../controllers/clientes.php" name="form_clientac" id="form_clientac">
      <input type="hidden" name="accion" value="editar_cliente">
      <input type="hidden" name="id_cliente" id="id_cliente">
      <!--Inicio del input codigo del producto  -->
      <!--Inicio del input cedula  -->
        <div class="input-group mt-2 mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Cedula: </span>
          </div>
          <input type="text" class="form-control validanumericos" placeholder="Ingresar Cedula" aria-label="Cedula" maxlength="8" id="cedula" name="cedula"    onblur="buscar_cedula('1');">
        </div>
        <!--Cierre del input cedula -->
      <!--Inicio del input  Nombre del producto-->
       <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Nombre: </span>
        </div>
        <input type="text" class="form-control" id="nombre_client" name="nombre_client" placeholder="Ingrese el nombre del cliente" aria-label="Nombre">
      </div>
      <!--Cierre del input Nombre del producto-->
        <!--Cierre del input Nombre y apellido-->
        <!--Inicio del input  Telefono-->
         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Telefono: </span>
          </div>
          <input type="text" class="form-control validanumericos" id="telefono" name="telefono"  maxlength="11" placeholder="9999-9999999" aria-label="Telefono">
        </div>
        <!--Cierre del input Telefono-->
        <!--Inicio del input  Direccion-->
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Direccion </span>
          </div>
          <input type="text" class="form-control" id="direccion" name="direccion" >
        </div>

        <!--Cierre del input Direccion-->
         <!--Inicio del input  Fecha de nacimiento-->
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text" id="addon-wrapping">Fecha de nacimiento</span>
          </div>
          <input type="date" name="fecha_nac" id="fecha_nac" class="form-control" placeholder="Fecha nacimiento" aria-label="Fecha nacimiento" aria-describedby="addon-wrapping" data-validation="date" data-validation-format="yyyy/mm/dd">
        </div>

        <!--Cierre del input Fecha de nacimiento-->
         <!--Inicio del input  Fecha de registro-->
        <div class="input-group flex-nowrap mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Fecha de Registro: </span>
          </div>
         <div class="input-group date">
            <input type="text" class="form-control" id="fecha_reg" name="fecha_reg" readonly="true"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
          </div>
        </div>

        <!--Cierre del input Fecha de registro-->
        
          <!--Inicio del select Status  -->
         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="status">Status: </label>
          </div>
          <select class="custom-select" id="status" name="status">
            <option selected>Seleccionar</option>
            <option value="A">Activo</option>
            <option value="I">Inactivo</option>
          </select>
        </div>
         <!--Cierre del select Status -->
         

<div id="mensaje_yaexiste" class='mensaje_error'></div> <!-- Para mostrar el mensaje si el usuario ya existe -->

    <div class="col-md-12 text-center m-4">
      <input class="btn btn-success justify-content-center" type="button" value="Aceptar" onClick="validarClienteAC()">
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
    <div id="datosc"></div>





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
<script type="text/javascript" src="../js/main.js"></script>
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
