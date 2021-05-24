<?php

//abrir la sesion
session_start();
include '../helper.php';
include '../connection.php';

$error = array();

$user = get_user_info($con, $_SESSION['id']);
$emailProfesor = $user['email'];
$idClase = $_POST['idClase'];
$cero = 0;
$validador = 0;

if (empty($error)){

    /* **************** ACTUALIZANDO TABLA DE DATOS **************** */

    /* ENCONTRANDO ESTUDIANTES EN CLASE */

    $query = "SELECT student_id FROM student_srms WHERE email_profesor=? AND clase_en_vivo=?";
    
    $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);

    // bind parameter
    mysqli_stmt_bind_param($q, 'si', $emailProfesor, $idClase);
    
     // execute statement
    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_all($result);

     if(mysqli_stmt_affected_rows($q) > 0){

        print "Estudiantes encontrados";

        print_r($row);

        $validador = 0;

        /* * CERRANDO LA CLASE PARA LOS ESTUDIANTES ENCONTRADOS * */

        foreach ($row as $idEstudiante):

            /* print_r ($idEstudiante); */
            echo ($idEstudiante[0]);
            $student_id = $idEstudiante[0];

            $query = "UPDATE data_srms SET clase_en_vivo=0, current_subject_id=0, num=0 WHERE student_id=?";
    
            $q = mysqli_stmt_init($con);
            mysqli_stmt_prepare($q, $query);

            // bind parameter
            mysqli_stmt_bind_param($q, 'i', $student_id);
            
            // execute statement
            mysqli_stmt_execute($q);
            /* header('location: index.php');
            exit(); */
            $validador++;
            
        endforeach;

        if($validador > 0){
            echo ("Correcto: ".$validador);
            
        }else{
            echo ("Incorrecto, ningun estudiante actualizado".$validador);
        }
         
     }else{
         print "Estudiantes NO encontrados...";
     }

    //INSERTANDO CEROS PARA ACTUALIZAR A TODOS LOS ESTUDIANTES

    /* **************** ACTUALIZANDO TABLA DE ESTUDIANTES **************** */

    $query = "UPDATE student_srms SET clase_en_vivo=? WHERE email_profesor=? AND clase_en_vivo=?";
    
    $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);

    // bind parameter
    mysqli_stmt_bind_param($q, 'isi', $cero, $emailProfesor, $idClase);
    
     // execute statement
     mysqli_stmt_execute($q);

     if(mysqli_stmt_affected_rows($q) > 0 && $validador > 0){

        print "Actualizado correctamente";
        header('location: index.php');
        exit();
         
     }else{
         print "Error al actualizar!";
     }

    

    //INSERTANDO CEROS PARA ACTUALIZAR A TODOS LOS ESTUDIANTES
 
 }else{
     /* echo 'no valido'; */
     
 }

?>