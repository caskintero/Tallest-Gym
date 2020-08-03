<?php


$mensaje="";
if(isset($_GET['mensaje'])&&($_GET['mensaje']=='mensaje_error')) {
    $mensaje='<div class="alert alert-danger alert-dismissible fade show p-1" role="alert"> <p class="mensaje"><strong>Ups!</strong>, Lo siento, El registro no pudo ser eliminado con exito.</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
  }
  if(isset($_GET['mensaje'])&&($_GET['mensaje']=='mensaje_exito')) {
   $mensaje='<div class="alert alert-success alert-dismissible fade show p-1" role="alert"> <p class="mensaje"><strong>Excelente!</strong>, El registro fue eliminado con exito</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
  }



 ?>
<!DOCTYPE html>
<html>
<head>
  <title>Mensualidad</title>
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
  <a class="text-white" href="reporte_asistencia.php" target="_blank"><button class="btn botones" type="button" >Imprimir</button></a>
</p>
</div>

  <?php echo $mensaje?>

   <div class="input-group mb-3 formulario">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">Buscar</span>
  </div>
    
    <!-- Modal Eliminar-->
<div class="modal fade" id="ModalEliminarREG" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

       
        <div class="modal-body">
        <form method="post" action="../../controllers/registro.php" name="form_ok" id="form_ok">
           <input type="hidden" name="accion" value="eliminar_registro">
           <h3 class="pt-2"> Esta seguro de eliminar este Pago?</h3>
           <hr class="bg-danger">
          <input type="hidden" name="id_pago" id="id_pago">
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


  <input type="text" class="form-control" placeholder="Caja de busqueda" name="caja_busquedaR" id="caja_busquedaR" >

</div>

       <!--///////////////// Tabla dinamica //////////////////////-->
    <div id="datosR"></div>




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
