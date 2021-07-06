<?php
session_start();
include '../../../connection.php';

$student_id = $_SESSION['id']; //Dejarlo como $_SESSION['id']
$progress = $_POST['progress'];


$query = "UPDATE data_srms SET progress = ? WHERE = ?";

$q = mysqli_stmt_init($con);

mysqli_stmt_prepare($q, $query);

mysqli_stmt_bind_param($q, 'si', $progress, $student_id);

mysqli_stmt_execute($q);

if(mysqli_stmt_affected_rows($q) > 0){

    echo 'Actualizado correctamente';

}else{
    echo 'No se pudo actualizar';
}

?>