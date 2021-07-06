<?php

//abrir la sesion
session_start();
include '../helper.php';
include '../connection.php';

$error = array();

$arrayEstudiantes = $_SESSION['students_array'];
$user = get_user_info($con, $_SESSION['id']);
$emailProfesor = $user['email'];
$idClase = $_POST['idClase'];
$nextSubject_id = $_POST['nextSubject'];

$cero = 0;
$validador = 0;

if (empty($error)){

    
    //INGRESANDO ID CLASE A LOS ESTUDIANTES SELECCIONADOS PARA LA CLASE

    foreach ($arrayEstudiantes as $id) :

        //ACTUALIZANDO EL TEMA ACTUAL DE LA CLASE E INSERTANDO CEROS PARA ACTUALIZAR LA TABLA DE DATOS ( progress)

        $query = "UPDATE data_srms SET current_subject_id=?, progress=? WHERE student_id=?";
        
        $q = mysqli_stmt_init($con);
        mysqli_stmt_prepare($q, $query);

        // bind parameter
        mysqli_stmt_bind_param($q, 'iii', $nextSubject_id, $cero, $id);
        
        // execute statement
        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) > 0){

            print "Actualizado correctamente";
            
        }else{
            print "Error al actualizar!";
        }

        $validador++;
        
    endforeach;

    if($validador > 0){
        
        echo ("Correcto: ".$validador);
        header('location: monitorClase.php?clase='.$idClase.'&subject_id='.$nextSubject_id);
        exit();
        
    }else{
        echo ("Incorrecto, ningun estudiante encontrado".$validador);
    }

     //INGRESANDO ID CLASE A LOS ESTUDIANTES SELECCIONADOS PARA LA CLASE
 
 }else{
     /* echo 'no valido'; */
     
 }

?>