<!-- <!DOCTYPE html>
<html>
   <head>
     <title>Import Data From Excel or CSV File to Mysql using PHPSpreadsheet</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   </head> -->
   <?php 
    /* session_start(); */
    include ('header.php');
    

    $user = array();

    
    if(isset($_SESSION['id'])){
        /* print "entré"; */
        
        $user = get_user_info($con, $_SESSION['id']);
        if(isset($_GET['student_id'])){
            $student_id = $_GET['student_id'];
            
            $estudiante = obtenerDatosEstudianteTeacher($con, $student_id);
            $puntajes = obtenerPuntajesEstudianteTeacher($con, $student_id);
        }
        
        /* echo $user[0];
        echo isset($user[0]); */
        /* foreach ($user as $key => $value) {
            echo "Key: $key; Value: $value\n<br>";
        } */
    }else{
        /* print "no entré"; */
    }

?>
        
    <div class="container-fluid card-style mb-5 pb-4">

    <div class="row">
        <div class="col" align="left">
            <h1 class="h3 mt-2 mb-4 text-gray-800">Puntuaciones de <?php echo ($estudiante[1]." ".$estudiante[2]);?></h1>
        </div>
    </div>

    <span id="message"></span>

    <div class="card">
      <div class="card-body">
          
        <!-- <a class="btn btn-info btn-sm shadow-sm" href="../excel/estudiantes.xlsx" download="estudiantes.xlsx" type="button" >
        Descargar plantilla Excel
        </a> -->

        <div class="table-responsive" align="center">
            <?php
                if(!empty($puntajes)){

            ?>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tema</th>
                    <th scope="col">Puntaje</th>
                    <th scope="col">Calificación</th>
                    <th scope="col">Tiempo</th>
                    <th scope="col">Nro. de Intentos</th>
                    <th scope="col">Errores</th>
                    <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        foreach($puntajes as $puntaje){
                            
                    ?>
                            <tr>
                                <th scope="row"><?php echo $i ?></th>
                                <td><?php echo $puntaje[7];?></td>
                                <td><?php echo $puntaje[2];?></td>
                                <td><?php echo $puntaje[3];?></td>
                                <td><?php echo $puntaje[4];?></td>
                                <td><?php echo $puntaje[5];?></td>
                                <td><?php echo $puntaje[6];?></td>
                                <td><?php echo $puntaje[8];?></td>
                            </tr>
                    <?php

                        $i++;
                        }

                    ?>
                </tbody>
            </table>
            <?php
                }else{
                    echo '<h5 class="h5 mt-3 mb-4 text-gray-800">El estudiante aún no registra puntuaciones en el sistema.</h5>';
                }
            
            ?>
          
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>

</script>
