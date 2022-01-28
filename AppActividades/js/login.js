
$(document).ready(function() {
    Control();
});

function Control() {
    
    
    $('#usuario').keyup(delayTime(function (e) {
      
      VerEmpresas();
    }, 1000));
  
  
  
}

function VerEmpresas(){
    $("#bxempresa").val("");
    var url = 'models/get_login.php';
    var datos = {
            "ReturnListaEmpresas": true,
            "usuario": $('#usuario').val()
    }
    llenarCombo(url, datos, "bxempresa");
}






