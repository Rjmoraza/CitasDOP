<?php
$idCarrera = $_GET['idCarrera'];
include("database.php");

$sql = "DELETE FROM Carrera WHERE idCarrera = '".$idCarrera."'";
$result = mysqli_query($conn, $sql);

echo "Eliminación exitosa";
?>
