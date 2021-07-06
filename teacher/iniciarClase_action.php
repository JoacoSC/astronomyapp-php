<?php

//abrir la sesion
session_start();
include '../helper.php';
include '../connection.php';

$error = array();

$arrayEstudiantes = $_POST["estudiantesArray"];

$_SESSION['students_array'] = array();
$_SESSION['students_array'] = $_POST["estudiantesArray"];

$user = get_user_info($con, $_SESSION['id']);
$emailProfesor = $user['email'];
$idClase = $_POST['idClase'];
/* $subject_id = $_POST['subject']; */

//Creando array multidimensional en variable de sesión

$temas = obtenerTemasClaseTeacher($con, $idClase);

$_SESSION['subjects_array'] = array();
$i = 0;

foreach($temas as $tema){
    if($i == 0){
        $subject_id = $tema[0];
        $subject_name = $tema[2];
        $_SESSION['subjects_array'][$i] = array('subject_id' => $subject_id, 'subject_name' => $subject_name, 'estado' => 'activo');
    }else{
        $subject_id = $tema[0];
        $subject_name = $tema[2];
        $_SESSION['subjects_array'][$i] = array('subject_id' => $subject_id, 'subject_name' => $subject_name, 'estado' => 'inactivo');
    }
    $i++;
}
/* 
Array ( [0] => Array ( [subject_id] => 159 [estado] => activo )
        [1] => Array ( [subject_id] => 160 [estado] => desactivo )
        [2] => Array ( [subject_id] => 161 [estado] => desactivo ) ) */

    /*  CREAR UN ARRAY MULTIDIMENSIONAL EN UNA VARIABLE DE SESION QUE CONTENGA:
        LOS ID DE LOS TEMAS DE LA CLASE,
        SI ESTAN ACTIVOS O NO
    */

$cero = 0;
$validador = 0;

if (!empty($_SESSION['subjects_array'])){

    //INSERTANDO CEROS PARA ACTUALIZAR A TODOS LOS ESTUDIANTES

    $query = "UPDATE student_srms SET clase_en_vivo=? WHERE email_profesor=?";
    
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

        $query = "UPDATE student_srms SET clase_en_vivo=? WHERE student_id=?";
        
        $q = mysqli_stmt_init($con);
        mysqli_stmt_prepare($q, $query);

        // bind parameter
        mysqli_stmt_bind_param($q, 'is', $idClase, $id);
        
        // execute statement
        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) > 0){

            echo ($id . ": Actualizado correctamente<br>");
            
        }else{
            print "Error al actualizar!";
        }

        //INSERTANDO CEROS PARA ACTUALIZAR LA TABLA DE DATOS (subject_id, progress)

        $query = "UPDATE data_srms SET current_subject_id=?, progress=? WHERE student_id=?";
        
        $q = mysqli_stmt_init($con);
        mysqli_stmt_prepare($q, $query);

        // bind parameter
        mysqli_stmt_bind_param($q, 'iii', $cero, $cero, $id);
        
        // execute statement
        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) > 0){

            print "Actualizado correctamente";
            
        }else{
            print "Error al actualizar!";
        }

        //INSERTANDO CEROS PARA ACTUALIZAR LA TABLA DE DATOS (subject_id, progress)

        $subject_id = $_SESSION['subjects_array'][0]['subject_id'];

        $query = "INSERT INTO data_srms (student_id, clase_en_vivo, current_subject_id) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE clase_en_vivo=? , current_subject_id=?";
        
        $q = mysqli_stmt_init($con);
        mysqli_stmt_prepare($q, $query);

        // bind parameter
        mysqli_stmt_bind_param($q, 'iiiii', $id, $idClase, $subject_id, $idClase, $subject_id);
        
        // execute statement
        mysqli_stmt_execute($q);

        echo ($id . ": Tabla de estadísticas actualizada correctamente<br>");
        $validador++;
        
    endforeach;

    if($validador > 0){
        echo ("Correcto: ".$validador);
            
        header('location: monitorClase.php?clase='.$idClase.'&subject_id='.$subject_id);
        exit();
        
    }else{
        echo ("Incorrecto, ningun estudiante encontrado".$validador);
    }

     //INGRESANDO ID CLASE A LOS ESTUDIANTES SELECCIONADOS PARA LA CLASE
 
 }else{
     /* echo 'no valido'; */
     
 }

?>