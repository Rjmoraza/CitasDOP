<?php
$urgencia = $_GET['urgencia'];

include("database.php");

$sql = "INSERT INTO Urgencia (referencia) values ('".$urgencia."')";
$result = mysqli_query($conn, $sql);

echo "Inserción exitosa";
?>
