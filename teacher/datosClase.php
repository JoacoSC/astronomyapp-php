<?php

//abrir la sesion
session_start();
include '../helper.php';
include '../connection.php';

$error = array();

$arrayEstudiantes = $_POST["estudiantesArray"];
$user = get_user_info($con, $_SESSION['id']);
$emailProfesor = $user['email'];
$idClase = $_POST['idClase'];
$cero = 0;

print_r($arrayEstudiantes);

if (empty($error)){

    //INSERTANDO CEROS PARA ACTUALIZAR A TODOS LOS ESTUDIANTES

    $query = "UPDATE estudiante SET id_clase=? WHERE email_profesor=?";
    
    $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);

    // bind parameter
    mysqli_stmt_bind_param($q, 'is', $cero, $emailProfesor);
    
     // execute statement
     mysqli_stmt_execute($q);

     if(mysqli_stmt_affected_rows($q) > 0){

        print "Actualizado correctamente";
         
     }else{
         print "Error al actualizar!";
     }

    //INSERTANDO CEROS PARA ACTUALIZAR A TODOS LOS ESTUDIANTES

    //INGRESANDO ID CLASE A LOS ESTUDIANTES SELECCIONADOS PARA LA CLASE

    foreach ($arrayEstudiantes as $id) :

        $query = "UPDATE estudiante SET id_clase=? WHERE id=?";
        
        $q = mysqli_stmt_init($con);
        mysqli_stmt_prepare($q, $query);

        // bind parameter
        mysqli_stmt_bind_param($q, 'is', $idClase, $id);
        
        // execute statement
        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) > 0){


        print "Actualizado correctamente";
            /* header('location: modificar_producto.php?exito=true');
            exit(); */
            /* echo "<div style='color:green'><h6>Producto ingresado correctamente!</h6></div>"; */
        }else{
            print "Error al actualizar!";
        }

    endforeach;

     //INGRESANDO ID CLASE A LOS ESTUDIANTES SELECCIONADOS PARA LA CLASE
 
 }else{
     /* echo 'no valido'; */
     
 }

?>