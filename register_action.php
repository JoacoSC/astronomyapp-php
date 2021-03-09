<?php

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
    $error[] = "Olvidaste ingresar tu región";
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

if(empty($error)){
    
    require ('connection.php');

    $query = "INSERT INTO profesor (id, nombre, apellido_pat, apellido_mat, rut, email, contraseña, telefono, fecha_nac, region, comuna)";
    /* VALUES ('$nombre', '$apellidoPat','$apellidoMat','$rut','$email','". md5($contraseña)."','$telefono','$fecha_nac','$region','$comuna')"); */
    $query .= "VALUES('', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // initialize a statement
    $q = mysqli_stmt_init($con);

    // prepare sql statement
    mysqli_stmt_prepare($q, $query);

    // bind values
    mysqli_stmt_bind_param($q, 'ssssssssss', $nombre, $apellidoPat, $apellidoMat, $rut, $email, $hashed_pass, $telefono, $fecha_nac, $region, $comuna);

    // execute statement
    mysqli_stmt_execute($q);

    if(mysqli_stmt_affected_rows($q) == 1){

        header('location: login.php');
        exit();
    }else{
        print "Error while registration...!";
    }

}else{
    /* echo 'no valido'; */
    
}


/* include 'connection.php';
if (isset($_POST['email'])) {

$nombre         = $_POST['nombre'];
$apellidoPat    = $_POST['apellidoPat'];
$apellidoMat    = $_POST['apellidoMat'];
$rut            = $_POST['rut'];
$dv             = $_POST['dv'];
$email          = $_POST['email'];
$contraseña     = $_POST['contraseña'];
$telefono       = $_POST['telefono'];
$fecha_nac      = $_POST['fecha_nac'];
$region         = $_POST['region'];
$comuna         = $_POST['comuna'];

$register = $mysqli->query("INSERT INTO profesor (nombre, apellido_pat, apellido_mat, rut, dv, email, contraseña, telefono, fecha_nac, region, comuna) 
                                        VALUES ('$nombre', '$apellidoPat','$apellidoMat','$rut','$dv','$email','". md5($contraseña)."','$telefono','$fecha_nac','$region','$comuna')");
if ($register) {
header("Location: registroProfesor.php?register_action=success");

echo'<script type="text/javascript">
    alert("Registrado correctamente");
    window.location.href="login.php";
    </script>';
} else {
echo $mysqli->error;
}
} */

/* '". md5($password)."' */
?>

