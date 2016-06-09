<?php
/*Send/Thankyou Page*/

require 'PHPMailer/class.phpmailer.php';

$email = $_POST['email'];
$template = $_POST['template'];
$name = $_POST['name'];
$id = $_POST['id'];

$templateUrl = "template-" . $template . ".html";

$tpl = file_get_contents($templateUrl);
$tpl = str_replace('{{name}}', $name, $tpl);
$tpl = str_replace('{{order}}', $id, $tpl);

echo $tpl;



$mail = new PHPMailer;

$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.epetstore-comms.co.za';                 // Specify main and backup server
$mail->Port = 587;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'no-reply@epetstore-comms.co.za';                // SMTP username
$mail->Password = '';                  // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'no-reply@epetstore-comms.co.za';
$mail->FromName = 'No-Reply | ePETstore';
$mail->AddAddress($email, $name);  // Add a recipient

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Delivery Notice';
$mail->Body    = $tpl;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->Send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}

echo 'Message has been sent';

?>