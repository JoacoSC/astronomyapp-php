<?php
    session_start();
    require ('../connection.php');

    $nombre     = $_POST["nombre"];
    $ap_pat     = $_POST["apellido_pat"];
    $ap_mat     = $_POST["apellido_mat"];
    $email      = $_POST["email"];
    $id         = $_SESSION['id'];

    $query = "UPDATE student_srms SET student_name = ? , student_father_lastname = ?, student_mother_lastname = ?, student_email_id = ? WHERE student_id = ?";
    $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);

    // bind parameter
    mysqli_stmt_bind_param($q, 'sssss', $nombre, $ap_pat, $ap_mat, $email, $id);
    //execute query
    mysqli_stmt_execute($q);

    if(mysqli_stmt_affected_rows($q) == 1){
        echo ("BIEN");

        header('location: profile.php?exito=true');
        exit();
    }else{
        echo ("MAL");
        header('location: profile.php');
        exit();
    }
?>