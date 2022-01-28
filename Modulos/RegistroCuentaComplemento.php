<?php 
	
$alert = '';
//VARIABLE DE SESION
session_start();
 
require_once "conexion.php"; 
$usuario = $_SESSION['user'];
$contraseña = $_SESSION['Psw'];
	//Establecemos el método GET
	if(!empty($_POST))
	{
	  if(empty($_POST['BoxCargo']) || empty($_POST['BoxArea']) || empty($_POST['BoxJefe']))
        {
        $alert = 'Error! Complete todos los campos de selección.';
        }else{
            
         
	      $ddni = $_POST['dni'];
	      $dapellido = $_POST['apellido']; 
	      $dnombre = $_POST['nombre'];
	      $dtelefono = $_POST['telefono'];
	      $dboxcargo = $_POST['BoxCargo'];
	      $dboxarea = $_POST['BoxArea'];
	      $dcorreojefe = $_POST['BoxJefe'];
	      
	      
	    //VERIFICAR SI YA ESTA REGISTRADO
         
         $consulta_registro = mysqli_query($conection, "SELECT * FROM persona WHERE DNI='$ddni' AND EstadoCuenta='PENDIENTE'");
         $consulta_registror = mysqli_num_rows($consulta_registro);
         
         if($consulta_registror > 0){
	    
    	    $ActualizaDatos = mysqli_query($conection, "UPDATE persona SET apellido='$dapellido',nombre='$dnombre',Telefono='$dtelefono',
    	    idCargo='$dboxcargo',idArea='$dboxarea',idJefeInmediato='$dcorreojefe', UserUpdate='$usuario', EstadoCuenta='REGISTRADO' WHERE dni='$ddni'");
    	    
    	    $consultar_correo = mysqli_query($conection, "SELECT idusuario as id FROM persona WHERE DNI='$ddni'");
    	    $consultar_correor = mysqli_fetch_assoc($consultar_correo);
    	    
    	    $correo = $consultar_correor['id'];
    	    
    	    
    	    $InsertaCuenta = mysqli_query($conection, "UPDATE usuario SET clave='$contraseña',idPerfil='2',fecha='$Fecha',hora='$Hora' WHERE usuario='$correo'");
    	        
    	    header('location: ../index.php');
         }else{
             $consulta_regist = mysqli_query($conection, "SELECT * FROM persona WHERE DNI='$ddni' AND EstadoCuenta='REGISTRADO'");
             $consulta_registr = mysqli_num_rows($consulta_regist);
             
             if($consulta_registr > 0){
                 $alert = 'ERROR! Los datos ingresados corresponden a una cuenta ya registrada. Comunicarse con el Área de Administración.';
             }else{
                 $alert = 'ERROR! Usted aun no esta autorizado(a) para registrarse. Comunicarse con el Área de Administración.';
             }
         }
	}}

 ?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link  rel="icon"   href="img/icon.png" type="image/png" />
	<title>AppVisitas</title>
	<link rel="stylesheet" type="text/css" href="../css/style2.css">
</head>
<body>
	<section id="container">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<form action="" method="post">
			
			<h3 style="font-size: 10pt;border-radius: 11px 11px 11px 11px;">Completar los siguientes datos:</h3>
			
                <div>
                    <input type="number" style="font-size: 12px" placeholder="DNI" name="dni" required></input>
                 
                    <input type="text" style="font-size: 12px" placeholder="Apellidos completos" name="apellido" required></input>
                
                    <input type="text" style="font-size: 12px" placeholder="Nombres completos" name="nombre" required></input>
              
                   
                    <input type="number" style="font-size: 12px" placeholder="Telefono / celular" name="telefono" required></input>
               
                    <?php $consulta = mysqli_query($conection,"SELECT * FROM Cargo");?>
                        <select name="BoxCargo" style="font-size: 12px">
                        <option selected="true" disabled="disabled">Seleccione Cargo</option>
                        <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                        <option value="<?php echo $datos['idcargo'] ?>">
                        <?php echo $datos['cargo']; ?>
                        </option>
                        <?php }?>
                         </select>
                
                    <?php $consulta = mysqli_query($conection,"SELECT * FROM area");?>
                        <select name="BoxArea" style="font-size: 12px;">
                        <option selected="true" disabled="disabled">Seleccione Area</option>
                        <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                        <option value="<?php echo $datos['idArea'] ?>">
                        <?php echo $datos['Area']; ?>
                        </option>
                        <?php }?>
                         </select>
                
                 
                    <?php $consulta = mysqli_query($conection,"SELECT idusuario, concat(apellido,' ',nombre) as datos FROM persona WHERE TipoTrabajador='SUPERVISOR'");?>
                        <select name="BoxJefe" style="font-size: 12px;">
                        <option selected="true" disabled="disabled">Seleccione Jefe Inmediato</option>
                        <?php  while($datos=mysqli_fetch_assoc($consulta)){?>
                        <option value="<?php echo $datos['idusuario'] ?>">
                        <?php echo $datos['datos']; ?>
                        </option>
                        <?php }?>
                         </select>
                    </div>
             
             <input type="submit" value="Finalizar" style="font-size: 15px" ></input>
            
            <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div><br>
            <div id="pie" heig>
            <label for="" style="font-size: 11.5px">v.1.0</label>
        </div>
           
		</form>

	</section>
</body>
</html>