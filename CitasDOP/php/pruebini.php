<?php
$fecha = date("2019-06-19");
$fechaSemana = date("Y-m-d",strtotime(date("Y-m-d")."+ 1 week"));
$fechaDia = date("Y-m-d",strtotime(date("Y-m-d")."+ 1 days"));

if($fecha > $fechaSemana){
	echo "Fuck week";
}
elseif($fecha < $fechaDia){
	echo "Fuck day";
}
else{
	echo "Nice";
}

?>
