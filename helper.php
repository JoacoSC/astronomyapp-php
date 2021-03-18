<?php

function validar_input_text($textValue){
    if (!empty($textValue)){
        $trim_text = trim($textValue);
        // remove illegal character
        $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_STRING);
        return $sanitize_str;
    }
    return '';
}

function validar_input_email($emailValue){
    if (!empty($emailValue)){
        $trim_text = trim($emailValue);
        // remove illegal character
        $sanitize_str = filter_var($trim_text, FILTER_SANITIZE_EMAIL);
        return $sanitize_str;
    }
    return '';
}

//PUEDO ALMACENAR LOS NOMBRES CON MAYUSCULAS

function get_user_info($con, $id){
    $query = "SELECT id, nombre, apellido_pat, apellido_mat, rut, email, contraseña, telefono, fecha_nac, region, comuna, role FROM profesor WHERE id=?";
    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $id);

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);

    /* return empty($row) ? false : $row; */

    if(!empty($row)){

        return $row;
    }else{

        $query = "SELECT id, nombre, apellido_pat, apellido_mat, rut, email, contraseña, institucion, telefono, fecha_nac, region, comuna, role FROM estudiante WHERE id=?";
        $q = mysqli_stmt_init($con);

        mysqli_stmt_prepare($q, $query);

        // bind the statement
        mysqli_stmt_bind_param($q, 's', $id);

        // execute sql statement
        mysqli_stmt_execute($q);
        $result = mysqli_stmt_get_result($q);

        $row = mysqli_fetch_array($result);

        return $row;
    }
}

function obtenerEstudiantes($con, $email){

    $query = "SELECT id, nombre, apellido_pat, apellido_mat, rut, email, contraseña, institucion, role FROM estudiante WHERE email_profesor=?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $email);

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_all($result);

    /* return empty($row) ? false : $row; */

    if(!empty($row)){

        return $row;
    }else{

        return false;
    }
}

function actualizarDatos($con){
    $query = "SELECT id,num,name FROM test_num";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    /* mysqli_stmt_bind_param($q, 's', $email); */

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_all($result);

    /* return empty($row) ? false : $row; */

    if(!empty($row)){

        return $row;
    }else{

        return false;
    }
}

function obtenerClases($con){

    $query = "SELECT * FROM clases";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    /* mysqli_stmt_bind_param($q, 's', $email); */

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_all($result);

    /* return empty($row) ? false : $row; */

    if(!empty($row)){

        return $row;
    }else{

        return false;
    }
}

function obtenerClaseEspecifica($con, $id){

    $query = "SELECT * FROM clases WHERE class_id = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $id);

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_all($result);

    /* return empty($row) ? false : $row; */

    if(!empty($row)){

        return $row;
    }else{

        return false;
    }
}