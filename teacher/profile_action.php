<?php
    session_start();
    require ('../connection.php');

    $nombre     = $_POST["nombre"];
    $ap_pat     = $_POST["apellido_pat"];
    $ap_mat     = $_POST["apellido_mat"];
    $tel        = $_POST["telefono"];
    $email      = $_POST["email"];
    $id         = $_SESSION['id'];

    $query = "UPDATE teacher_srms SET nombre = ? , apellido_pat = ?, apellido_mat = ?, telefono = ?, email = ? WHERE id = ?";
    $q = mysqli_stmt_init($con);
    mysqli_stmt_prepare($q, $query);

    // bind parameter
    mysqli_stmt_bind_param($q, 'ssssss', $nombre, $ap_pat, $ap_mat, $tel, $email, $id);
    //execute query
    mysqli_stmt_execute($q);

    if(mysqli_stmt_affected_rows($q) > 0){

        header('location: profile.php?exito=true');
        exit();
    }else{
        header('location: profile.php');
        exit();
    }
?>