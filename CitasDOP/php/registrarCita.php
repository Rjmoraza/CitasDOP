<?php
$dia = $_GET['dia'];
$mes = $_GET['mes'];
$anio = $_GET['anio'];
$horario = $_GET['horario'];
$motivo = $_GET['motivo'];
$urgencia = $_GET['urgencia'];
$nivel = $_GET['nivel'];
$cursos = $_GET['cursos'];
$creditos = $_GET['creditos'];
$observacion = $_GET['observacion'];
$referencia = $_GET['referencia'];
$psicologa = $_GET['psicologa'];

include("database.php");

session_start();

$horarioAux = "";
$sql = "SELECT horario from Horario where idHorario = ".$horario."";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $horarioAux = $row["horario"];
}

$horarioAuxLista = explode(":", $horarioAux);

$fecha = $anio . "-" . $mes . "-" . $dia . " ".$horarioAuxLista[0].":00:00";

$sql = "SELECT idEstudiante from Estudiante where Persona_idPersona = ".$_SESSION["usuarioActivo"]."";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
    $idEstudiante = $row["idEstudiante"];
}

if($psicologa == "¬"){
    

	//INICIO SELECCION PSICOLOGA


	$listaPsicologas = array();
	$sql = "SELECT idPsicologa FROM Psicologa";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		array_push($listaPsicologas, $row["idPsicologa"]) ;
	}
	$listaPsicologasSize = count($listaPsicologas);

	$diaSemana = "";
	$sql = "SELECT DAYOFWEEK('".$fecha."') as fecha";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		$diaSemana = $row["fecha"];
	}

	$listaPsicologasOcupadas = array();
	$sql = "SELECT Psicologa_idPsicologa FROM `Cita` WHERE Horario_idHorario = '".$horario."' AND fecha = Date_format('".$fecha."', '%Y-%m-%d')";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		array_push($listaPsicologasOcupadas, $row["Psicologa_idPsicologa"]) ;
	}

	$sql = "SELECT Psicologa_idPsicologa from Plantilla where Horario_idHorario = '".$horario."' and DiasSemana_idDiasSemana = '".$diaSemana."'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		array_push($listaPsicologasOcupadas, $row["Psicologa_idPsicologa"]) ;
	}

	$listaPsicologasOcupadasSize = count($listaPsicologasOcupadas);

	if($listaPsicologasSize - $listaPsicologasOcupadasSize == 1){ //Solo hay una psicologa disponible en ese horario
		for($x = 0; $x < $listaPsicologasSize; $x++){
			if(!in_array($listaPsicologas[$x], $listaPsicologasOcupadas)){
				$psicologa = $listaPsicologas[$x];
			}
		}
	}
	else{//Hay varias psicologas disponibles en ese horario
		$listaPlantillaCount = array();
		$listaPlantillaPsicologa = array();
		$sql = "SELECT count(Psicologa_idPsicologa), Psicologa_idPsicologa FROM Plantilla where DiasSemana_idDiasSemana = '".$diaSemana."' GROUP by Psicologa_idPsicologa";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			array_push($listaPlantillaCount, $row["count(Psicologa_idPsicologa)"]) ;
			array_push($listaPlantillaPsicologa, $row["Psicologa_idPsicologa"]) ;
		}

		$listaCitaCount = array();
		$listaCitaPsicologa = array();
		$sql = "SELECT count(Psicologa_idPsicologa), Psicologa_idPsicologa FROM Cita where fecha = Date_format('".$fecha."', '%Y-%m-%d') GROUP by Psicologa_idPsicologa";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			array_push($listaCitaCount, $row["count(Psicologa_idPsicologa)"]) ;
			array_push($listaCitaPsicologa, $row["Psicologa_idPsicologa"]) ;
		}

		$listaPsicologasDesocupadas = array();
		for($x = 0; $x < $listaPsicologasSize; $x++){
			if(!in_array($listaPsicologas[$x], $listaPsicologasOcupadas)){
				array_push($listaPsicologasDesocupadas, $listaPsicologas[$x]);
			}
		}
		$listaPsicologasDesocupadasSize = count($listaPsicologasDesocupadas);

		$listaPsicologasDenominador = array();
		for($x = 0; $x < $listaPsicologasDesocupadasSize; $x++){
			if(in_array($listaPsicologasDesocupadas[$x], $listaPlantillaPsicologa)){
				array_push($listaPsicologasDenominador, 11-$listaPlantillaCount[array_search($listaPsicologasDesocupadas[$x], $listaPlantillaPsicologa)]);
			}
			else{
				array_push($listaPsicologasDenominador, 11);
			}
		}
		$listaPsicologasNumerador = array();
		for($x = 0; $x < $listaPsicologasDesocupadasSize; $x++){
			if(in_array($listaPsicologasDesocupadas[$x], $listaCitaPsicologa)){
				array_push($listaPsicologasNumerador, $listaCitaCount[array_search($listaPsicologasDesocupadas[$x], $listaCitaPsicologa)]);
			}
			else{
				array_push($listaPsicologasNumerador, 0.1);
			}
		}

		$menor = 2;
		$menorIndice = 0;
		for($x = 0; $x < $listaPsicologasDesocupadasSize; $x++){
			if(($listaPsicologasNumerador[$x] / $listaPsicologasDenominador[$x]) < $menor){
				$menor = $listaPsicologasNumerador[$x] / $listaPsicologasDenominador[$x];
				$menorIndice = $x;
			}
		}
		$psicologa = $listaPsicologasDesocupadas[$menorIndice];

	}


	//FIN SELECCION PSICOLOGA
	if($referencia == "¬"){
        $sql = "INSERT INTO Cita(Urgencia_idUrgencia, Horario_idHorario, fecha, Estudiante_idEstudiante, Psicologa_idPsicologa, observacion, Nivel_idNivel, cantidadCursos, cantidadCreditos) values ('".$urgencia."', '".$horario."', '".$fecha."', '".$idEstudiante."', '".$psicologa."','".$observacion."', '".$nivel."', '".$cursos."', '".$creditos."')";
        $result = mysqli_query($conn, $sql);
    }
    else{
        $sql = "INSERT INTO Cita(Urgencia_idUrgencia, Horario_idHorario, fecha, Estudiante_idEstudiante, Psicologa_idPsicologa, observacion, Nivel_idNivel, cantidadCursos, cantidadCreditos, Referencia_idReferencia) values ('".$urgencia."', '".$horario."', '".$fecha."', '".$idEstudiante."', '".$psicologa."','".$observacion."', '".$nivel."', '".$cursos."', '".$creditos."', '".$referencia."')";
        $result = mysqli_query($conn, $sql);
    }
}
else{
    if($referencia == "¬"){
        $sql = "INSERT INTO Cita(Urgencia_idUrgencia, Horario_idHorario, fecha, Estudiante_idEstudiante, Psicologa_idPsicologa, observacion, Nivel_idNivel, cantidadCursos, cantidadCreditos) values ('".$urgencia."', '".$horario."', '".$fecha."', '".$idEstudiante."', '".$psicologa."','".$observacion."', '".$nivel."', '".$cursos."', '".$creditos."')";
        $result = mysqli_query($conn, $sql);
    }
    else{
        $sql = "INSERT INTO Cita(Urgencia_idUrgencia, Horario_idHorario, fecha, Estudiante_idEstudiante, Psicologa_idPsicologa, observacion, Nivel_idNivel, cantidadCursos, cantidadCreditos, Referencia_idReferencia) values ('".$urgencia."', '".$horario."', '".$fecha."', '".$idEstudiante."', '".$psicologa."','".$observacion."', '".$nivel."', '".$cursos."', '".$creditos."', '".$referencia."')";
        $result = mysqli_query($conn, $sql);
        
    }
}

$idCita = mysqli_insert_id($conn);
$motivos = explode("¬", $motivo);
$cantidadMotivos = count($motivos);

for($conti = 0; $conti < $cantidadMotivos-1; $conti++){
    $sql = "INSERT INTO Cita_has_Motivo(Cita_idCita, Motivo_idMotivo) values ('".$idCita."', '".$motivos[$conti]."')";
    $result = mysqli_query($conn, $sql);
}
echo "Cita reservada";
session_destroy();
mysqli_close($conn);
?>