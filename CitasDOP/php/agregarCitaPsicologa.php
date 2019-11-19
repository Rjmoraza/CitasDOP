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
$estudiante = $_GET['estudiante'];
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

if($referencia == "¬"){
    $sql = "INSERT INTO Cita(Urgencia_idUrgencia, Horario_idHorario, fecha, Estudiante_idEstudiante, Psicologa_idPsicologa, observacion, Nivel_idNivel, cantidadCursos, cantidadCreditos) values ('".$urgencia."', '".$horario."', '".$fecha."', '".$estudiante."', '".$psicologa."','".$observacion."', '".$nivel."', '".$cursos."', '".$creditos."')";
    $result = mysqli_query($conn, $sql);
}
else{
    $sql = "INSERT INTO Cita(Urgencia_idUrgencia, Horario_idHorario, fecha, Estudiante_idEstudiante, Psicologa_idPsicologa, observacion, Nivel_idNivel, cantidadCursos, cantidadCreditos, Referencia_idReferencia) values ('".$urgencia."', '".$horario."', '".$fecha."', '".$estudiante."', '".$psicologa."','".$observacion."', '".$nivel."', '".$cursos."', '".$creditos."', '".$referencia."')";
    $result = mysqli_query($conn, $sql);
    
}

$idCita = mysqli_insert_id($conn);

$motivos = explode("¬", $motivo);
$cantidadMotivos = count($motivos);

for($conti = 0; $conti < $cantidadMotivos-1; $conti++){
    $sql = "INSERT INTO Cita_has_Motivo(Cita_idCita, Motivo_idMotivo) values ('".$idCita."', '".$motivos[$conti]."')";
    $result = mysqli_query($conn, $sql);
}

mysqli_close($conn);
?>
