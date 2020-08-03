<?php 
session_start();

if ($_SESSION['status']=='A' ) {
	$nivel="";
	if ($_SESSION['nivel']=='1') {
		$nivel = "Administrador";
	}
	if ($_SESSION['nivel']=='2') {
		$nivel = "Moderador";
	}
?>
<head>
<link rel="icon" type="image/png" href="../images/inventario.ico">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/styles.css">
<link rel="stylesheet" type="text/css" href="../css/estilos.css">
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
 <script type="text/javascript" src="../js/validaciones.js"></script>
<script type="text/javascript" src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="../js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../js/popper.min.js"></script>
 <script type="text/javascript" src="../js/main.js"></script>
</head>
	<div class="contenedor">
			<!--Inicio del navbar vertical -->
			<div class="navbar-vertical position-fixed">
				<nav class="navbar navbar-expand-lg primer-nav text-white flex-column pt-3">
					 <h2 class="pb-3 text-center">TALLES´T GYM</h2>
					 
					
				
				 <div class="imagen ">
				  	<img src="../images/avatar-male.png"  class="d-inline-block align-top rounded-circle" alt="Foto_perfil">
				  	<p></p>
				  	<p class="text-center lead"><?php echo $_SESSION["nombre"];?></p>
				  	<p class="text-center lead"><?php echo $nivel;?></p>
				  </div>

				  	 <div class="collapse navbar-collapse  pb-0" id="navbarNav">
					    <ul class="navbar-nav  flex-column " >
					      <li class="nav-item active">
					        <a class="nav-link text-white fa fa-home"   id="hover" href="../inicio/index.php" >  Inicio <span class="sr-only">(current)</span></a>
					      </li>

					      <li class="nav-item active">
					        <a class="nav-link text-white fa fa-user-plus"   id="hover" href="../asistencia/index.php" >  Asistencia <span class="sr-only">(current)</span></a>
					      </li>

					      <li class="nav-item active">
					        <a class="nav-link text-white fa fa-users"   id="hover" href="../clientes/indexc.php" >  Clientes <span class="sr-only">(current)</span></a>
					      </li>

					      <li class="nav-item active">
					        <a class="nav-link text-white fa fa-dollar"   id="hover" href="../mensualidad/index.php" >  Mensualidad <span class="sr-only">(current)</span></a>
					      </li>
					      
					      <?php

					      	if ($nivel=="Administrador") {
					      		echo '
					      		 <li class="nav-item active">
							        <a class="nav-link text-white fa fa-user"   id="hover" href="../registros/index.php" >  Registros <span class="sr-only">(current)</span></a>
							      </li>
					      		<li class="nav-item active">
					        	<a class="nav-link text-white fa fa-user"   id="hover" href="../usuarios/index.php" >  Usuarios <span class="sr-only">(current)</span></a>
					      		</li>';
					      	}
					      ?>
					      
					    
				  		</ul>
				 	 </div>
				  </nav><!--Fin del nav vertical -->
 			</div><!--Fin del nav vertical -->
			<div class="nav-segundario " >
				<nav class="navbar navbar-dark nav-horizontal position-absolute ">
				  <div class="">
		            <span class="h4"></span>
		          </div>
					<ul class="nav justify-content-end ">
					 
					  <li class="nav-item ">
					  	<a href="../../controllers/destroy.php"  class="fa fa-power-off text-white"></a>
					  </li>
				</ul>
				</nav>
				<div class="pb-5"></div>
				

			 <?php
} else{
  define('PAGINA_INICIO', '../../index.php?mensaje=sin_permiso');
  header('Location: '.PAGINA_INICIO);
}
?>
			
				
			