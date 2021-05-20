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
$validador = 0;

if (empty($error)){

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
            
            /* header('location: modificar_producto.php?exito=true');
            exit(); */
            /* echo "<div style='color:green'><h6>Producto ingresado correctamente!</h6></div>"; */
        }else{
            print "Error al actualizar!";
        }

        //INSERTANDO CEROS PARA ACTUALIZAR LA TABLA DE DATOS (num)

        $query = "UPDATE data_srms SET num=? WHERE student_id=?";
        
        $q = mysqli_stmt_init($con);
        mysqli_stmt_prepare($q, $query);

        // bind parameter
        mysqli_stmt_bind_param($q, 'is', $cero, $id);
        
        // execute statement
        mysqli_stmt_execute($q);

        if(mysqli_stmt_affected_rows($q) > 0){

            print "Actualizado correctamente";
            
        }else{
            print "Error al actualizar!";
        }

        //INSERTANDO CEROS PARA ACTUALIZAR LA TABLA DE DATOS (num)

        $query = "INSERT INTO data_srms (student_id, clase_en_vivo) VALUES(?, ?) ON DUPLICATE KEY UPDATE clase_en_vivo=?";
        
        $q = mysqli_stmt_init($con);
        mysqli_stmt_prepare($q, $query);

        // bind parameter
        mysqli_stmt_bind_param($q, 'iii', $id, $idClase, $idClase);
        
        // execute statement
        mysqli_stmt_execute($q);

        echo ($id . ": Tabla de estadísticas actualizada correctamente<br>");
        $validador++;
                /* header('location: modificar_producto.php?exito=true');
                exit(); */
                /* echo "<div style='color:green'><h6>Producto ingresado correctamente!</h6></div>"; */
        
        

    endforeach;

    if($validador > 0){
        echo ("Correcto: ".$validador);
        header('location: monitorClase.php?clase='.$idClase);
        exit();
    }else{
        echo ("Incorrecto, ningun estudiante encontrado".$validador);
    }

     //INGRESANDO ID CLASE A LOS ESTUDIANTES SELECCIONADOS PARA LA CLASE
 
 }else{
     /* echo 'no valido'; */
     
 }

?>