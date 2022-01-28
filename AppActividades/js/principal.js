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



    
}


/**-------------  BOTON DE CERRAR SESION ---------------**/

function ConsultaCerrarSesion() { 
  mensaje_sesion("Al confirmar saldrá del Modulo de Actividades.", CerrarSesion);
}

function CerrarSesion(){
    window.location.replace('http://localhost/Extranet2/');  
}
