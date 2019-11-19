<?php
$referencia = $_GET['referencia'];

include("database.php");

$sql = "INSERT INTO Referencia (referencia) values ('".$referencia."')";
$result = mysqli_query($conn, $sql);

echo "Inserción exitosa";
?>
