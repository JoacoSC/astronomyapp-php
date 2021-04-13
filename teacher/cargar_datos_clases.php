<?php

require '../connection.php';

/* echo "bbb"; */

if(isset($_POST["clase"]))
{

    $clase = $_POST["clase"];
    
    $query = "SELECT * FROM class_srms WHERE class_id=?";
    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $clase);

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_all($result);

    $resultado = json_encode($row);

    /* $cadena = '';

    foreach($row as $producto){

        $cadena=$cadena.'<option name="producto" value='.$producto[0].'>'.$producto[2].'</option>';

    } */

    echo $resultado;
    /* $query = "SELECT * FROM productos WHERE CATEGORIA='$clase'";

    $statement = $connect->prepare($query);
    $statement->execute();
    $data = $statement->fetchAll();
    foreach($data as $row)
    {
    $output[] = array(
    'id'  => $row["id"],
    'name'  => $row["nombre"]
    );
    }
    echo json_encode($output); */
 
}

?>