

function Trabajador2(datosTrab2){

	d2=datosTrab2.split('||');

	$('#ID').val(d2[0]);
	$('#nombre').val(d2[1]);
	$('#descripcion').val(d2[2]);
	$('#boxResponsable').val(d2[3]);
	$('#fecinicio').val(d2[4]);
	$('#horainicio').val(d2[5]);
	$('#fecfinal').val(d2[6]);
	$('#horafinal').val(d2[7]);
	$('#boxestado').val(d2[8]);
	
}


function actualizaDatos(){


	ID=$('#ID').val();
	tipo=$('#tipo').val();
	boxempresa=$('#boxempresa').val();
	nombre=$('#nombre').val();
	descripcion=$('#descripcion').val();
	boxArea=$('#boxArea').val();
	boxResponsable=$('#boxResponsable').val();
	fecinicio=$('#fecinicio').val();
	fecfinal=$('#fecfinal').val();
	fecinicioreal=$('#fecinicioreal').val();
	fecfinalreal=$('#fecfinalreal').val();

	cadena2= "ID=" + ID +
			"&tipo=" + tipo + 
			"&boxempresa=" + boxempresa +
			"&nombre=" + nombre +
			"&descripcion=" + descripcion +
			"&boxArea=" + boxArea +
			"&boxResponsable=" + boxResponsable +
			"&fecinicio=" + fecinicio +
			"&fecfinal=" + fecfinal +
			"&fecinicioreal=" + fecinicioreal +
			"&fecfinalreal=" + fecfinalreal;

	$.ajax({
		type:"POST",
		url:"../models/actualizarps.php",
		data:cadena2,
		success:function(r){
		
            if(r==1){
				alertify.success("Actualizado con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});
	
}