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

function get_user_info($con, $id){
    $query = "SELECT * FROM teacher_srms WHERE id=?";
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

        $query = "SELECT * FROM student_srms WHERE student_id=?";
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

function actualizarDatos($con, $teacher_email){

    $cero = 0;

    $query = "SELECT data_srms.student_id, data_srms.clase_en_vivo, data_srms.num, student_srms.student_name 
    FROM data_srms INNER JOIN student_srms ON data_srms.student_id = student_srms.student_id WHERE data_srms.clase_en_vivo != 0 
    AND student_srms.email_profesor = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $teacher_email);

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

    $query = "SELECT * FROM subject_srms WHERE class_id = ? AND subject_status= 'Habilitado'";

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

function contarClasesAdmin($con){

    $query = "SELECT COUNT(*) FROM class_srms";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    /* mysqli_stmt_bind_param($q, 's', $email); */

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

function contarEstudiantesAdmin($con){

    $query = "SELECT COUNT(*) FROM student_srms";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    /* mysqli_stmt_bind_param($q, 's', $email); */

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

function contarProfesoresAdmin($con){

    $query = "SELECT COUNT(*) FROM teacher_srms";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    /* mysqli_stmt_bind_param($q, 's', $email); */

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

function contarInstitucionesAdmin($con){

    $query = "SELECT COUNT(*) FROM institution_srms";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    /* mysqli_stmt_bind_param($q, 's', $email); */

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

function obtenerClasesAdmin($con){
    $query = "SELECT * FROM class_srms";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    /* mysqli_stmt_bind_param($q, 's', $teacher_id); */

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

function obtenerProfesoresAdmin($con){

    $query = "SELECT * FROM teacher_srms";

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

function obtenerInstitucionesAdmin($con){

    $query = "SELECT * FROM institution_srms";

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

function obtenerInstitucionTablaAdmin($con, $inst_id){
    $query = "SELECT * FROM institution_srms WHERE institution_id = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $inst_id);

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

function obtenerProfesorDeLaClase($con, $class_id){

    /* OBTENIENDO EL ID DEL PROFESOR */

    $query = "SELECT class_teacher FROM class_srms WHERE class_id = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 'i', $class_id);

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);

    $class_teacher = $row[0];

    /* OBTENIENDO EL ID DEL PROFESOR */

    /* OBTENIENDO EL NOMBRE E EMAIL DEL PROFESOR */

    $query = "SELECT * FROM teacher_srms WHERE id = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 'i', $class_teacher);

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);

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

function obtenerClasesHabilitadasTeacher($con, $teacher_id){
    $query = "SELECT * FROM class_srms WHERE class_teacher = ? AND class_status = 'Habilitado'";

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

function obtenerEstudiantesTeacher($con, $email){

    $query = "SELECT * FROM student_srms WHERE email_profesor=?";

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

function obtenerInstituciones($con){

    $query = "SELECT * FROM institution_srms";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    /* mysqli_stmt_bind_param($q, 'i', $id_clase); */

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

function cantidadDeInscritosAInstitucion($con, $institution_id){

    /* *********** REVISANDO PROFESORES ************* */
    $row_count = 0;

    $query = "SELECT institution FROM teacher_srms WHERE institution = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 'i', $institution_id);

    // execute sql statement
    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row_count_teachers = mysqli_num_rows($result);

    /* *********** REVISANDO ESTUDIANTES ************* */

    $query = "SELECT institution FROM student_srms WHERE institution = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 'i', $institution_id);

    // execute sql statement
    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);

    $row_count_students = mysqli_num_rows($result);

    $row_count = $row_count_teachers + $row_count_students;


    if(!empty($row_count)){

        return $row_count;
    }else{

        return 0;
    }
}

function infoClaseActualStudent($con, $class_id, $student_id){

    $query = "SELECT * FROM data_srms WHERE student_id = ? AND clase_en_vivo = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 'ii', $student_id, $class_id);

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

function infoTemaActualStudent($con, $subject_id){

    $query = "SELECT * FROM subject_srms WHERE subject_id = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 'i', $subject_id);

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

function obtenerTemasClaseTeacher($con, $class_id){

    /* *************** EDITAR ESTO ****************** */

    $query = "SELECT * FROM subject_srms WHERE class_id = ?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 'i', $class_id);

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