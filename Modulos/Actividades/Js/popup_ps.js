

function Trabajador(datosTrab){

	d=datosTrab.split('||');

	$('#ID').val(d[0]);
	$('#tipo').val(d[1]);
	$('#bxestado').val(d[2]);
	$('#boxempresa').val(d[3]);
	$('#nombres').val(d[4]);
	$('#descripcion').val(d[5]);
	$('#boxArea').val(d[6]);
	$('#boxResponsable').val(d[7]);
	$('#fecinicio').val(d[8]);
	$('#fecinicioreal').val(d[9]);
	$('#fecfinal').val(d[10]);
	$('#fecfinalreal').val(d[11]);
	
}



function actualizarDatos(){


	ID=$('#ID').val();
	tipo=$('#tipo').val();
	bxestado=$('#bxestado').val();
	boxempresa=$('#boxempresa').val();
	nombres=$('#nombres').val();
	descripcion=$('#descripcion').val();
	boxArea=$('#boxArea').val();
	boxResponsable=$('#boxResponsable').val();
	fecinicio=$('#fecinicio').val();
	fecinicioreal=$('#fecinicioreal').val();
	fecfinal=$('#fecfinal').val();
	fecfinalreal=$('#fecfinalreal').val();

	cadena2= "ID=" + ID +
			"&tipo=" + tipo + 
			"&bxestado=" + bxestado +
			"&boxempresa=" + boxempresa +
			"&nombres=" + nombres +
			"&descripcion=" + descripcion +
			"&boxArea=" + boxArea +
			"&boxResponsable=" + boxResponsable +
			"&fecinicio=" + fecinicio +
			"&fecinicioreal=" + fecinicioreal +
			"&fecfinal=" + fecfinal +
			"&fecfinalreal=" + fecfinalreal;

	$.ajax({
		type:"POST",
		url:"../models/actualizarps.php",
		data:cadena2,
		success:function(r){

			alertify.success("Actualizado con exito.)");
			location.href ="../Views/ProductosServicios.php";

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

