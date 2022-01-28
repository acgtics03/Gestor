

function Trabajador(datosTrab){

	d=datosTrab.split('||');

	$('#ID3').val(d[0]);
	$('#nombre3').val(d[1]);
	$('#descripcion3').val(d[2]);
	$('#nombre4').val(d[3]);
	
}



function actualizarDatos(){


	ID3=$('#ID3').val();
	nombre3=$('#nombre3').val();
	descripcion3=$('#descripcion3').val();
	nombre4=$('#nombre4').val();
	bxresponsable=$('#bxresponsable').val();

	cadena2= "ID3=" + ID3+
			"&nombre3=" + nombre3 + 
			"&descripcion3=" + descripcion3 +
			"&nombre4=" + nombre4 +
			"&bxresponsable=" + bxresponsable;

	$.ajax({
		type:"POST",
		url:"../models/reasignar_act.php",
		data:cadena2,
		success:function(r){
                    if(r==1){
						alertify.success("REASIGNADO CON EXITO!)");
			            location.href ="../Views/Reasignar.php";
				}else{
					alertify.error("ERROR! Seleccionar un nuevo responsable.");
				}

		}
	});
	
}

function Trabajador2(datos){

	s=datos.split('||');

	$('#IDs').val(s[0]);
	$('#tiposs').val(s[1]);
	$('#nombree').val(s[4]);
	
}

function EliminarDatos(){


	IDs=$('#IDs').val();
	boxmotivo=$('#boxmotivo').val();
	descripcion2=$('#descripcion2').val();
	tiposs=$('#tiposs').val();

	cadena2= "IDs=" + IDs +
			"&boxmotivo=" + boxmotivo + 
			"&descripcion2=" + descripcion2 +
			"&tiposs=" + tiposs;

	$.ajax({
		type:"POST",
		url:"../models/eliminarps.php",
		data:cadena2,
		success:function(r){

	     	if(r==1){
					
					alertify.success("ELIMINADO CON EXITO!");
					location.href ="../Views/ProductosServicios.php";
				}else{
					alertify.error("ERROR! Completar todos los campos");
				}
		}
	});
	
}

