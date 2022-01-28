

function TrabajadorACT(datosTrab){

	d=datosTrab.split('||');

	$('#ID_act').val(d[0]);
	$('#nombre_act').val(d[1]);
	$('#descripcion_act').val(d[2]);
	$('#fecha_act').val(d[3]);
	$('#fechafin_act').val(d[4]);
	$('#Hini_act').val(d[5]);
	$('#Hfin_act').val(d[6]);
	$('#estado_act').val(d[7]);
	
}

function actualizarActividad(){


	ID_act=$('#ID_act').val();
	nombre_act=$('#nombre_act').val();
	descripcion_act=$('#descripcion_act').val();
	fecha_act=$('#fecha_act').val();
	fechafin_act=$('#fechafin_act').val();
	Hini_act=$('#Hini_act').val();
	Hfin_act=$('#Hfin_act').val();
	estado_act=$('#estado_act').val();

	cadenas= "ID_act=" + ID_act +
			"&nombre_act=" + nombre_act + 
			"&descripcion_act=" + descripcion_act +
			"&fecha_act=" + fecha_act +
			"&fechafin_act=" + fechafin_act +
			"&Hini_act=" + Hini_act +
			"&Hfin_act=" + Hfin_act +
			"&estado_act=" + estado_act;

	$.ajax({
		type:"POST",
		url:"../models/actualizar_actividad.php",
		data:cadenas,
		success:function(r){
                if(r==1){
						alertify.success("Actualizado con exito."); 
                    location.href ="../Views/SeguimientoActividades.php";
					
				}else{
					alertify.error("ERROR! Completar todos los campos");
				}
		
		}
	});
	
}



function TrabajadorEliminar(datos){

	d=datos.split('||');

	$('#ID_a').val(d[0]);
	$('#nombre_a').val(d[1]);
	$('#descripcion_a').val(d[2]);
	
}


function EliminarDatos(){


	ID_a=$('#ID_a').val();
	nombre_a=$('#nombre_a').val();
	descripcion_act=$('#descripcion_act').val();
	boxmotivo=$('#boxmotiv').val();
	descripcion2=$('#descrip').val();

	cadena2= "ID_a=" + ID_a +
			"&nombre_a=" + nombre_a + 
			"&descripcion_a=" + descripcion_a +
			"&boxmotivo=" + boxmotivo +
			"&descripcion2=" + descripcion2;

	$.ajax({
		type:"POST",
		url:"../models/eliminar_actividad.php",
		data:cadena2,
		success:function(r){
	            if(r==1){
					alertify.success("Eliminado con exito."); 
					location.href ="../Views/SeguimientoActividades.php";
				}else{
					alertify.error("ERROR! Completar todos los campos");
				}

		}
	});
	
}


function TrabajadorComentario(comentario){

	h=comentario.split('||');

	$('#ID_c').val(h[0]);
	$('#nom_c').val(h[1]);
	$('#descripcion_c').val(h[2]);
	$('#fecha').val(h[3]);
	$('#fechafin').val(h[4]);
	$('#Horaini').val(h[5]);
	$('#Horafin').val(h[6]);
	$('#estado').val(h[7]);
	$('#respons').val(h[8]);
	
	
}

function InsertarComentario(){


	ID_c=$('#ID_c').val();
	comentario=$('#comentario').val();

	cadena_coment= "ID_c=" + ID_c +
			"&comentario=" + comentario;

	$.ajax({
		type:"POST",
		url:"../models/insertar_comentAct.php",
		data:cadena_coment,
		success:function(c){
	            if(c==1){
					alertify.success("Registrado con exito."); 
				}else{
					alertify.error("ERROR! Completar todos los campos");
				}

		}
	});
	
}

function TrabajadorCodigo(datos2){

	d=datos2.split('||');

	$('#ID_c').val(d[0]);
	
}

function AutorizarEdicion(){


	ID_c=$('#ID_c').val();
	codigo=$('#codigo').val();

	cadena9= "ID_c=" + ID_c +
			"&codigo=" + codigo;

	$.ajax({
		type:"POST",
		url:"../models/insertar_codigo_AES.php",
		data:cadena9,
		success:function(c){
	            if(c==1){
					//alertify.success("¡AUTORIZADO CON ÉXITO!");
					alert("CORRECTO! Usted a sido AUTORIZADO para editar los registros!"); 
					location.href ="../Views/cumplimiento_apap.php";					
				}else{
					alertify.error("ERROR! Ingrese un codigo válido.");
				}

		}
	});
	
}

function TrabajadorACT_AE(datosTra){

	d=datosTra.split('||');

	$('#ID_act').val(d[0]);
	$('#nombre_act').val(d[1]);
	$('#descripcion_act').val(d[2]);
	$('#fecha_act').val(d[3]);
	$('#fechafin_act').val(d[4]);
	$('#Hini_act').val(d[5]);
	$('#Hfin_act').val(d[6]);
	$('#estado_act').val(d[7]);
	
}

function actualizarActividad_AE(){


	ID_act=$('#ID_act').val();
	nombre_act=$('#nombre_act').val();
	descripcion_act=$('#descripcion_act').val();
	fecha_act=$('#fecha_act').val();
	fechafin_act=$('#fechafin_act').val();
	Hini_act=$('#Hini_act').val();
	Hfin_act=$('#Hfin_act').val();
	estado_act=$('#estado_act').val();

	cadenas= "ID_act=" + ID_act +
			"&nombre_act=" + nombre_act + 
			"&descripcion_act=" + descripcion_act +
			"&fecha_act=" + fecha_act +
			"&fechafin_act=" + fechafin_act +
			"&Hini_act=" + Hini_act +
			"&Hfin_act=" + Hfin_act +
			"&estado_act=" + estado_act;

	$.ajax({
		type:"POST",
		url:"../models/actualizar_actividad.php",
		data:cadenas,
		success:function(r){
                if(r==1){
						alertify.success("Actualizado con exito."); 
                    location.href ="../Views/cumplimiento_apap.php";
					
				}else{
					alertify.error("ERROR! Completar todos los campos");
				}
		
		}
	});
	
}