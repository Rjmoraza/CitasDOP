<?php
include("database.php");

$sql = "SELECT * FROM `Referencia`";
$result = mysqli_query($conn, $sql);
echo "<br><label class='col-md-12 col-sm-12 col-xs-12 control-label'>Seleccione el departamento del que fue referido:</label><br><br><div class='col-md-12 col-sm-12 col-xs-12'>";
echo "<select id = 'referenciaText' class='form-control'>";
while($row = mysqli_fetch_assoc($result)) {
	echo "<option value='".$row["idReferencia"]."'>".$row["referencia"]."</option>";
}
echo "</select></div><br><br>";

?>
