

function Trabajador(datosTrab){

	d=datosTrab.split('||');

	$('#ID').val(d[0]);
	$('#dni').val(d[1]);
	$('#fn').val(d[2]);
	$('#correo').val(d[3]);
	$('#apellido').val(d[4]);
	$('#nombre').val(d[5]);
	$('#direccion').val(d[6]);
	$('#telefono').val(d[7]);
	$('#ch').val(d[8]);
	$('#boxarea').val(d[9]);
	$('#boxcargo').val(d[10]);
	$('#supervisor').val(d[11]);
	$('#estado').val(d[12]);
	$('#boxme').val(d[13]);
	$('#fnei').val(d[14]);
	$('#fnef').val(d[15]);
	
}


function actualizaDatos2(){


	ID=$('#ID').val();
	dni=$('#DNI').val();
	fn=$('#fn').val();
	correo=$('#correo').val();
	apellido=$('#apellido').val();
	nombre=$('#nombre').val();
	direccion=$('#direccion').val();
	telefono=$('#telefono').val();
	ch=$('#ch').val();
	boxarea=$('#boxarea').val();
	boxcargo=$('#boxcargo').val();
	supervisor=$('#supervisor').val();
	estado=$('#estado').val();
	boxme=$('#boxme').val();
	fnei=$('#fnei').val();
	fnef=$('#fnef').val();

	cadena2= "ID=" + ID +
			"&dni=" + dni + 
			"&fn=" + fn +
			"&correo=" + correo +
			"&apellido=" + apellido +
			"&nombre=" + nombre +
			"&telefono=" + telefono +
			"&ch=" + ch +
			"&boxarea=" + boxarea +
			"&boxcargo=" + boxcargo +
			"&supervisor=" + supervisor +
			"&estado=" + estado +
			"&boxme=" + boxme +
			"&fnei=" + fnei +
			"&fnef=" + fnef;

	$.ajax({
		type:"POST",
		url:"../Modulo_administrador/php/actualizaDatos2.php",
		data:cadena2,
		success:function(r){
		
		alertify.success("Actualizado con exito!. Recargar página");
			
		}
	});
	
}


function Trabajador2(datos){

	dd=datos.split('||');

	$('#ID2').val(dd[0]);
	$('#dni2').val(dd[1]);
	$('#fn2').val(dd[2]);
	$('#correo2').val(dd[3]);
	$('#apellido2').val(dd[4]);
	$('#nombre2').val(dd[5]);
	$('#direccion2').val(dd[6]);
	$('#telefono2').val(dd[7]);
	$('#ch2').val(dd[8]);
	$('#boxarea2').val(dd[9]);
	$('#boxcargo2').val(dd[10]);
	$('#supervisor2').val(dd[11]);
	$('#estado2').val(dd[12]);
	$('#boxme2').val(dd[13]);
	$('#fnei2').val(dd[14]);
	$('#fnef2').val(dd[15]);
	
}


function Autorizar(){


	correo2=$('#correo2').val();
	boxencargado=$('#boxencargado').val();
	codigo=$('#codigo').val();

	caden= "correo2=" + correo2 +
			"&boxencargado=" + boxencargado + 
			"&codigo=" + codigo;

	$.ajax({
		type:"POST",
		url:"../Modulo_administrador/php/autorizar.php",
		data:caden,
		success:function(rr){
			if(rr==1){				
				alertify.success("CORRECTO! Se autorizó la edición del registro.");
				location.href ="../Modulo_administrador/AdminUsuarios.php";
			}else{
				alertify.error("ERROR! Los datos ingresados son incorrectos.");
			}
		}
	});
	
}