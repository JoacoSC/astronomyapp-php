<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/Exception.php';
require 'vendor/phpmailer/PHPMailer.php';
require 'vendor/phpmailer/SMTP.php';

require ('connection.php');

    $email = $_POST['email'];

    $query = "SELECT * FROM teacher_srms WHERE email = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $email);

    // execute sql statement
    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);

    $row_count = mysqli_num_rows($result);

    if($row_count < 1)
    {
        header('location: resend_email.php?fallo=true');
        exit();
    }
    else
    {   
        $email = $row['email'];

        // crear nueva contraseña *******************
        $rut = $row['rut'];
        $nombre = $row['nombre'];
        $primerResultado = substr($rut, 0, 4);
        /* echo $primerResultado; */

        $segundoResultado = substr($nombre, 0, 4);
        /* echo $segundoResultado;  */

        $contraseña = $primerResultado.$segundoResultado;

        //Eliminar caracteres especiales

        /* encriptar contraseña */
        $hashed_pass = password_hash($contraseña, PASSWORD_DEFAULT);

        // crear nueva contraseña *******************

        $verification_token = md5(uniqid());

        $query = "UPDATE teacher_srms SET contraseña = ?, verification_token = ? WHERE email = ?";
    
        $q = mysqli_stmt_init($con);
        mysqli_stmt_prepare($q, $query);

        // bind parameter
        mysqli_stmt_bind_param($q, 'sss', $hashed_pass, $verification_token, $email);
        
        // execute statement
        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) > 0){
        
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->CharSet    = 'UTF-8';                                // 
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'noreply.astronomyapp@gmail.com';                     //SMTP username
                $mail->Password   = 'astronomyapp';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('noreply.astronomyapp@gmail.com', 'Astronomyapp');
                $mail->addAddress($email, $nombre);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Activación de tu cuenta';
                $mail->Body    = '<br><b>Hola, '.$nombre.'!</b> Gracias por registrarte en Astronomyapp.<br><br>
                La contraseña para acceder a tu cuenta es: '.$contraseña.'<br><br>Recuerde <b>NUNCA</b> compartir su contraseña con terceros.<br><br>Haz clic 
                <a href="http://localhost/sbadmin_astronomyapp/activation_link.php?email='.$email.'&verification_token='.$verification_token.'">aquí</a>
                para activar tu cuenta.<br><br>';

                $mail->send();
                
                header('location: check_mail.php');
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

            /* header('location: login.php');
            exit(); */
        
    }