<?php 

    $variable = "";
	$variable = $usr;

	if(empty($variable)){

		echo '<script type="text/javascript">';
        echo 'alert("El tiempo de su sesion ha expirado! Ingrese nuevamente.")';
        echo '</script>';
        echo '<script type="text/javascript">';
        echo 'location.href="'.$HOST.'"';
        echo '</script>';

	}

?>