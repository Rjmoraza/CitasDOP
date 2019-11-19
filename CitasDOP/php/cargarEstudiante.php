<?php
$carnet = $_GET['carnet'];
include("database.php");

$sql = "SELECT idEstudiante, nombre, primerApellido, segundoApellido FROM Persona, Estudiante where Estudiante.carnet = '".$carnet."' and Estudiante.Persona_idPersona = Persona.idPersona";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
	echo "<input hidden id = 'estudianteText' value = '".$row["idEstudiante"]."'><h2 class='col-md-12 col-sm-12 col-xs-12'>".$row["nombre"]." ".$row["primerApellido"]." ".$row["segundoApellido"]."</h2><br>";
}
?>
