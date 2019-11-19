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
if(!($fecha < $fechaDia or $diaSemana == "1" or $diaSemana == "7")){
	$sql = "SELECT * from Horario where idHorario not in (SELECT Horario_idHorario from Cita where SUBSTRING(fecha,1,10) = SUBSTRING('".$fecha."',1,10) AND Psicologa_idPsicologa = '".$psicologa."') AND idHorario not in (SELECT Horario_idHorario from Plantilla where DiasSemana_idDiasSemana = '".$diaSemana."' AND Psicologa_idPsicologa = '".$psicologa."') order by idHorario ASC";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		echo "<option value = '".$row["idHorario"]."'>".$row["horario"]."</option>";
	}
}
?>