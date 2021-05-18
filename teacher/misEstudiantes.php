<?php
    
    include 'header.php';
    
    /* include ('helper.php'); */

    $user = array();
    
    if(isset($_SESSION['id'])){
        /* print "entré"; */
        /* require ('connection.php'); */
        $user = get_user_info($con, $_SESSION['id']);
        
        $estudiantes = obtenerEstudiantes($con, $user['email']);
        /* print_r ($productos); */
        /* echo "entre"; */
        /* echo isset($user[0]); */
        /* foreach ($user as $key => $value) {
            echo "Key: $key; Value: $value\n<br>";
        } */
    }else{
        /* print "no entré"; */
    }


?>

                <!-- Begin Page Content -->
                <div class="container-fluid card-style mb-5 pb-4">
                <h1 class="h3 mt-2 mb-4 text-gray-800">Mis estudiantes</h1>

                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Consulta general</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                    <!-- DataTales Example -->
                    <div class="card">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido paterno</th>
                                            <th>Apellido materno</th>
                                            <th>RUT</th>
                                            <th>E-mail</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido paterno</th>
                                            <th>Apellido materno</th>
                                            <th>RUT</th>
                                            <th>E-mail</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                    <?php
                        
                                    if(!empty($estudiantes)){

                                        foreach ($estudiantes as $estudiante) : 
                                    ?>
                                        <tr>
                                        <td><?php echo $estudiante[1] ?></td>
                                        <td><?php echo $estudiante[2] ?></td>
                                        <td><?php echo $estudiante[3] ?></td>
                                        <td><?php echo ($estudiante[4]."-".$estudiante[5])?></td>
                                        <td><?php echo $estudiante[6] ?></td>
                                        </tr>
                                    <?php
                                        endforeach;
                                        }
                                    ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php

include 'footer.php';

?>

<script>
$(document).ready(function(){

    $('#dataTable').DataTable({
        
        
    });
});
</script>