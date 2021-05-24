<?php
    session_start();
    include '../connection.php';

    $id = $_SESSION['id'];

    $query = "SELECT current_subject_id FROM data_srms WHERE student_id=?";

    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $id);

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);

    $output = '<input type="hidden" id="trigger" value='.$row[0].'>';

    echo $output;
?>