$(document).ready(function(){
    var nivel = $('#nivel').val()
$(buscar_clientes(nivel));
$(buscar_mensualidad(nivel));
$(buscar_asistencia(nivel));
$(buscar_registros(nivel));

    var nav_ver = $('.navbar-vertical');
    $('.pointers').click(function(){
        
        nav_ver.toggle();
        var here = $('.aqui');
        if (here.hasClass("fa-toggle-off")) {

        	   	here.removeClass("fa-toggle-off");
       			here.addClass("fa-toggle-on");
        }else{
        	here.removeClass("fa-toggle-on");
       			here.addClass("fa-toggle-off");
        }
     

        
    });



function buscar_clientes(nivel,consulta){
    $.ajax({
        url: '../../models/buscarc.php' ,
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta,
                nivel: nivel},
    })
    .done(function(respuesta){
        $("#datosc").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}


$(document).on('keyup','#caja_busquedac', function(){
    var valor = $(this).val();
    ;
    if (valor != "") {
        buscar_clientes(nivel,valor);
    }else{
        buscar_clientes(nivel);
    }
});


    function buscar_mensualidad(nivel,consulta){
    $.ajax({
        url: '../../models/buscarm.php' ,
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta,
                nivel: nivel},
    })
    .done(function(respuesta){
        $("#datosm").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}


$(document).on('keyup','#caja_busquedam', function(){
    var valor = $(this).val();
    ;
    if (valor != "") {
        buscar_mensualidad(nivel,valor);
    }else{
        buscar_mensualidad(nivel);
    }
});
    
    function buscar_asistencia(nivel,consulta){
    $.ajax({
        url: '../../models/buscara.php' ,
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta,
                nivel: nivel},
    })
    .done(function(respuesta){
        $("#datosA").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}


$(document).on('keyup','#caja_busquedaA', function(){
    var valor = $(this).val();
    ;
    if (valor != "") {
        buscar_asistencia(nivel,valor);
    }else{
        buscar_asistencia(nivel);
    }
});

    function buscar_registros(nivel,consulta){
    $.ajax({
        url: '../../models/buscarre.php' ,
        type: 'POST' ,
        dataType: 'html',
        data: {consulta: consulta,
                nivel: nivel},
    })
    .done(function(respuesta){
        $("#datosR").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}


$(document).on('keyup','#caja_busquedaR', function(){
    var valor = $(this).val();
    ;
    if (valor != "") {
        buscar_registros(nivel,valor);
    }else{
        buscar_registros(nivel);
    }
});


});