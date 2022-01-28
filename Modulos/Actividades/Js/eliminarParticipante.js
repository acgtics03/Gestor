

function Participante(datosTrab){

	d=datosTrab.split('||');

	$('#IDp').val(d[0]);
	$('#datos').val(d[1]);
	$('#area').val(d[2]);
	
}


function EliminarParticipante(){


	IDp=$('#IDp').val();
	bxmo=$('#bxmo').val();
	desc_eliminado=$('#desc_eliminado').val();

	cadenas= "IDp=" + IDp +
			"&bxmo=" + bxmo + 
			"&desc_eliminado=" + desc_eliminado;

	$.ajax({
		type:"POST",
		url:"../models/eliminarparticipante.php",
		data:cadenas,
		success:function(r){
                if(r==1){
					alertify.success("ELIMINADO CON EXITO!");
                    location.href ="../Views/SegActividades.php";
					
				}else{
					alertify.error("ERROR! Completar todos los campos");
				}
		
		}
	});
	
}


