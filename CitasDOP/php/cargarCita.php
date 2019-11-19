<?php
$idCita = $_GET['idCita'];
$idPsicologa = $_GET['idPsicologa'];
$fecha = $_GET['fecha'];

include("database.php");

//Cargar motivos
$sql = "SELECT motivo from Motivo, Cita, Cita_has_Motivo where idCita = '".$idCita."' and Motivo.idMotivo = Cita_has_Motivo.Motivo_idMotivo and Cita.idCita = Cita_has_Motivo.Cita_idCita";
$result = mysqli_query($conn, $sql);
echo "<label class='col-md-12 col-sm-12 col-xs-12 control-label'>Motivo de consulta:</label>";
echo "<div class='col-md-12 col-sm-12 col-xs-12'>";
while($row = mysqli_fetch_assoc($result)) {
	echo "<label class='control-label col-md-12 col-sm-12 col-xs-12'>-".$row["motivo"]."</label>
	";
}
echo "</div>";

//Cargar referencias
$sql = "SELECT referencia from Referencia, Cita where idCita = '".$idCita."' and Referencia.idReferencia = Cita.Referencia_idReferencia";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	echo "<label class='col-md-12 col-sm-12 col-xs-12 control-label'>Referido de:</label>";
	echo "<div class='col-md-12 col-sm-12 col-xs-12'>";
	echo "<label class='control-label col-md-12 col-sm-12 col-xs-12'>-".$row["referencia"]."</label>";
	echo "</div>";
}

//Cargar psicologas
$sql= "SELECT idPsicologa, concat(nombre, ' ', primerApellido, ' ', segundoApellido) from Persona, Cita, Psicologa where Persona.idPersona = Psicologa.Persona_idPersona and Cita.Psicologa_idPsicologa = Psicologa.idPsicologa AND Cita.idCita = '".$idCita."'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	echo "<label class='col-md-12 col-sm-12 col-xs-12 control-label'>Psicóloga asignada a la cita:</label>";
	echo "<div class='col-md-8 col-sm-8 col-xs-8'>";
	echo "<select id = 'psicologaTextEventoGet' onchange = 'cambiarHorarioEvento()' class='form-control'>";
	echo "<option value='".$row["idPsicologa"]."'>".$row["concat(nombre, ' ', primerApellido, ' ', segundoApellido)"]."</option>";
}
$sql = "SELECT idPsicologa, concat(nombre, ' ', primerApellido, ' ', segundoApellido) from Persona, Psicologa where Persona.idPersona = Psicologa.Persona_idPersona and Psicologa.idPsicologa != '".$idPsicologa."'";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	echo "<option value='".$row["idPsicologa"]."'>".$row["concat(nombre, ' ', primerApellido, ' ', segundoApellido)"]."</option>";
}	
echo "</select></div>";

//Cargar fecha
echo "<label class='control-label col-md-6 col-sm-6 col-xs-6'>Fecha asignada:</label>";
echo "<div class='col-md-8 col-sm-8 col-xs-8'>";
echo "<input onchange = 'cambiarHorarioEvento()' id = 'fechaTextEventoGet' type='date' class='form-control' value = '".$fecha."'>";
echo "</div>";

//Cargar horario
$diaSemana = "";
$sql = "SELECT DAYOFWEEK('".$fecha."') as fecha";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$diaSemana = $row["fecha"];
}

$sql = "SELECT idHorario, horario from Horario, Cita where Cita.Horario_idHorario = Horario.idHorario and Cita.idCita = '".$idCita."'";
echo "<label class='col-md-12 col-sm-12 col-xs-12 control-label'>Hora asignada a la cita:</label>";
echo "<div class='col-md-8 col-sm-8 col-xs-8'>";
echo "<select id = 'horarioTextEvento' class='form-control'>";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	echo "<option value = '".$row["idHorario"]."'>".$row["horario"]."</option>";
}

$sql = "SELECT * from Horario where idHorario not in (SELECT Horario_idHorario from Cita where SUBSTRING(fecha,1,10) = SUBSTRING('".$fecha."',1,10) AND Psicologa_idPsicologa = '".$idPsicologa."') AND idHorario not in (SELECT Horario_idHorario from Plantilla where DiasSemana_idDiasSemana = '".$diaSemana."' AND Psicologa_idPsicologa = '".$idPsicologa."') order by idHorario ASC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	echo "<option value = '".$row["idHorario"]."'>".$row["horario"]."</option>";
}
echo "</select></div>";

?>