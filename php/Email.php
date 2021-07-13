
<?php
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function SendMail($mail_body,$receiver)
{
    $mail = new PHPMailer(true);
    $mail->setLanguage('ru');
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->SMTPDebug = 0;
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.beget.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'admin@gorodskie-meropriyatiya.site';                     //SMTP username
        $mail->Password = 'B%3GU4jM';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port = 2525;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->CharSet = 'UTF-8';
        //Recipients
        $mail->setFrom('admin@gorodskie-meropriyatiya.site', 'Гордские мероприятия');
        $mail->addAddress($receiver);               //Name is optional

        //Attachments

        //Content
                                     //Set email format to HTML
        $mail->Subject = 'Подтверждение регистрации';
        $mail->Body = $mail_body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->isHTML(true);

        $mail->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo json_encode(array("status"=>"fail","description"=>" {$mail->ErrorInfo}"));
        exit();
    }
}
?>