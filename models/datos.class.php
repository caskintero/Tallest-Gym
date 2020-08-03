<?php 
$conexion=mysqli_connect('localhost','root','','sistemainv');
$linea=$_POST['linea'];

	$sql="SELECT id_lineaprod,linea_producto.id_prodpro,prod_provee.id_producto as id_prod ,prod_provee.id_proveedor as id_prov,prod_provee.id_producto,producto.nombre_producto as nom_prod,producto.unidad_medida as unid_med,prod_provee.id_proveedor,proveedor.nombre_proveedor as nom_prov
		from linea_producto inner join prod_provee on linea_producto.id_prodpro=prod_provee.id_prodpro inner join producto on prod_provee.id_producto=producto.id_producto inner join proveedor on prod_provee.id_proveedor=proveedor.id_proveedor
		where id_linea='$linea'";

	$result=mysqli_query($conexion,$sql);

	$cadena="<div class='input-group mt-2 mb-3'><span class='input-group-text' id='basic-addon1'>Producto: </span>
			<select class='custom-select' id='producto' name='producto'>
			<option value=''>Seleccionar Producto</option>";
	while ($prod=mysqli_fetch_assoc($result))
      {
        $cadena=$cadena."<option value=".$prod['id_lineaprod'].">".$prod['nom_prod'].' | '.$prod['nom_prov']."</option>\n";
       }
	
		
	echo  $cadena."</select> </div>";
	

?>