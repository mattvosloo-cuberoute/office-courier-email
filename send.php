<?php
/*Send/Thankyou Page*/

require 'PHPMailer/class.phpmailer.php';

$email = $_POST['email'];
$id = $_POST['id'];
$template = $_POST['template'];
$name = $_POST['name'];
$waybill = $_POST['waybill'];
$full_address = $_POST['full_address'];

$templateUrl = "template-" . $template . ".html";

$tpl = file_get_contents($templateUrl);
$tpl = str_replace('{{name}}', $name, $tpl);
$tpl = str_replace('{{order}}', $id, $tpl);
$tpl = str_replace('{{full_address}}', $full_address, $tpl);
$tpl = str_replace('{{waybill}}', $waybill, $tpl);

$mail = new PHPMailer;

//$mail->IsSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.epetstore-comms.co.za';                 // Specify main and backup server
$mail->Port = 587;                                    // Set the SMTP port
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'no-reply@epetstore-comms.co.za';                // SMTP username
$mail->Password = 'Any14tennis!@#$';                  // SMTP password
//$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'no-reply@epetstore-comms.co.za';
$mail->FromName = 'ePETstore';
$mail->AddAddress($email, $name);  // Add a recipient
$mail->AddBCC("info@cuberoute.co.za");  // Add a recipient

$mail->IsHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Delivery Notice - Order: #'.$id;
$mail->Body    = $tpl;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

?>

<html>
    <head>
        <title>ePETstore Delivery Emailer</title>
        <meta name="description" content="Creates delivery emails for ePET">
        
        <link href="css/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <header>
            <h1>ePETstore Delivery Emailer</h1>
        </header>
        <content>

                <?php


                if(!$mail->Send()) {
                   echo '<h4>Message could not be sent</h4>';
                   echo '<h6>Mailer Error: ' . $mail->ErrorInfo . '</h6>';
                   exit;
                }

                echo '<h4>Message has been sent</h4><p><a href="index.php">click here to restart</a></p>';

                ?>
             </content>
        <footer>
            <marquee scrollamount="20" width="500px"><img src="http://farm4.static.flickr.com/3484/3696757249_d353f90a53_o.gif" width="139" height="200"></marquee>
        </footer>
        
    </body>
    
</html>