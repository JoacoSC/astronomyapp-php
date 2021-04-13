<?php

require '../connection.php';

/* echo "bbb"; */

if(isset($_POST["estudiante"]))
{

    $estudiante = $_POST["estudiante"];
    
    $query = "SELECT * FROM student_srms WHERE student_id=?";
    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    mysqli_stmt_bind_param($q, 's', $estudiante);

    // execute sql statement
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

    $row = mysqli_fetch_array($result);

    $html = '<tr><input type="hidden" name="estudiantesArray[]" value="'.$row[0].'"><td class="celdaProducto">'.$row[1].'</td><td class="celdaCantidad">'.$row[2].'</td><td class="celdaStock">'.$row[4].'</td><td class="celdaStock">'.$row[5].'</td><td><a class="delete a-delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xe14c;</i></a></td></tr>';

    

    /* $cadena = '';

    foreach($row as $producto){

        $cadena=$cadena.'<option name="producto" value='.$producto[0].'>'.$producto[2].'</option>';

    } */

    echo $html;
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