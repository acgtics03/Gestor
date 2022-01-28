var timeoutDefecto = 1000 * 60;
var ListaSeleccionada = Array();
$(document).ready(function() {
    Control();
});

function Control() {
    $('.modal').on("hidden.bs.modal", function(e) {
        if ($('.modal:visible').length) {
            $('body').addClass('modal-open');
        }
    });



  $('#btnCerrarSesion').click(function() {
        ConsultaCerrarSesion();
     });


ValidarPerfil();

}





/************************************-------------  BOTON DE CERRAR SESION ---------------**********************/

function ConsultaCerrarSesion() { 
  mensaje_sesion("Al confirmar saldrá del Modulo de Actividades.", CerrarSesion);
}

function CerrarSesion(){
    window.location.replace('https://acg-soft.com/ti/extranet/Gestor/');  
}


function ValidarPerfil(){
    var data = {
        "btnValidarPerfil": true
    };
    $.ajax({
        type: "POST",
        url: "views/models/M01_Actividades/M01MD01_Actividades/validar_perfil.php",
        data: data,
        dataType: "json",
        success: function (dato) {
            desbloquearPantalla();
            if (dato.status == "ok") {
                
              /*  var x = document.getElementById("FiltroResponsable");
                x.style.display = "block";*/

                var y = document.getElementById("btnSuper");
                y.style.display = "block";

            } else {
                
                /*var x = document.getElementById("FiltroResponsable");
                x.style.display = "none";*/

                var y = document.getElementById("btnSuper");
                y.style.display = "none";

            }

        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus + ': ' + errorThrown);
            desbloquearPantalla();
        },
        timeout: timeoutDefecto
    });
}