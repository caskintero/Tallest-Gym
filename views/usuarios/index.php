<?php
require("../../models/usuarios.class.php");

$mensaje="";
if(isset($_GET['mensaje'])&&($_GET['mensaje']=='mensaje_error')) {
    $mensaje='<div class="alert alert-danger alert-dismissible fade show p-1" role="alert"> <p class="mensaje"><strong>Ups!</strong>, Lo siento, el usuario no pudo ser procesado con exito.</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
  }
  if(isset($_GET['mensaje'])&&($_GET['mensaje']=='mensaje_exito')) {
   $mensaje='<div class="alert alert-success alert-dismissible fade show p-1" role="alert"> <p class="mensaje"><strong>Excelente!</strong>, El usuario fue procesado con exito</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
  }

 ini_set('date.timezone','America/Caracas');
$fecha= date('d/m/Y',time());


$objUtilidades=new utilidades;
$objUsuario=new usuario;
$con=$objUtilidades->conexion();

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Usuarios</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/estilos.css">
  
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
</head>
<body>

<?php 
  include("../menu/menu.php");

  ?>
  <div class="text-center pt-5 pb-5 bg-light">
   <p>
  <button class="btn botones" type="button" data-toggle="modal" data-target="#AgregarUser">Agregar Usuarios</button>
  <button class="btn botones" type="button" data-toggle="collapse" data-target="#listar" aria-expanded="true" aria-controls="listar">Listar Usuarios</button>
  <a class="text-white" href="reporte_usuario.php" target="_blank"><button class="btn botones" type="button" >Imprimir</button></a>
</p>
</div>


  
  <?php echo $mensaje?>
  
   
   

 <div class="modal fade" id="AgregarUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h2 class="modal-title" id="exampleModalLabel">Agregar Usuario</h2>
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
      <form method="post" action="../../controllers/usuarios.php" name="form_usu" id="form_usu">
        <input type="hidden" name="accion" value="agregar_usuario">
       <!--Inicio del input  Usuario-->
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Usuario: </span>
          </div>
          <input type="text" class="form-control" id="user" name="user" placeholder="Ingresar Usuario" aria-label="Usuario" onblur="buscar_user('1');">
        </div>
        <!--Cierre del input Usuario-->
        <!--Inicio del input  Contraseña-->
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Contraseña: </span>
          </div>
          <input type="password" class="form-control" id="pass" name="pass" placeholder="Ingresar Contraseña" aria-label="Contraseña">
        </div>
        <!--Cierre del input Contraseña-->
        <!--Inicio del input  nombre-->
         <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Nombre: </span>
          </div>
          <input type="text" class="form-control" id="nombre" name="nombre"  maxlength="11" placeholder="Ingresar Nombre" aria-label="Telefono">
        </div>
        <!--Cierre del input nombre-->
           <!--Inicio del select Nivel  -->
       <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="status">Nivel: </label>
        </div>
        <select class="custom-select" id="nivel" name="nivel" >
          <option selected>Seleccionar</option>
          <option value="1">Administrador</option>
          <option value="2">Moderador</option>
        </select>
      </div>

        
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
       
       <div class="text-center m-4">
      <input class="btn btn-success justify-content-center" type="button" value="Aceptar" onClick="validarUsuario()">
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
<div class="modal fade" id="ModalEliminarUS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       
        <div class="modal-body">
        <form method="post" action="../../controllers/usuarios.php" name="form_ok" id="form_ok">
           <input type="hidden" name="accion" value="eliminar_usuario">
           <h3 class="pt-2"> Esta seguro de eliminar este usuario?</h3>
           <hr class="bg-danger">
          <input type="hidden" name="id_user" id="id_user">
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
<div class="modal fade" id="ModalActualizarUS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
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
      <!--fin de la cabezera -->
      <!-- Inicio del Formulario-->
    <form method="post" action="../../controllers/usuarios.php" name="form_usuac" id="form_usuac">
      <input type="hidden" name="accion" value="editar_usuario">
    <input type="hidden" id="id_user" name="id_user">
      
     
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Usuario: </span>
        </div>
        <input type="text" class="form-control" id="user" name="user" placeholder="Ingresar Usuario" aria-label="Usuario" aria-describedby="basic-addon1">
      </div>
      <!--Cierre del input Usuario-->
      <!--Inicio del input  Contraseña-->
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Contraseña: </span>
        </div>
        <input type="password" class="form-control" id="pass" name="pass" placeholder="Ingresar Contraseña" aria-label="Contraseña" aria-describedby="basic-addon1">
      </div>
      <!--Cierre del input Contraseña-->
      <!--Inicio del input nombre -->
      <div class="input-group mt-3 mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Nombre: </span>
        </div>
        <input type="text" class="form-control validanumericos" placeholder="Ingresar nombre" aria-label="nombre" aria-describedby="basic-addon1" maxlength="8" id="nombre" name="nombre" >
      </div>
  
        <!--Inicio del select Status  -->
       <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="status">Nivel: </label>
        </div>
        <select class="custom-select" id="nivel" name="nivel" >
          <option selected>Seleccionar</option>
          <option value="1">Administrador</option>
          <option value="2">Moderador</option>
        </select>
      </div>

      <!--Inicio del select Status  -->
       <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="status">Status: </label>
        </div>
        <select class="custom-select" id="status" name="status" >
          <option selected>Seleccionar</option>
          <option value="A">Activo</option>
          <option value="I">Inactivo</option>
        </select>
      </div>
      
    <div class="col-md-12 text-center m-4">
      <input class="btn btn-success justify-content-center" type="button" value="Aceptar" onClick="validarUsuarioAC()">
      <input class="btn btn-danger justify-content-center mt-3 mb-3" type="button" value="Cancelar" data-dismiss="modal">
    </div>
      </form>
      <div id="mensaje_yaexiste" class='mensaje_error'></div> <!-- Para mostrar el mensaje si el usuario ya existe -->
    </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>



</div>

       <table class="table pt-5">
        <thead class="thead-dark">
        <tr>
          <th scope="col align-items-center">Datos de los Usuarios</th>
        </tr>

          <tr>
            <th scope="col">Nº</td>
            <th scope="col">Usuario</td>
            <th scope="col">Contraseña</td>
            <th scope="col">Nombre</td>
            <th scope="col">Nivel.</td>
            <th scope="col">Estatus.</td>
            <th scope="col" align="center">Editar</td>
            <th scope="col" align="center">Borrar</td>
          </tr>
        </thead>
          <?php
            $ok=$objUsuario->mostrar_usuarios($con);
          while(($datos=mysqli_fetch_assoc($ok))>0)
          {
            echo "<tbody><tr>
              <td scope='row'>$datos[id_user]</td>
              <td>$datos[user]</td>
              <td>$datos[pass]</td>
              <td>$datos[nombre]</td>
              <td>$datos[nivel]</td>
              <td>$datos[status]</td>
              <td align='center'><button type='button' class='btn  ' data-toggle='modal' data-target='#ModalActualizarUS' data-id='$datos[id_user]' data-user='$datos[user]' data-pass='$datos[pass]' data-nombre='$datos[nombre]' data-nivel='$datos[nivel]' data-status='$datos[status]' ><img src='../images/editar.png'></button></td>
              <td align='center'> <button type='button' class='btn' data-toggle='modal' data-target='#ModalEliminarUS' data-id='$datos[id_user]' data-nombre='$datos[nombre]' ><img src='../images/borrar.png'></button></td>
              </tr> </tbody>";
          }
          ?>
          </table>



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
<script type="text/javascript">
  $('#sandbox-container .input-group.date').datepicker({
    format: "dd/mm/yy"
});
</script>
</html>

