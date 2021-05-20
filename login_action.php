<?php

//abrir la sesion
/* session_start(); */

$error = array();

$email = validar_input_email($_POST['email']);
if (empty($email)){
    $error[] = "Olvidaste ingresar tu email";
}

$contraseña = validar_input_text($_POST['contraseña']);
if (empty($contraseña)){
    $error[] = "Olvidaste ingresar tu contraseña";
}

if (empty($error)){
    // sql query
    $query = "SELECT * FROM teacher_srms WHERE email=?";
    $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);

    // bind parameter
    mysqli_stmt_bind_param($q, 's', $email);
    //execute query
    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if (!empty($row)){
    
        if(password_verify($contraseña, $row['contraseña'])){

            if($row['activation'] != 0){

                if($row['teacher_status'] != 'Habilitado'){

                    header("location: login.php?deshabilitado=true");

                }else{
            
                $_SESSION['id'] = $row['id'];
                print "Ingresaste correctamente";
                echo $_SESSION['id'];
            
                header("location: teacher/index.php");
                exit();
                }
            }else{
                header("location: login.php?no_activado=true");
            }
        }else{
            header("location: login.php?fallo=true");
        }
    
    }else{

        $query = "SELECT * FROM student_srms WHERE student_email_id=?";
        $q = mysqli_stmt_init($con);
        mysqli_stmt_prepare($q, $query);

        // bind parameter
        mysqli_stmt_bind_param($q, 's', $email);
        //execute query
        mysqli_stmt_execute($q);

        $result = mysqli_stmt_get_result($q);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (!empty($row)){
            // verify password
            if(password_verify($contraseña, $row['hashed_pass'])){
                if($row['student_status'] != 'Habilitado'){
                    header("location: login.php?deshabilitado=true");
                }else{
                
                // create session variable
                /* $_SESSION['id'] = mysqli_insert_id($con); */
                $_SESSION['id'] = $row['student_id'];
                print "Ingresaste correctamente";
                /* print_r ($row); */
                header("location: student/index.php");
                exit();
                }
            }else{
                header("location: login.php?fallo=true");
            }
            
        }else{
            header("location: login.php?not_record=true");
        }
    }
    

}else{
    echo "Por favor ingresa tus datos para ingresar";
}

?>