

function agregardatos(nombre,apellido,email,telefono){

	cadena="nombre=" + nombre + 
			"&apellido=" + apellido +
			"&email=" + email +
			"&telefono=" + telefono;

	$.ajax({
		type:"POST",
		url:"php/agregarDatos.php",
		data:cadena,
		success:function(r){
			if(r==1){
				$('#tabla').load('componentes/tabla.php');
				 $('#buscador').load('componentes/buscador.php');
				alertify.success("agregado con exito :)");
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}


function Visita(vis){

	v=vis.split('||');

	$('#idvisita').val(v[0]);
	$('#user').val(v[1]);
	$('#datepicker4').val(v[2]);
	$('#bxm').val(v[3]);
	$('#inicio').val(v[4]);
	$('#fin').val(v[5]);
	$('#bxo').val(v[6]);
	$('#bxd').val(v[7]);
	
}

function agregaform(dts){

	d=dts.split('||');

	$('#idpersona').val(d[0]);
	$('#user').val(d[1]);
	$('#datepicker3').val(d[2]);
	$('#ing').val(d[3]);
	$('#rfini').val(d[4]);
	$('#rffin').val(d[5]);
	$('#sal').val(d[6]);
	
}

function actualizaDatos(){


	idpersona=$('#idpersona').val();
	nombreu=$('#nombreu').val();
	datepicker3=$('#datepicker3').val();
	ing=$('#ing').val();
	rfini=$('#rfini').val();
	rffin=$('#rffin').val();
	sal=$('#sal').val();

	cadena= "idpersona=" + idpersona +
			"&nombreu=" + nombreu + 
			"&datepicker3=" + datepicker3 +
			"&ing=" + ing +
			"&rfini=" + rfini +
			"&rffin=" + rffin +
			"&sal=" + sal ;

	$.ajax({
		type:"POST",
		url:"../Modulo_administrador/php/actualizaDatos.php",
		data:cadena,
		success:function(r){
			
			if(r==1){
				alertify.success("Actualizado con exito :)");
				window.location.reload();
			}else{
				alertify.error("Fallo el servidor :(");
			}
		}
	});

}


function preguntarSiNo(id){
	alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar este registro?', 
					function(){ eliminarDatos(id) }
                , function(){ alertify.error('Se cancelo')});
}

function eliminarDatos(id){

	cadena="id=" + id;

		$.ajax({
			type:"POST",
			url:"php/eliminarDatos.php",
			data:cadena,
			success:function(r){
				if(r==1){
					$('#tabla').load('componentes/tabla.php');
					alertify.success("Eliminado con exito!");
				}else{
					alertify.error("Fallo el servidor :(");
				}
			}
		});
}