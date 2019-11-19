<?php
$motivo = $_GET['motivo'];

include("database.php");

$sql = "INSERT INTO Motivo (motivo) values ('".$motivo."')";
$result = mysqli_query($conn, $sql);

echo "Inserción exitosa";
?>
