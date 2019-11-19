
<?php
$idReferencia = $_GET['idReferencia'];

include("database.php");

$sql = "DELETE FROM Referencia WHERE idReferencia = '".$idReferencia."'";

$result = mysqli_query($conn, $sql);

echo "Eliminación exitosa";
?>