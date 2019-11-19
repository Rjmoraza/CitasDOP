<?php
$idCita = $_GET['idCita'];
include("database.php");

$sql = "DELETE from Cita_has_Motivo where Cita_idCita = '".$idCita."'";
$result = mysqli_query($conn, $sql);
$sql = "DELETE from Cita where idCita = '".$idCita."'";
$result = mysqli_query($conn, $sql);
?>