<?php
$inicio = $_GET['inicio'];
$fin = $_GET['fin'];
$reporte = $_GET['reporte'];

include("database.php");

if($reporte == "1"){
	$sql = "SELECT SUBSTRING(carnet, 1, 4), count(idCita) FROM Estudiante, Cita where Cita.Estudiante_idEstudiante = Estudiante.idEstudiante and (Cita.fecha >= Date_format('".$inicio."', '%Y-%m-%d') and Cita.fecha <= Date_format('".$fin."', '%Y-%m-%d')) GROUP BY SUBSTRING(carnet, 1, 4)";
	$result = mysqli_query($conn, $sql);
	echo "<br><h2>Resultado: </h2><table>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td><h2>".$row["SUBSTRING(carnet, 1, 4)"].": </h2></td><td><h2>".$row["count(idCita)"]."</h2></td></tr>";
	}
	echo "</table>";

}
elseif($reporte == "2"){
	$sql = "SELECT Sexo.sexo, count(Estudiante.Sexo_idSexo) from Estudiante, Cita, Sexo where Estudiante.idEstudiante = Cita.Estudiante_idEstudiante and Sexo.idSexo = Estudiante.Sexo_idSexo and (Cita.fecha >= Date_format('".$inicio."', '%Y-%m-%d') and Cita.fecha <= Date_format('".$fin."', '%Y-%m-%d')) GROUP BY Estudiante.Sexo_idSexo ";
	$result = mysqli_query($conn, $sql);
	echo "<br><h2>Resultado: </h2><table>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td><h2>".$row["sexo"].": </h2></td><td><h2>".$row["count(Estudiante.Sexo_idSexo)"]."</h2></td></tr>";
	}
	echo "</table>";
}
elseif($reporte == "3"){
	$sql = "SELECT Carrera.carrera, count(Estudiante.Carrera_idCarrera) from Estudiante, Cita, Carrera where Estudiante.idEstudiante = Cita.Estudiante_idEstudiante and Carrera.idCarrera = Estudiante.Carrera_idCarrera and (Cita.fecha >= Date_format('".$inicio."', '%Y-%m-%d') and Cita.fecha <= Date_format('".$fin."', '%Y-%m-%d')) GROUP BY Estudiante.Carrera_idCarrera";
	$result = mysqli_query($conn, $sql);
	echo "<br><h2>Resultado: </h2><table>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td><h2>".$row["carrera"].": </h2></td><td><h2>".$row["count(Estudiante.Carrera_idCarrera)"]."</h2></td></tr>";
	}
	echo "</table>";

}
elseif($reporte == "4"){
	$sql = "SELECT Motivo.motivo, count(Cita_has_Motivo.idCita_has_Motivo) from Cita_has_Motivo, Cita, Motivo where Motivo.idMotivo = Cita_has_Motivo.Motivo_idMotivo and Cita.idCita = Cita_has_Motivo.Cita_idCita and (Cita.fecha >= Date_format('".$inicio."', '%Y-%m-%d') and Cita.fecha <= Date_format('".$fin."', '%Y-%m-%d')) GROUP BY Cita_has_Motivo.Motivo_idMotivo";
	$result = mysqli_query($conn, $sql);
	echo "<br><h2>Resultado: </h2><table>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td><h2>".$row["motivo"].": </h2></td><td><h2>".$row["count(Cita_has_Motivo.idCita_has_Motivo)"]."</h2></td></tr>";
	}
	echo "</table>";

}
elseif($reporte == "5"){
	$sql = "SELECT Referencia.referencia, count(Cita.Referencia_idReferencia) from Referencia, Cita where Referencia.idReferencia = Cita.Referencia_idReferencia and (Cita.fecha >= Date_format('".$inicio."', '%Y-%m-%d') and Cita.fecha <= Date_format('".$fin."', '%Y-%m-%d')) GROUP BY Cita.Referencia_idReferencia";
	$result = mysqli_query($conn, $sql);
	echo "<br><h2>Resultado: </h2><table>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td><h2>".$row["referencia"].": </h2></td><td><h2>".$row["count(Cita.Referencia_idReferencia)"]."</h2></td></tr>";
	}
	echo "</table>";

}
elseif($reporte == "6"){
	$sql = "SELECT Estudiante.carnet, count(Cita.idCita) from Estudiante, Cita where Estudiante.idEstudiante = Cita.Estudiante_idEstudiante and (Cita.fecha >= Date_format('".$inicio."', '%Y-%m-%d') and Cita.fecha <= Date_format('".$fin."', '%Y-%m-%d')) GROUP BY Estudiante.carnet";
	$result = mysqli_query($conn, $sql);
	echo "<br><h2>Resultado: </h2><table>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td><h2>".$row["carnet"].": </h2></td><td><h2>".$row["count(Cita.idCita)"]."</h2></td></tr>";
	}
	echo "</table>";

}
elseif($reporte == "7"){
	$sql = "SELECT Persona.nombre, Persona.primerApellido, Persona.segundoApellido, count(Cita.idCita) from Persona, Psicologa, Cita where Psicologa.Persona_idPersona = Persona.idPersona and Cita.Psicologa_idPsicologa = Psicologa.idPsicologa and (Cita.fecha >= Date_format('".$inicio."', '%Y-%m-%d') and Cita.fecha <= Date_format('".$fin."', '%Y-%m-%d')) GROUP BY Persona.idPersona";
	$result = mysqli_query($conn, $sql);
	echo "<br><h2>Resultado: </h2><table>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td><h2>".$row["nombre"]." ".$row["primerApellido"]." ".$row["segundoApellido"].": </h2></td><td><h2>".$row["count(Cita.idCita)"]."</h2></td></tr>";
	}
	echo "</table>";
}
elseif($reporte == "8"){
	$sql = "SELECT count(idCita) from Cita where fecha >= Date_format('".$inicio."', '%Y-%m-%d') and fecha <= Date_format('".$fin."', '%Y-%m-%d')";
	$result = mysqli_query($conn, $sql);
	echo "<br><h2>Resultado: </h2>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<h2>Total de citas: ".$row["count(idCita)"]."</h2>";
	}
}
elseif($reporte == "9"){
	$sql = "SELECT count(idCita) FROM `Cita` WHERE ausencia = 0 and fecha >= Date_format('".$inicio."', '%Y-%m-%d') and fecha <= Date_format('".$fin."', '%Y-%m-%d')";
	$result = mysqli_query($conn, $sql);
	echo "<br><h2>Resultado: </h2>";
	while($row = mysqli_fetch_assoc($result)) {
		echo "<h2>Total de ausencias: ".$row["count(idCita)"]."</h2>";
	}

}
else{
	echo "Error";
}
?>
