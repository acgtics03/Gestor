var timeoutDefecto = 1000 * 60;
var ListaSeleccionada = Array();
$(document).ready(function() {
    Control();
});

function Control() {
    
    VerUsuario();
    
    $('#btnActividades').click(function() {
        window.location.replace('AppActividades/principal.php');
     });


    $('#btnAsistencia').click(function() {
        window.location.replace('AppAsistencia/Modulos/SelectorAsistencia.php');
     });  


    $('#btnVisitas').click(function() {
        window.location.replace('AppAsistencia/Modulos/SelectorVisitas.php');
     });
  
}


function VerUsuario() {
    var timeoutDefecto = 1000 * 60;
   
    var data = { "btnVerUsuario": true
                };
    $.ajax({
        type: "POST",
        url: "views/models/M02_Accesos/M02MD04_IrActividades.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            
            if (dato.status == "ok") {  
                $("#txtUser").val(dato.data);
            }else{
                mensaje_alerta("¡Se termino la sesión!", dato.data, "info");
            }
            
        },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
    
}

function IrActividades() {
    var timeoutDefecto = 1000 * 60;
    bloquearPantalla("Procesando...");
    var data = { "btnRegistrarEmpresa": true
                };
    $.ajax({
        type: "POST",
        url: "../models/M02_Accesos/M02MD04_IrActividades.php",
        data: data,
        dataType: "json",
        success: function(dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {  
                
            }else{
                mensaje_alerta("¡Error en el Proceso!", dato.data, "info");
            }
            
        },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}





