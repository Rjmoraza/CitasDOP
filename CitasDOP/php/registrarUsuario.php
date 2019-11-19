<?php
$nombre = $_GET['nombre'];
$apellido1 = $_GET['apellido1'];
$apellido2 = $_GET['apellido2'];
$carnet = $_GET['carnet'];
$telefono = $_GET['telefono'];
$dia = $_GET['dia'];
$mes = $_GET['mes'];
$anio = $_GET['anio'];
$correo = $_GET['correo'];
$carrera = $_GET['carrera'];
$sexo = $_GET['sexo'];
$usuario2 = $_GET['usuario2'];
$contrasenia2 = $_GET['contrasenia2'];

include("database.php");

$fechaNacimiento = $anio . "-" . $mes . "-" . $dia . " 00:00:00";
$mensaje = "";
$id = 0;

$sql = "SELECT * FROM `Persona`";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	if($row["correo"] == $correo){
		$id = $row["idPersona"];
		$mensaje = "Correo ocupado";
	}
	if($row["usuario"] == $usuario2){
		$id = $row["idUsuario"];
		$mensaje = "Usuario ocupado";
	}
	if($row["telefono"] == $telefono){
		$id = $row["idUsuario"];
		$mensaje = "Teléfono ocupado";
	}
}
if($id == 0){
	$sql = "SELECT * FROM `Estudiante` where carnet = ".$carnet."";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		$id = $row["idEstudiante"];
	}
	if($id == 0){
		$sql = "INSERT INTO Persona (nombre, primerApellido, segundoApellido, correo, usuario, contrasenia) values ('".$nombre."', '".$apellido1."', '".$apellido2."', '".$correo."', '".$usuario2."', '".$contrasenia2."')";
		$result = mysqli_query($conn, $sql);

		$id2 = mysqli_insert_id($conn);

		$sql = "INSERT INTO Estudiante (carnet, telefono, Sexo_idSexo, Carrera_idCarrera, Persona_idPersona, fechaNacimiento) values ('".$carnet."', '".$telefono."', '".$sexo."', '".$carrera."', '".$id2."', '".$fechaNacimiento."')";
		$result = mysqli_query($conn, $sql);

		echo "Registro exitoso";
	}
	else{
		echo "Carné ocupado";
	}
}
else{
	echo $mensaje;
}
mysqli_close($conn);
?>
