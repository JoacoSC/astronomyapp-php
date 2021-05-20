<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/Exception.php';
require 'vendor/phpmailer/PHPMailer.php';
require 'vendor/phpmailer/SMTP.php';

require('helper.php');

$error = array();

$nombre         = validar_input_text($_POST['nombre']);
if(empty($nombre)){
    $error[] = "Olvidaste ingresar tu nombre";
}

$apellidoPat         = validar_input_text($_POST['apellidoPat']);
if(empty($apellidoPat)){
    $error[] = "Olvidaste ingresar tu apellido paterno";
}

$apellidoMat         = validar_input_text($_POST['apellidoMat']);
if(empty($apellidoMat)){
    $error[] = "Olvidaste ingresar tu apellido materno";
}

$rut         = $_POST['rut'];
if(empty($rut)){
    $error[] = "Olvidaste ingresar tu rut";
}

$dv         = $_POST['dv'];

$email         = validar_input_email($_POST['email']);
if(empty($email)){
    $error[] = "Olvidaste ingresar tu email";
}



$telefono         = validar_input_text($_POST['telefono']);
if(empty($telefono)){
    $error[] = "Olvidaste ingresar tu telefono";
}

$fecha_nac         = validar_input_text($_POST['fecha_nac']);
if(empty($fecha_nac)){
    $error[] = "Olvidaste ingresar tu fecha de nacimiento";
}

$region         = $_POST['region'];
if(empty($region)){
    $error[] = "Olvidaste ingresar tu región";
}

$comuna         = $_POST['comuna'];
if(empty($comuna)){
    $error[] = "Olvidaste ingresar tu comuna";
}

if($_POST["teacher_institution"] != 'otro'){
    $inst 		=	$_POST["teacher_institution"];
}else{
    $inst 		=	$_POST["other_teacher_institution"];
    $campus 		=	$_POST["other_teacher_institution_campus"];

    $query = "INSERT INTO institution_srms (institution_name, institution_campus)";
    
    $query .= " VALUES(?, ?)";

    // initialize a statement
    $q = mysqli_stmt_init($con);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    // bind values
    mysqli_stmt_bind_param($q, 'ss', $inst, $campus);

    // execute statement
    mysqli_stmt_execute($q);

    $query = "SELECT MAX(institution_id) FROM institution_srms";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    /* mysqli_stmt_bind_param($q, 's', $inst_id); */

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);

    $inst = $row[0];
}

// crear nueva contraseña *******************
$rut = $_POST['rut'];
$nombre = $_POST['nombre'];
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

if(empty($error)){
    
    require ('connection.php');

    $query = "SELECT * FROM teacher_srms WHERE email = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $email);

    // execute sql statement
    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row_count = mysqli_num_rows($result);

    if($row_count > 0)
    {
        header('location: register.php?fallo=true');
        exit();
    }
    else
    {

        $query = "INSERT INTO teacher_srms (nombre, apellido_pat, apellido_mat, rut, dv, email, contraseña, telefono, fecha_nac, region, comuna, institution, verification_token)";
        /* VALUES ('$nombre', '$apellidoPat','$apellidoMat','$rut','$email','". md5($contraseña)."','$telefono','$fecha_nac','$region','$comuna')"); */
        $query .= "VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // initialize a statement
        $q = mysqli_stmt_init($con);

        // prepare sql statement
        mysqli_stmt_prepare($q, $query);

        // bind values
        mysqli_stmt_bind_param($q, 'sssssssssssss', $nombre, $apellidoPat, $apellidoMat, $rut, $dv, $email, $hashed_pass, $telefono, $fecha_nac, $region, $comuna, $inst, $verification_token);

        // execute statement
        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) == 1){

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

            /* header('location: login.php');
            exit(); */
        }else{
            header('location: register.php?error=true');
            exit();
        }
    }

}else{
    echo 'no valido';
    
}

?>

