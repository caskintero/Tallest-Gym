function novacio(element)
{
	valor1=element.value;
	if (valor1 != null && valor1.length != 0) 
	{
		element.style.border='1px solid green';
		return true;
	}
	else
	{
		element.style.border='1px solid red';
		return false;
	}
}






function revisa() 
{
	var valido = true;
	var formularios = document.forms;
	for (var i=0; i<formularios.length;i++)
	{
	    for (var j=0; j<formularios[i].elements.length; j++)
	    {
	        valor = formularios[i].elements[j].value;
	        if (valor == null || valor.length == 0)
	        {
	        	alert('[ERROR] El campo '+ formularios[i].elements[j].name +' no debe estar vacío');
	        	formularios[i].elements[j].style.border='1px solid red';
	        	formularios[i].elements[j].focus();
	        	valido = false;
	        	break;
	        }
	    }
	}
	return valido;
}
function revisa_form(form_id) 
{
	//Con esta función revisamos los elementos del formulario que se pasa por parámetro
	var formulario = document.getElementById(form_id);	
	var valido = true;
    for (var j=0; j<formulario.elements.length; j++)
    {
        elemento=formulario.elements[j];
        if (elemento.className != 'no_requerido') //Para diferenciar los campos no requeridos en el formulario
        {
	        valor = formulario.elements[j].value;
	        if (valor == null || valor.length == 0)
	        {
	        	alert('[ERROR] El campo '+ formulario.elements[j].name +' no debe estar vacío');
	        	formulario.elements[j].style.border='1px solid red';
	        	formulario.elements[j].focus();
	        	valido = false;
	        	break;
	        }
    	}
    }
	return valido;
}
//validar usuario
function validarUsuario()
{
	if (revisa_form("form_usu"))
	{
		document.getElementById("form_usu").submit();
	}
	else
		return false;
}
function validarUsuarioAC()
{
	if (revisa_form("form_usuac"))
	{
		document.getElementById("form_usuac").submit();
	}
	else
		return false;
}
//validar ok es una validacion para aceptar eliminar algun registro
function validarok()
{
	if (revisa_form("form_ok"))
	{
		document.getElementById("form_ok").submit();
	}
	else
		return false;
}
//validar Clientes...
function validarCliente()
{
	if (revisa_form("form_client"))
	{
		document.getElementById("form_client").submit();
	}
	else
		return false;
}
function validarClienteAC()
{
	if (revisa_form("form_clientac"))
	{
		document.getElementById("form_clientac").submit();
	}
	else
		return false;
}



//validar Asistencia
function validarAsistencia()
{
	if (revisa_form("form_asist"))
	{
		document.getElementById("form_asist").submit();
	}
	else
		return false;
}
function validarAsistenciaAC()
{
	if (revisa_form("form_asistAC"))
	{
		document.getElementById("form_asistAC").submit();
	}
	else
		return false;
}

//validar Pago
function validarPago()
{
	if (revisa_form("form_pago"))
	{
		document.getElementById("form_pago").submit();
	}
	else
		return false;
}
function validarPagoAC()
{
	if (revisa_form("form_pagoAC"))
	{
		document.getElementById("form_pagoAC").submit();
	}
	else
		return false;
}



//Busqueda de los Usuarios
function buscar_cedula(opcion)
{
	var cedula=document.getElementById("cedula").value;
	if (cedula != null && cedula.length > 0)
	{
		var objAjax=new XMLHttpRequest();
		objAjax.open("GET","../../controllers/clientes.php?accion=buscar_cedula&ced="+cedula);
		objAjax.onreadystatechange=function()
		{
			if (objAjax.readyState==4 && objAjax.status==200)
			{				
				var respuesta=objAjax.responseText;
				//Esto es lo que recibe Ajax del controlador, lo que le pasa el echo de la función buscar_usuario de la clase
				if(respuesta!=0)
				{
					var usuario=respuesta.split("#"); //Descompone la cadena en un vector con los datos del usuario
					/* 	usuario[0] nombre
						usuario[1] apellido
						usuario[2] direccion */	
					if (opcion=='1') //agregar usuario
					{
						document.getElementById("mensaje_yaexiste").innerHTML="La Cedula ya existe: "+usuario[0];				
						window.setTimeout(function() {document.getElementById("mensaje_yaexiste").innerHTML="";}, 3000);
						document.getElementById("cedula").value="";
						document.getElementById("cedula").focus();
					}
					
				}
								
			}
		}
		objAjax.send(null);	
	}
}
function buscar_user(opcion)
{
	var usuario=document.getElementById("user").value;
	if (usuario != null && usuario.length > 0)
	{
		var objAjax=new XMLHttpRequest();
		objAjax.open("GET","../../controllers/usuarios.php?accion=buscar_usuario&user="+usuario);
		objAjax.onreadystatechange=function()
		{
			if (objAjax.readyState==4 && objAjax.status==200)
			{				
				var respuesta=objAjax.responseText;
				//Esto es lo que recibe Ajax del controlador, lo que le pasa el echo de la función buscar_usuario de la clase
				if(respuesta!=0)
				{
					var usuario=respuesta.split("#"); //Descompone la cadena en un vector con los datos del usuario
					/* 	usuario[0] nombre
						usuario[1] apellido
						usuario[2] direccion */	
					if (opcion=='1') //agregar usuario
					{
						document.getElementById("mensaje_yaexiste").innerHTML="El Usuario ya existe ";				
						window.setTimeout(function() {document.getElementById("mensaje_yaexiste").innerHTML="";}, 3000);
						document.getElementById("user").value="";
						document.getElementById("user").focus();
					}
					
				}
								
			}
		}
		objAjax.send(null);	
	}
}



//LOGIN
function verificar_acceso()
{
	if (revisa())
	{
		document.getElementById("dinamico").innerHTML="";
		var objAjax=new XMLHttpRequest();
		var usuario=document.getElementById("usuario").value;
		var clave=document.getElementById("clave").value;
		if (usuario!="")
		{
			objAjax.open("GET","controllers/usuarios.php?accion=loguear_user&usu="+usuario+"&cla="+clave);
			objAjax.onreadystatechange=function()
			{
				if (objAjax.readyState==4 && objAjax.status==200)
				{
					var respuesta=objAjax.responseText
					if (respuesta==1)
					{
						document.getElementById("dinamico").innerHTML="<p style='background-color: rgba(40, 167, 69, 0.8); color: white;'>Iniciando, Bienvenido.!</p>"
						window.setTimeout(function() {document.location="views/inicio/index.php";}, 3000);						
					}
					if (respuesta==2)
					{
						document.getElementById("dinamico").innerHTML="<p class='mensaje_error'>Usuario o Contraseña errónea, Verifique.</p>";
						window.setTimeout(function() {document.getElementById("dinamico").innerHTML="";
						document.getElementById("clave").value="";
						document.getElementById("clave").focus();}, 3000);
					}

					if (respuesta==3)
					{
						document.getElementById("dinamico").innerHTML="<p class='mensaje_error'>Usuario o Contraseña errónea, Verifique.</p>";
						window.setTimeout(function() {document.getElementById("dinamico").innerHTML="";
						document.getElementById("usuario").value="";
						document.getElementById("clave").value="";
						document.getElementById("usuario").focus();}, 3000);
					}
					if (respuesta==4)
					{
						document.getElementById("dinamico").innerHTML="<p class='mensaje_error'>Usuario está desactivado.</p>";
						window.setTimeout(function() {document.getElementById("dinamico").innerHTML="";
						document.getElementById("usuario").value="";
						document.getElementById("clave").value="";
						document.getElementById("usuario").focus();}, 3000);
					}
				}
			}
			objAjax.send(null)
		}
	}
}
					/*========================
					AJAX MODALES DE LOS USUARIOS
					=========================*/
$('#ModalActualizarUS').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		   var id = button.data('id') // Extraer la información de atributos de datos
		   var user = button.data('user') // Extraer la información de atributos de datos
		  var pass = button.data('pass') // Extraer la información de atributos de datos
		  var nombre = button.data('nombre') // Extraer la información de atributos de datos
		  var nivel = button.data('nivel') // Extraer la información de atributos de datos
		  var status = button.data('status') // Extraer la información de atributos de datos
		 
		  var modal = $(this)
		  modal.find('.modal-title').text('Modificar Usuario: '+nombre)
		  modal.find('.modal-body #id_user').val(id)
		   modal.find('.modal-body #user').val(user)
		  modal.find('.modal-body #pass').val(pass)
		  modal.find('.modal-body #nombre').val(nombre)
		  modal.find('.modal-body #nivel').val(nivel)
		  modal.find('.modal-body #status').val(status)
		  
		
		  $('.alert').hide();//Oculto alert
		})

		$('#ModalEliminarUS').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		   var id = button.data('id') // Extraer la información de atributos de datos
		  var nombre = button.data('nombre') // Extraer la información de atributos de datos
		
		  var modal = $(this)
		  modal.find('.modal-title').text('Eliminar Usuario: '+nombre)
		  modal.find('.modal-body #id_user').val(id)
		  $('.alert').hide();//Oculto alert
		})
					/*========================
					AJAX MODALES DE LOS CLIENTES
					=========================*/
		$('#ModalActualizarCLIENT').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var id = button.data('id') // Extraer la información de atributos de datos
		  var cedula = button.data('cedula') // Extraer la información de atributos de datos
		  var nombre = button.data('nombre') // Extraer la información de atributos de datos
		  var telefono = button.data('telefono') // Extraer la información de atributos de datos
		  var direccion = button.data('dir') // Extraer la información de atributos de datos
		  var fechan = button.data('fechan') // Extraer la información de atributos de datos
		  var fechar = button.data('fechar') // Extraer la información de atributos de datos
		  var status = button.data('status') // Extraer la información de atributos de datos
		 	

		  var modal = $(this)
		  modal.find('.modal-title').text('Modificar Cliente: '+nombre)
		  modal.find('.modal-body #id_cliente').val(id)
		  modal.find('.modal-body #cedula').val(cedula)
		  modal.find('.modal-body #nombre_client').val(nombre)
		  modal.find('.modal-body #telefono').val(telefono)
		   modal.find('.modal-body #direccion').val(direccion)
		  modal.find('.modal-body #fecha_nac').val(fechan)
		  modal.find('.modal-body #fecha_reg').val(fechar)
		  modal.find('.modal-body #status').val(status)
		  
	
		  $('.alert').hide();//Oculto alert
		})

		$('#ModalEliminarCLIENT').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		   var id = button.data('id') // Extraer la información de atributos de datos
		  var nombre = button.data('nombre') // Extraer la información de atributos de datos
		
		  var modal = $(this)
		  modal.find('.modal-title').text('Eliminar Cliente: '+nombre)
		  modal.find('.modal-body #id_cliente').val(id)
		  $('.alert').hide();//Oculto alert
		})

						/*========================
						AJAX MODALES DE LAS ASISTENCIAS
						=========================*/

		$('#ModalActualizarASIST').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		  var id1 = button.data('id1') // Extraer la información de atributos de datos
		  var id2 = button.data('id2') // Extraer la información de atributos de datos
		  var fecha = button.data('fecha') // Extraer la información de atributos de datos
		  var nombre= button.data('nombre')

		  var modal = $(this)
		  modal.find('.modal-title').text('Modificar Asistencia: '+nombre)
		  modal.find('.modal-body #id_asistencia').val(id1)
		  modal.find('.modal-body #id_cliente').val(id2)
		  modal.find('.modal-body #fecha_asistencia').val(fecha)
		  
		  $('.alert').hide();//Oculto alert
		})

		$('#ModalEliminarASIST').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		   var id = button.data('id') // Extraer la información de atributos de datos
		  var nombre = button.data('nombre') // Extraer la información de atributos de datos
		  var fecha = button.data('fecha') // Extraer la información de atributos de datos
		
		  var modal = $(this)
		  modal.find('.modal-title').text('Eliminar Asistencia: '+nombre+' | Fecha: '+fecha)
		  modal.find('.modal-body #id_asistencia').val(id)
		  $('.alert').hide();//Oculto alert
		})

			/*========================
						AJAX MODALES DE LOS PAGOS
						=========================*/

		

		$('#ModalEliminarPAGO').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		   var id = button.data('id') // Extraer la información de atributos de datos
		  var nombre = button.data('nombre') // Extraer la información de atributos de datos
		  var fecha = button.data('fecha') // Extraer la información de atributos de datos
		
		  var modal = $(this)
		  modal.find('.modal-title').text('Eliminar Mensualidad: '+nombre+' | Fecha Inicio: '+fecha)
		  modal.find('.modal-body #id_pago').val(id)
		  $('.alert').hide();//Oculto alert
		})

		/*========================
						AJAX MODALES DE LOS Registros
						=========================*/

		

		$('#ModalEliminarREG').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Botón que activó el modal
		   var id = button.data('id') // Extraer la información de atributos de datos
		  var nombre = button.data('nombre') // Extraer la información de atributos de datos
		  var fecha = button.data('fecha') // Extraer la información de atributos de datos
		
		  var modal = $(this)
		  modal.find('.modal-title').text('Eliminar Registro: '+nombre+' | Fecha Inicio: '+fecha)
		  modal.find('.modal-body #id_pago').val(id)
		  $('.alert').hide();//Oculto alert
		})
					




 function recargarLista1(){
    $.ajax({
      type:"POST",
      url:"../../models/datos.class.php",
      data:"linea=" + $('#lineaprod1').val(),
      success:function(r){
        $('#select1lista').html(r);
      }
    });
  }
 