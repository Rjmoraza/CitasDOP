<?php
$idCita = $_GET['idCita'];
$dia = $_GET['dia'];
$mes = $_GET['mes'];
$anio = $_GET['anio'];
$horario = $_GET['horario'];
$psicologa = $_GET['psicologa'];
$ausencia = $_GET['ausencia'];

include("database.php");

$horarioAux = "";
$sql = "SELECT horario from Horario where idHorario = ".$horario."";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $horarioAux = $row["horario"];
}

$horarioAuxLista = explode(":", $horarioAux);

$fecha = $anio . "-" . $mes . "-" . $dia . " ".$horarioAuxLista[0].":00:00";

$sql = "UPDATE Cita SET Horario_idHorario = '".$horario."', fecha = '".$fecha."', Psicologa_idPsicologa = '".$psicologa."', ausencia = '".$ausencia."' WHERE idCita = '".$idCita."'";
$result = mysqli_query($conn, $sql);
?>
