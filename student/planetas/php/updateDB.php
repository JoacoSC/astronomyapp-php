<?php
session_start();
include '../../../connection.php';

$student_id = $_SESSION['id'];
$scoreID = $_SESSION['scoreID'];
$action = $_POST['action'];

/*
    $score = $_POST['score'];
    $mark = $_POST['mark'];
    $time = $_POST['time'];
    $attempts = $_POST['attempts'];
    $mistakes = $_POST['mistakes'];
    $subject = $_POST['subject']; 
*/

if(!empty($scoreID)){

    echo ('ScoreID: '.$scoreID);

    if ($action == "score"){

        $score = $_POST["score"];
        
        echo ('Score: '.$score);
        
        $query = "UPDATE scores_srms SET score = ? WHERE score_id = ? ";
        
        $q = mysqli_stmt_init($con);
        
        mysqli_stmt_prepare($q, $query);
        
        mysqli_stmt_bind_param($q, 'ii', $score, $scoreID);
        
        mysqli_stmt_execute($q);
        
        if(mysqli_stmt_affected_rows($q) > 0){
        
            echo ('PUNTUACION Actualizado correctamente');
        
        }else{
            echo 'Ocurrió algún error';
        }

    }

    if ($action == "progress"){

        $progress = $_POST["progress"];
        
        echo ('Progress: '.$progress);
        
        $query = "UPDATE data_srms SET progress = ? WHERE student_id = ? ";
        
        $q = mysqli_stmt_init($con);
        
        mysqli_stmt_prepare($q, $query);
        
        mysqli_stmt_bind_param($q, 'ii', $progress, $student_id);
        
        mysqli_stmt_execute($q);
        
        if(mysqli_stmt_affected_rows($q) > 0){
        
            echo ('PROGRESO Actualizado correctamente');
        
        }else{
            echo 'Ocurrió algún error';
        }

    }

    if ($action == "mistakes"){

        $mistakes = $_POST["mistakes"];
        
        echo ('Mistakes: '.$mistakes);
        
        $query = "UPDATE scores_srms SET mistakes = ? WHERE score_id = ? ";
        
        $q = mysqli_stmt_init($con);
        
        mysqli_stmt_prepare($q, $query);
        
        mysqli_stmt_bind_param($q, 'ii', $mistakes, $scoreID);
        
        mysqli_stmt_execute($q);
        
        if(mysqli_stmt_affected_rows($q) > 0){
        
            echo ('ERRORES Actualizado correctamente');
        
        }else{
            echo 'Ocurrió algún error';
        }

    }

    if ($action == "time"){

        $segundos = $_POST["segundos"];
        $minutos = $_POST["minutos"];
        $horas = $_POST["horas"];

        $tiempo = $horas.":".$minutos.":".$segundos;
        
        echo ('Tiempo: '.$tiempo);

        $query = "SELECT time FROM scores_srms WHERE score_id = ?"; 

        $q = mysqli_stmt_init($con);

        mysqli_stmt_prepare($q, $query);

        mysqli_stmt_bind_param($q, 'i', $scoreID);

        mysqli_stmt_execute($q);

        $result = mysqli_stmt_get_result($q);

        $row = mysqli_fetch_array($result);

        if($row[0] == "00:00:00"){

            $query = "UPDATE scores_srms SET time = ? WHERE score_id = ? ";
        
            $q = mysqli_stmt_init($con);
            
            mysqli_stmt_prepare($q, $query);
            
            mysqli_stmt_bind_param($q, 'si', $tiempo, $scoreID);
            
            mysqli_stmt_execute($q);
            
            if(mysqli_stmt_affected_rows($q) > 0){
            
                echo ('TIEMPO Actualizado correctamente: '.$tiempo);
            
            }else{
                echo 'Ocurrió algún error';
            }
        }
        
        

    }

    if ($action == "attempts"){

        $attempts = $_POST["attempts"];
        
        echo ('Attempts: '.$attempts);
        
        $query = "UPDATE scores_srms SET attempts = ? WHERE score_id = ? ";
        
        $q = mysqli_stmt_init($con);
        
        mysqli_stmt_prepare($q, $query);
        
        mysqli_stmt_bind_param($q, 'ii', $attempts, $scoreID);
        
        mysqli_stmt_execute($q);
        
        if(mysqli_stmt_affected_rows($q) > 0){
        
            echo ('ERRORES Actualizado correctamente');
        
        }else{
            echo 'Ocurrió algún error';
        }

    }

}

?>