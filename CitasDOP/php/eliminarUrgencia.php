<?php
$idUrgencia = $_GET['idUrgencia'];

include("database.php");

$sql = "DELETE FROM Urgencia WHERE idUrgencia = '".$idUrgencia."'";

$result = mysqli_query($conn, $sql);

echo "Eliminación exitosa";
?>
