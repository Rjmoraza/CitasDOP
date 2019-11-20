
<?php
require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
require '/usr/share/php/libphp-phpmailer/class.smtp.php';
include("database.php");

$estudiante = $_POST['estudiante'];
$psicologa = $_POST['psicologa'];
$dia = $_POST['dia'];
$hora = $_POST['hora'];

$mail = new PHPMailer;

$mail->isHTML(true);
$mail->setFrom('citadoptecj@gmail.com', 'citaDOP');
$mail->addAddress($estudiante);
$mail->addAddress($psicologa);
$mail->Subject = 'Asignación de cita asesoría psicoeducativa';
$mail->Body = 'Saludos cordiales, se ha recibido su solicitud de asesoría psicoeducativa. Según sus opciones de horario, su cita queda programada para: <br></br> <b>DIA:</b> '.$dia .'<br></br> <b>HORA: </b>' .$hora .'<br></br> <b>LUGAR:</b> Departamento de Orientación y Psicología. <br></br> <b><u>NOTAS IMPORTANTES:</u></b> <br></br>1. Cuando reciba el correo como la cita, por favor confirmar recibido al correo: ' .$psicologa .'<br></br> 2. Si por alguna razón no le es posible asistir a la cita indíquelo por correo electrónico, como mínimo con 24 horas de anticipación. <br></br> 3. Sea puntual: si llega después de 15 minutos, la cita se cancela. <br></br> 4. Si usted se ausenta a la cita o no cancela con anticipación, la misma se le reprogramará hasta que el asesor psicoeducativo tenga disponibilidad. <br></br> 5. Cualquier consulta adicional refiérase al correo: ' .$psicologa .'o directamente a la coordinación del programa. <br></br><br></br><br></br>Gracias por su atención'  ;
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
}
?>
