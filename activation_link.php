<?php

require ('connection.php');

    if(isset($_GET["verification_token"]) && isset($_GET["email"])){

        $token = $_GET["verification_token"];
        $email = $_GET["email"];

        $query = "SELECT * FROM teacher_srms WHERE email = ?";

        $q = mysqli_stmt_init($con);

        mysqli_stmt_prepare($q, $query);

        // bind the statement
        mysqli_stmt_bind_param($q, 's', $email);

        // execute sql statement
        mysqli_stmt_execute($q);
        $result = mysqli_stmt_get_result($q);

        $row = mysqli_fetch_array($result);

        if (!empty($row)){
            if($row['verification_token'] == $token){

                /* ************* ACTIVANDO PERFIL************* */

                $query = "UPDATE teacher_srms SET activation = 1 WHERE email = ? AND verification_token = ?";
    
                $q = mysqli_stmt_init($con);
                mysqli_stmt_prepare($q, $query);

                // bind parameter
                mysqli_stmt_bind_param($q, 'ss', $email, $token);
                
                // execute statement
                mysqli_stmt_execute($q);

                if(mysqli_stmt_affected_rows($q) > 0){

                    header('location: successful_activation.php');
                    exit();
                    
                }else{
                    header('location: successful_activation.php?fallo=true');
                    exit();
                }

                /* ************* ACTIVANDO PERFIL************* */
            }else{
                echo 'No activar perfil';
            }
        }else{
            echo 'Email no encontrado...';
        }
    }else{
        echo 'Parece que estas perdido...';
    }

?>


    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
    </div>
    
<?php


?>