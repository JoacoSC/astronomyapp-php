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
    $query = "SELECT id, nombre, apellido_pat, apellido_mat, rut, email, contraseña, telefono, fecha_nac, region, comuna, role FROM teacher_srms WHERE id=?";
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

        $query = "SELECT id, nombre, apellido_pat, apellido_mat, rut, email, contraseña, institucion, telefono, fecha_nac, region, comuna, role FROM student_srms WHERE id=?";
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

    $query = "SELECT * FROM student_srms WHERE email_profesor=? AND student_status='Habilitado'";

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

    $cero = 0;

    $query = "SELECT data_srms.student_id, data_srms.clase_en_vivo, data_srms.num, student_srms.student_name 
    FROM data_srms INNER JOIN student_srms ON data_srms.student_id = student_srms.student_id WHERE data_srms.clase_en_vivo != 0";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    /* mysqli_stmt_bind_param($q, 'i', $cero); */

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

    $query = "SELECT * FROM class_srms WHERE class_status='Habilitado'";

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

    $query = "SELECT * FROM class_srms WHERE class_id = ?";

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

function revisarBD($con, $id){
    $query = "SELECT id_clase FROM estudiante WHERE id=?";

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

        return false;
    }
}

function actualizarPerfil($con, $id){
    
    $query = "SELECT id_clase FROM estudiante WHERE id=?";

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

        return false;
    }
}

function obtenerTemas($con, $id_clase){

    $query = "SELECT * FROM subject_srms WHERE class_id = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 'i', $id_clase);

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

function obtenerEstudiantesAdmin($con){
    $query = "SELECT * FROM student_srms";

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

function obtenerClasesTeacher($con, $teacher_id){
    $query = "SELECT * FROM class_srms WHERE class_teacher = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $teacher_id);

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