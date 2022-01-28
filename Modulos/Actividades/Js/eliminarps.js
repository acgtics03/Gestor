

function TrabajadorE(datosTrab){

	d=datosTrab.split('||');

	$('#ID').val(d[0]);
	
}


function actualizarDatos(){


	ID=$('#ID').val();
	tipo=$('#tipo').val();
	bxestado=$('#bxestado').val();
	boxempresa=$('#boxempresa').val();
	nombre=$('#nombre').val();
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
			"&nombre=" + nombre +
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

			alertify.success("Actualizado con exito. Recargar página)");

		}
	});
	
}