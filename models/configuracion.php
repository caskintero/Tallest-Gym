<?php 
 $dbhost ='localhost';//hosting del servidor, nos lo da la empresa que contratemos
 $db= 'sistemainv';//nombre de la base de datos
 $dbuser= 'root';//usuario de la base de datos
 $dbpass= ''; //contraseña par la base de datos
 //conectamos y seleccionamos la base de datos
 mysqli_connect($dbhost,$dbuser,$dbpass);
 mysqli_select_db($db);
 //comenzamos la sesion

 session_start();

 ?>