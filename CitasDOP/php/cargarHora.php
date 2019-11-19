<?php
$dia = $_GET['dia'];
$mes = $_GET['mes'];
$anio = $_GET['anio'];
$psicologa = $_GET['psicologa'];
include("database.php");

$fecha = date($anio . "-" . $mes . "-" . $dia);
$fechaSemana = date("Y-m-d",strtotime(date("Y-m-d")."+ 1 week"));
$fechaDia = date("Y-m-d",strtotime(date("Y-m-d")."+ 1 days"));
$diaSemana = "";
$sql = "SELECT DAYOFWEEK('".$fecha."') as fecha";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$diaSemana = $row["fecha"];
}
if(!($fecha > $fechaSemana or $fecha < $fechaDia or $diaSemana == "1" or $diaSemana == "7")){
	if($psicologa == "¬"){

		$cantidadPsicologas = 0;
		
		$listaCita = array();
		$listaCitaCount = array();
		$listaPlantilla = array();
		$listaPlantillaCount = array();
		$listaIdHorario = array();
		$listaHorario = array();

		$sql = "SELECT count(idPsicologa) from Psicologa";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			$cantidadPsicologas = $row["count(idPsicologa)"];
		}

		$sql = "SELECT * from Horario order by idHorario ASC";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			array_push($listaHorario, $row["horario"]) ;
			array_push($listaIdHorario, $row["idHorario"]) ;
		}

		$sql = "SELECT count(Horario_idHorario), Horario_idHorario from Cita where SUBSTRING(fecha,1,10) = SUBSTRING('".$fecha."',1,10) GROUP BY Horario_idHorario";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			array_push($listaCita, $row["Horario_idHorario"]) ;
			array_push($listaCitaCount, $row["count(Horario_idHorario)"]) ;
		}

		$sql = "SELECT count(Horario_idHorario), Horario_idHorario from Plantilla where DiasSemana_idDiasSemana = '".$diaSemana."' group by Horario_idHorario";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			array_push($listaPlantillaCount, $row["count(Horario_idHorario)"]) ;
			array_push($listaPlantilla, $row["Horario_idHorario"]) ;
		}

		$horarioSize = count($listaHorario);
		for($x = 0; $x < $horarioSize; $x++){
			$cantidadOcupados = 0;
			if(in_array($listaIdHorario[$x], $listaCita)){
				$cantidadOcupados += $listaCitaCount[array_search($listaIdHorario[$x], $listaCita)];
				if(in_array($listaIdHorario[$x], $listaPlantilla)){
					$cantidadOcupados += $listaPlantillaCount[array_search($listaIdHorario[$x], $listaPlantilla)];
				}
			}
			else{
				if(in_array($listaIdHorario[$x], $listaPlantilla)){
					$cantidadOcupados += $listaPlantillaCount[array_search($listaIdHorario[$x], $listaPlantilla)];
				}
			}
			if($cantidadOcupados < $cantidadPsicologas){
				echo "<option value = '".$listaIdHorario[$x]."'>".$listaHorario[$x]."</option>";
				
			}
		}
	}
	else{
		$sql = "SELECT * from Horario where idHorario not in (SELECT Horario_idHorario from Cita where SUBSTRING(fecha,1,10) = SUBSTRING('".$fecha."',1,10) AND Psicologa_idPsicologa = '".$psicologa."') AND idHorario not in (SELECT Horario_idHorario from Plantilla where DiasSemana_idDiasSemana = '".$diaSemana."' AND Psicologa_idPsicologa = '".$psicologa."') order by idHorario ASC";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			echo "<option value = '".$row["idHorario"]."'>".$row["horario"]."</option>";
		}
	}
}
echo "";

?>
