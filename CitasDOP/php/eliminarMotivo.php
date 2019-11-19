
<?php
$idMotivo = $_GET['idMotivo'];

include("database.php");

$sql = "DELETE FROM Motivo WHERE idMotivo = '".$idMotivo."'";

$result = mysqli_query($conn, $sql);

echo "Eliminación exitosa";
?>