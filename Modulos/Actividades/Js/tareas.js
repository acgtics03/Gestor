

function Trabajador(datosTrab){

	d=datosTrab.split('||');

	$('#ID').val(d[0]);
	$('#nombre2').val(d[1]);
	$('#descripcion2').val(d[2]);
	$('#bxResp').val(d[3]);
	$('#boxestado').val(d[4]);
	$('#fecinicio').val(d[5]);
	$('#horainicio').val(d[6]);
	$('#fecfinal').val(d[7]);
	$('#horafinal').val(d[8]);
	
}


function actualizarDatos(){


	ID=$('#ID').val();
	nombre2=$('#nombre2').val();
	descripcion2=$('#descripcion2').val();
	bxResp=$('#bxResp').val();
	boxestado=$('#boxestado').val();
	fecinicio=$('#fecinicio').val();
	horainicio=$('#horainicio').val();
	fecfinal=$('#fecfinal').val();
	horafinal=$('#horafinal').val();

	cadena2= "ID=" + ID +
			"&nombre2=" + nombre2 + 
			"&descripcion2=" + descripcion2 +
			"&bxResp=" + bxResp +
			"&boxestado=" + boxestado +
			"&fecinicio=" + fecinicio +
			"&horainicio=" + horainicio +
			"&fecfinal=" + fecfinal +
			"&horafinal=" + horafinal;

	$.ajax({
		type:"POST",
		url:"../models/actualizartarea.php",
		data:cadena2,
		success:function(r){

			alertify.success("Actualizado con exito.");
            location.href ="../Views/SegActividades.php";
		}
	});
	
}

function Trabajador2(datos){

	d=datos.split('||');

	$('#ID_act').val(d[0]);
	$('#nombre_act').val(d[1]);
	$('#descripcion_act').val(d[2]);
	
}


function EliminarDatos(){


	ID_act=$('#ID_act').val();
	nombre_act=$('#nombre_act').val();
	descripcion_act=$('#descripcion_act').val();
	bxm=$('#bxm').val();
	desc=$('#desc').val();

	cadena2= "ID_act=" + ID_act +
			"&nombre_act=" + nombre_act + 
			"&descripcion_act=" + descripcion_act +
			"&bxm=" + bxm +
			"&desc=" + desc;

	$.ajax({
		type:"POST",
		url:"../models/eliminartarea.php",
		data:cadena2,
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


