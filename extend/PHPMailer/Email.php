<?php
namespace PHPMailer;
require 'PHPMailerAutoload.php';
class Email{
    /**
     * @param $to
     * @param $subject
     * @param $msg 当 isHtml=true时传入url地址
     * @return bool
     */
    public static function send($to,$subject,$msg){
        try{

            $mail = new \PHPMailer;
    //Tell PHPMailer to use SMTP
            $mail->isSMTP();
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
            $mail->SMTPDebug = 0;
    //Ask for HTML-friendly debug output
            $mail->Debugoutput = 'html';
    //Set the hostname of the mail server
            $mail->Host = config('email.host');
    //Set the SMTP port number - likely to be 25, 465 or 587
            $mail->Port = config('email.port');
            $mail->SMTPSecure = "ssl";
    //Whether to use SMTP authentication
            $mail->SMTPAuth = true;
    //Username to use for SMTP authentication
            $mail->Username = config('email.username');
    //Password to use for SMTP authentication
            $mail->Password = config('email.password');
    //Set who the message is to be sent from
            $mail->setFrom(config('email.username'), 'liu');
    //Set an alternative reply-to address
    //$mail->addReplyTo('742253912@qq.com', 'First Last');
    //Set who the message is to be sent to
            $mail->addAddress($to, 'John Doe');
    //Set the subject line
            $mail->Subject = $subject;
    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
            if(config('email.isHtml')){
                $mail->msgHTML(file_get_contents($msg));
            }else{
                $mail->msgHTML($msg);
            }

    //Replace the plain text body with one created manually

    //Attach an image file
    //        $mail->addAttachment('./examples/images/phpmailer_mini.png');

    //send the message, check for errors
            if (!$mail->send()) {
                return false;
            } else {
                return true;
            }
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
}