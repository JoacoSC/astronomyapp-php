<?php

//import.php
session_start();
include '../vendor/autoload.php';
require ('../connection.php');
include ('../helper.php');

$user = array();

    
    if(isset($_SESSION['id'])){
        /* print "entré"; */
        
        $user = get_user_info($con, $_SESSION['id']);
        /* echo $user[0];
        echo isset($user[0]); */
        /* foreach ($user as $key => $value) {
            echo "Key: $key; Value: $value\n<br>";
        } */
    }


/* require 'connection.php'; */
/* $connect = new PDO("mysql:host=localhost;dbname=astronomyapp", "root", ""); */

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {

    public function readCell($column, $row, $worksheetName = '') {
        // Read title row and rows 20 - 30
        if ($row >= 30 && $row<=33) {
            return true;
        }
        return false;
    }
}


if($_FILES["import_excel"]["name"] != '')
{
 $allowed_extension = array('xls', 'csv', 'xlsx');
 $file_array = explode(".", $_FILES["import_excel"]["name"]);
 $file_extension = end($file_array);

 if(in_array($file_extension, $allowed_extension))
 {
  $file_name = time() . '.' . $file_extension;
  move_uploaded_file($_FILES['import_excel']['tmp_name'], $file_name);
  $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($file_name);
  /* $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type); */
  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
  $reader->setReadFilter( new MyReadFilter() );

  $spreadsheet = $reader->load($file_name);

  unlink($file_name);

  $data = $spreadsheet->getActiveSheet()->toArray();
  
/* ESTO LO CAMBIÉ */


  foreach($data as $row)
  {

    

   $insert_data = array(

    $nombre = $row[1],
    $apellido_pat  = $row[2],
    $apellido_mat  = $row[3],
    $rut  = $row[4],
    $email  = $row[5],
    $institucion  = $row[6]
    
   );

   $nombre = $row[1];
   $rut = $row[4];

   $primerResultado = substr($rut, 0, 4);
   $segundoResultado = substr($nombre, 0, 4);
   $contraseña = $primerResultado.$segundoResultado;

   $hashed_pass = password_hash($contraseña, PASSWORD_DEFAULT);

   $email_profesor = $user['email'];

   $query = "INSERT INTO estudiante (nombre, apellido_pat, apellido_mat, rut, email, contraseña, institucion, email_profesor)"; 
   $query .= "VALUES( ?, ?, ?, ?, ?, ?, ?, ?)";

   $q = mysqli_stmt_init($con);

   mysqli_stmt_prepare($q, $query);

   mysqli_stmt_bind_param($q, 'ssssssss', $nombre, $apellido_pat, $apellido_mat, $rut, $email, $hashed_pass, $institucion, $email_profesor);
   
   mysqli_stmt_execute($q);
   
  }
  $message = '<div class="alert alert-success">Registro ingresado correctamente</div>';

 }
 else
 {
  $message = '<div class="alert alert-danger">Ingrese un archivo Excel por favor</div>';
 }
}
else
{
 $message = '<div class="alert alert-danger">Por favor ingrese un archivo</div>';
}
  /* LO CAMBIÉ HASTA AQUI */



  /* foreach($data as $row)
  {
   $insert_data = array(
    ':first_name'  => $row[1],
    ':last_name'  => $row[2],
    ':second_last_name'  => $row[3],
    ':rut'  => $row[4],
    ':email'  => $row[5],
    ':institucion'  => $row[6]
    
   );

   $nombre = $row[1];
   $rut = $row[4];

   $primerResultado = substr($rut, 0, 4);
   $segundoResultado = substr($nombre, 0, 4);
   $contraseña = $primerResultado.$segundoResultado;

   $hashed_pass = password_hash($contraseña, PASSWORD_DEFAULT);

   $query = "
   INSERT INTO test
   (first_name, last_name, second_last_name, rut, email, institucion) 
   VALUES (:first_name, :last_name, :second_last_name, :rut, :email, :institucion)
   ";

   $statement = $connect->prepare($query);
   $statement->execute($insert_data);
  }
  $message = '<div class="alert alert-success">Registro ingresado correctamente</div>';

 }
 else
 {
  $message = '<div class="alert alert-danger">Ingrese un archivo Excel por favor</div>';
 }
}
else
{
 $message = '<div class="alert alert-danger">Por favor ingrese un archivo</div>';
} */

echo $message;

?>