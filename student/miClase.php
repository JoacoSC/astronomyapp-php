<?php
    include 'header.php';
?>

    <!-- <div id="sendCtrls">
        <input type="text" placeholder="Tu mensaje aquí" id="text">

        <button>Enviar</button>
    </div> -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php if (isset( $_SESSION['id'])){echo "Bienvenid@ " .  $user[1] . "!"; ?></h1>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Dato BD</h6>
                                </div>




                                <div id="show" class="card-body">
                                
                                    
                                </div>





                                
                            </div>

                    
                    <!-- Content Row -->
                    <div class="row justify-content-center">

                        
                        <!-- ******************** DIV DE GENERACION DE GRAFICOS ********************* -->

                        
                            

                            <!-- ******************** DIV DE GENERACION DE GRAFICOS ********************* -->

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php

    include 'footer.php';

?>            

<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function () {
            $('#show').load('revisarBD.php')
        }, 1000);
    });
</script>