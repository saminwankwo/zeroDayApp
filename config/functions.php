<?php

    $today = date('Y-m-d H:i:s');
    use PHPMailer\PHPMailer\PHPMailer;

    // require 'phpmailer/PHPMailerAutoload.php';
    require 'config/phpmailer/src/PHPMailer.php';
    require 'config/phpmailer/src/SMTP.php';
    require 'config/phpmailer/src/Exception.php';

    function Mailer($email, $subject, $message){

        $mail = new PHPMailer(true);
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.zerodayproject.ng';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'noreply@zerodayproject.ng';                 // SMTP username
        $mail->Password = 'Ck]hQXE5b%tt';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
        
        $mail->setFrom('noreply@zerodayproject.ng', 'Zero Day Project');
        $mail->addAddress($email);               // Name is optional
        $mail->isHTML(true);                                  // Set email format to HTML
        
        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->AltBody = $message;

        if ($mail->send()) {
            return true;
        }
    }


    function ResetPassword($fullname, $key, $email,){
        
        $output = "<div style='padding: 1%'>";
    
        $output .= "<div style ='padding: 2%'>";
        $output .= "Dear $fullname, <p>";
        $output .= '<br>';
        $output .= '<p> Welcome!';
        $output .= "<p>Please click on the following link to set your password.</p>";
        $output .= '<p><a href="https://'. $_SERVER['HTTP_HOST'] .'/actions.php?key='.$key.'&email='.$email.'&action=set" target="_blank">Create Passord</a></p>';
        $output.='<p>Please be sure to copy the entire link into your browser. <b> The link will expire after 30 minuates for security reason.</b></p>';
        $output.='<p>If you did not request this forgotten password email, no action is needed, your password will not be set. However, you may want to log into your account and change your security password as someone may have guessed it.</p>';   	
        
        $output .= '<br><br>';

        $output .= '<br><br>';
        $output .= '<div class="row"><div class="">';
        $output .= "Best Regards,";
        $output .= '</div></div>';

        $subject = "Set New Password - Zero Day Project";

        $output .= '<div class=" text-justify">';
        $output .= '<i>';
        $output .= "Please do not reply to this e-mail,<p>";
 
        $output .= '</i>';
        $output .= '</div>';

        $message = $output;

        if (Mailer( $email, $subject, $message)) {
            return true;
        } 
    }


    function Is_email($user){
        if(filter_var($user, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

  

?>