<?php
$nombre = $_GET['nombre'];
$apellido1 = $_GET['apellido1'];
$apellido2 = $_GET['apellido2'];
$correo = $_GET['correo'];
$usuario = $_GET['usuario'];
$contrasenia = $_GET['contrasenia'];

$mensaje = "";

include("database.php");

$sql = "SELECT * FROM `Persona`";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	if($row["correo"] == $correo){
		$id = $row["idPersona"];
        $mensaje = "Correo ocupado";
	}
    if($row["usuario"] == $usuario){
        $id = $row["idPersona"];
        $mensaje = "Usuario ocupado";
    }
}
if($id == 0){
	$sql = "INSERT INTO Persona (nombre, primerApellido, segundoApellido, correo, usuario, contrasenia) values ('".$nombre."', '".$apellido1."', '".$apellido2."', '".$correo."', '".$usuario."', '".$contrasenia."')";
	$result = mysqli_query($conn, $sql);

	$id2 = mysqli_insert_id($conn);

	$sql = "INSERT INTO Psicologa (Persona_idPersona) values ('".$id2."')";
	$result = mysqli_query($conn, $sql);

	echo "Registro exitoso";
}
else{
	echo $mensaje;
}
    mysqli_close($conn);
?>
