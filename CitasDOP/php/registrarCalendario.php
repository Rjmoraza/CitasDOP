<?php
	
	$carnet = $_GET['carnet'];
	$nivel = $_GET['nivel'];
	$cursos = $_GET['cursos'];
	$creditos = $_GET['creditos'];
	$motivo = $_GET['motivo'];
	$horario = $_GET['horario'];
	$urgencia = $_GET['urgencia'];
	$observacion = $_GET['observacion'];

	//include("database.php");
	$pdo=new PDO("database.php");

	session_start();

	$sql = "SELECT idCita, carnet, Nivel_idNivel, cantidadCursos, cantidadCreditos, motivo, horario, Urgencia_idUrgencia, observación FROM Estudiante,Cita, Motivo, Horario";
	$result = mysqli_query($conn, $sql);

	if($_idCita==0){
		$sql = "INSERT INTO Calendario(Estudiante_carnet, Nivel_idNivel, cantidadCursos, cantidadCreditos, Horario_idHorario, Urgencia_idUrgencia, observación) values ('".$carnet."', '".$nivel"', '".$cursos."', '".$creditos."', '".$horario."', '".$urgencia."', ".$observacion."')";

		$motivos = explode("¬", $motivo);
		$cantidadMotivos = count($motivos);
		for($conti = 0; $conti < $cantidadMotivos-1; $conti++){
		    $sql = "INSERT INTO Cita_has_Motivo(Cita_idCita, Motivo_idMotivo) values ('".$idCita."', '".$motivos[$conti]."')";
		    $result = mysqli_query($conn, $sql);

		    echo "Registro exitoso";
	}
	else{
		echo "Cita ocupada";
	}

	$sentencia= $pdo->prepare("SELECT idCita, carnet, Nivel_idNivel, cantidadCursos, cantidadCreditos, motivo, horario, Urgencia_idUrgencia, observación FROM Estudiante,Cita, Motivo, Horario");
	$sentencia->execute();
	

	mysqli_close($conn);

?>
