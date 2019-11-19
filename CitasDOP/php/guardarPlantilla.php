<?php
$plantilla = $_GET['plantilla'];

include("database.php");
session_start();

$plantillaLista = explode("!", $plantilla);
$plantillaListaSize = count($plantillaLista);
unset($plantillaLista[$plantillaListaSize-1]);
$plantillaListaSize = count($plantillaLista);

$sql = "SELECT idPsicologa from Psicologa where Persona_idPersona = ".$_SESSION["usuarioActivo"]."";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)) {
	$idPsicologa = $row["idPsicologa"];
}
$sql = "DELETE FROM Plantilla where Psicologa_idPsicologa = '".$idPsicologa."'";
$result = mysqli_query($conn, $sql);

$x = 0;
while($x < $plantillaListaSize){
	$plantillaListaLista = explode("-" ,$plantillaLista[$x]);
	$sql = "INSERT INTO Plantilla(Horario_idHorario, DiasSemana_idDiasSemana, Psicologa_idPsicologa) values ('".$plantillaListaLista[0]."', '".$plantillaListaLista[1]."', '".$idPsicologa."')";
    $result = mysqli_query($conn, $sql);
	$x++;
}

?>
