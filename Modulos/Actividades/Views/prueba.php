<?php 

$dia = date('Y');

if('01' < $dia && $dia <'04'){
   $d='trimestre 1';
}else{
    if('03' < $dia && $dia <'07'){
        $d='trimestre 2';
     }else{
        if('6' < $dia && $dia <'10'){
            $d='trimestre 3';
         }else{
            if('9' < $dia && $dia <'13'){
                $d='trimestre 4';
         }
     }
  } 
 }


echo $dia.'-02-01';

?>