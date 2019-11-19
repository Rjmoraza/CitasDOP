
<?php
require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
require '/usr/share/php/libphp-phpmailer/class.smtp.php';
include("database.php");

$pUsuario= $_POST['usuarioRText'];
$pCorreo = $_POST['CorreoRText'];

//$pUsuario = 'david';
//$pCorreo = 'gato.palacios.6.1@gmail.com';

$mail = new PHPMailer;

$sql = "SELECT contrasenia FROM Persona WHERE  usuario = '" .$pUsuario ."' and '" .$pCorreo ."' = correo";
$result = mysqli_query($conn, $sql); 
while($row = mysqli_fetch_assoc($result)) {
	$contra = $row["contrasenia"];
}

$mail->isHTML(true);
$mail->setFrom('citadoptecj@gmail.com', 'citaDOP');

//$mail->addAddress('rasevedo9@gmail.com');

$mail->addAddress($pCorreo);
//$mail->addAddress($psicologa);
$mail->Subject = 'Recuperacion de contraseña';
$mail->Body = 'Buenas, su contraseña es: ' .$contra ;
$mail->IsSMTP();
$mail->SMTPSecure = 'ssl';
$mail->Host = 'ssl://smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Port = 465;


//Set your existing gmail address as user name
$mail->Username = 'citadoptecj@gmail.com';

//Set the password of your gmail address here
$mail->Password = 'citadop123';
if(!$mail->send()) {
  echo 'El correo no se envió.';
  echo 'Email error: ' . $mail->ErrorInfo;
} else {
  echo 'Correo enviado';
  header("location:../index.php");
}
?>