<?php

include("database.php");
session_start();

$idPsicologa = 0;
$sql = "SELECT idPersona,nombre, primerApellido, segundoApellido, idPsicologa from (SELECT pe.idPersona,pe.nombre, pe.primerApellido, pe.segundoApellido FROM Persona AS pe INNER JOIN (SELECT ps.Persona_idPersona from Psicologa AS ps INNER JOIN (SELECT ci.Psicologa_idPsicologa from Cita AS ci where Estudiante_idEstudiante = ".$_SESSION["usuarioActivo"]." order by fecha DESC LIMIT 1 ) AS d1 ON ps.idPsicologa = d1.Psicologa_idPsicologa) AS d2 ON pe.idPersona = d2.Persona_idPersona)AS d3 ,Psicologa where d3.idPersona = Psicologa.Persona_idPersona";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	echo "<label class='col-md-3 col-sm-5 col-xs-12 control-label'>Usted fue atendido por esta psicóloga la última vez, cambiela si desea ser atendido por otra:</label><br><br><br><br><div class='col-md-3 col-sm-5 col-xs-12'>";
	echo "<select id = 'psicologaText' class='form-control'>";
	$idPsicologa = $row["idPsicologa"];
	echo "<option value='".$row["idPsicologa"]."'>".$row["nombre"]." ".$row["primerApellido"]." ".$row["segundoApellido"]."</option>";
}
if($idPsicologa != 0){
	$sql = "SELECT idPersona,nombre, primerApellido, segundoApellido, idPsicologa from (SELECT pe.idPersona,pe.nombre, pe.primerApellido, pe.segundoApellido FROM Persona AS pe INNER JOIN (SELECT ps.Persona_idPersona from Psicologa AS ps where ps.idPsicologa != ".$idPsicologa.") AS d2 ON pe.idPersona = d2.Persona_idPersona)AS d3 ,Psicologa where d3.idPersona = Psicologa.Persona_idPersona";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		echo "<option value='".$row["idPsicologa"]."'>".$row["nombre"]." ".$row["primerApellido"]." ".$row["segundoApellido"]."</option>";
	}	
	echo "</select></div><br><br>";
}
else{
	echo "Primera cita";
}

?>
