<?php
$mensaje="";
if(isset($_GET['mensaje'])&&($_GET['mensaje']=='sin_permiso')) {
    $mensaje='<div class="alert alert-danger  alert-dismissible fade show p-1" role="alert"> <p class="mensaje"><strong>Ups!</strong>, Lo siento, para poder acceder a nuestro contenido primero tiene que iniciar Sesión.</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
  }
  if(isset($_GET['mensaje'])&&($_GET['mensaje']=='gracias')) {
   $mensaje='<div class="alert alert-success alert-dismissible fade show p-1" role="alert"> <p class="mensaje"><strong>Excelente!</strong>, gracias por utilizar nuestra plataforma.</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>';
  }

?>

<!doctype html>
<html>
  <head>
  <meta charset="utf-8">
  
  <title>Talles´T GYM</title>
  <link rel="icon" type="image/png" href="views/images/inventario.ico">

  <link rel="stylesheet" href="views/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="views/css/font-awesome.min.css">
  <link rel="stylesheet" href="views/css/styles.css">
  </head>

  <body id="body_login">
    <div class="container">
      
      <div id="login" class="border border-dark rounded">
          <!--Imagen de Login-->
    <div id="img-login" class="justify-content-center pt-5">
        <img src="views/images/user.png" class="d-inline-block align-top rounded-circle">
      </div>
      <!--Campos de texto-->
    <div class="pt-5 m-4">
    <form>
    <!--form method='get' name='formingreso' id='formingreso' action='verifica.php' onsubmit="return revisa()"-->
    
        <!--Usuario-->
        <div class="input-group flex-nowrap pt-4">
          <div class="input-group-prepend">
            <span class="input-group-text fa fa-user icono" id="addon-wrapping"></span>
          </div>
          <input type="text" class="form-control" placeholder="Usuario" aria-label="Usuario" aria-describedby="addon-wrapping" id="usuario" onblur="return novacio(this)" />
        </div>
        <!--Cantraseña-->
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text fa fa-lock icono" id="addon-wrapping"></span>
          </div>
          <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping" id="clave" onblur="return novacio(this)" />
        </div>

         
           
        <div class="boton">
        <input type="button" name="enviar" class="btn btn-dark mt-3  mr-1 justify-content-center align-middle" value="Ingresar"  onClick="verificar_acceso()"/>
        <input type="reset" name="limpiar" class="btn btn-dark mt-3 justify-content-center align-middle" value="Limpiar" />

        </div>
          <div id="dinamico" align="center">  <!-- Aquí dentro se va a pintar si el usuario es correcto o no --></div>
   
          
    </form>
     </div>
  </div>
    </div>
    <?php echo $mensaje;?>
    
  </body>
  <script type="text/javascript" src="views/js/validaciones.js"></script>
  <script type="text/javascript" src="views/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="views/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="views/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="views/js/popper.min.js"></script>
</html>