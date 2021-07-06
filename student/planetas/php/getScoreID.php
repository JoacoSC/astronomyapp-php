<?php

session_start();
include '../../../connection.php';

$student_id = $_SESSION['id'];
$score = 0;
$mark = 0;
$time = "00:00:00";
$attempts = "0";
$mistakes = "0";
$subject = "Planetas del sistema solar";


$query = "INSERT INTO scores_srms (student_id, score, mark, time, attempts, mistakes, subject)"; 

$query .= "VALUES(?, ?, ?, ?, ?, ?, ?)";

$q = mysqli_stmt_init($con);

mysqli_stmt_prepare($q, $query);

mysqli_stmt_bind_param($q, 'iissiis', $student_id, $score, $mark, $time, $attempts, $mistakes, $subject);

mysqli_stmt_execute($q);

if(mysqli_stmt_affected_rows($q) > 0){

    echo 'Insertado correctamente';

    $query = "SELECT MAX(score_id) FROM scores_srms WHERE student_id = ?"; 

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    mysqli_stmt_bind_param($q, 'i', $student_id);

    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);

    if(!empty($row)){

        $_SESSION['scoreID'] = $row[0];
        echo ($row[0]);
        
    }else{
        echo ("Algo extraño ocurrio");
    }

}else{
    echo 'Ocurrió algún error';
}


?>