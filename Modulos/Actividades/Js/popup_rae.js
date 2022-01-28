function Trabajador(datosTrab){

	d=datosTrab.split('||');

	$('#ID3').val(d[0]);
	$('#nombre3').val(d[1]);
	$('#descripcion3').val(d[2]);
	$('#resp3').val(d[3]);
	
}



function actualizarDatos(){


	ID3=$('#ID3').val();

	cadena2= "ID3=" + ID3;

	$.ajax({
		type:"POST",
		url:"../models/reestablecer_actividad.php",
		data:cadena2,
		success:function(r){
                    if(r==1){
						alertify.success("REESTABLECIDO CON EXITO!)");
			            location.href ="../Views/eliminados_apap.php";
				}else{
					alertify.error("ERROR! Seleccionar un nuevo responsable.");
				}

		}
	});
	
}