
<?php
require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
require '/usr/share/php/libphp-phpmailer/class.smtp.php';
include("/var/www/html/citaDOP/php/database.php");

$estudiante = $_POST['estudiante'];
$psicologa = $_POST['psicologa'];
$dia = $_POST['dia'];
$hora = $_POST['hora'];

echo date("Y-m-d", strtotime("+1 day"));

//$estudiante = 'rasevedo9@gmail.com';
$psicologa = 'soy psicólogo';
$dia = '2019-04-08';
$hora = "12pm";

$mail = new PHPMailer;

$sql = "SELECT correo, idCita, nombre, time(fecha) FROM Cita,Estudiante,Persona WHERE date(fecha) = '2019-04-09' and Estudiante_idEstudiante = idEstudiante and Persona_idPersona = idPersona ";

$result = mysqli_query($conn, $sql);


//$sql = "SELECT correo FROM Persona WHERE idPersona = 11";
//$result = mysqli_query($conn, $sql); 
//  while($row = mysqli_fetch_assoc($result)) {
//      $remitente = $row["correo"];
//  }


$mail->isHTML(true);
$mail->setFrom('citadoptecj@gmail.com', 'citaDOP');
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl';
$mail->Host = 'ssl://smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Port = 465;
//$mail->addAddress('rasevedo9@gmail.com');

//Set your existing gmail address as user name
$mail->Username = 'citadoptecj@gmail.com';
//Set the password of your gmail address here
$mail->Password = 'citadop123';

while($row = mysqli_fetch_assoc($result)) {
    $correoE = $row["correo"];
    $nombreE = $row["nombre"];
    $horaC = $row["time(fecha)"];
//    echo "<br></br>";
//    echo $correoE;
//    echo "<br></br>";
//    echo $nombreE;
//    echo "<br></br>";
//    echo $horaC;
//    echo "<br></br>";

	$mail->addAddress($correoE);
//$mail->addAddress($psicologa);
	$mail->Subject = 'Recordatorio de cita asesoría psicoeducativa';
	$mail->Body = 'Saludos cordiales ' .$nombreE .', se le recuerda que el día de mañana ('  .date("d-m-Y", strtotime("+1 day")) .') tiene cita de asesoría psicoeducativa. A las ' .$horaC .'en el Departamento de Orientación y Psicología. <br></br> <b><u>IMPORTANTE:</u></b> <br></br> Sea puntual: si llega después de 15 minutos, la cita se cancela.';

	if(!$mail->send()) {
	  echo 'El correo no se envió.';
	  echo 'Email error: ' . $mail->ErrorInfo;
	} else {
	  echo 'Correo enviado';
	}
}

?>