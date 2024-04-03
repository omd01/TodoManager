<?php 
require_once 'config.php';
require_once 'PHPMailer/PHPMailerAutoload.php';



$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               
$mail->isSMTP();                                      
$mail->Host = MAILHOST;  
$mail->SMTPAuth = true;                           
$mail->Username = EMAIL;       
$mail->Password = SECRET;               
$mail->SMTPSecure = MAILSECURE;                       
$mail->Port = MAILPORT;                                 

$mail->setFrom(EMAIL, 'Todo Manager');
$mail->addReplyTo(EMAIL, 'Todo Manager');
$mail->isHTML(true);   

?>