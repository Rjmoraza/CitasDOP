<?php
$carrera = $_GET['carrera'];

include("database.php");

$sql = "INSERT INTO Carrera (carrera) values ('".$carrera."')";
$result = mysqli_query($conn, $sql);

echo "Inserción exitosa";
?>
