<?php
    include 'header.php';
?>

    <!-- <div id="sendCtrls">
        <input type="text" placeholder="Tu mensaje aquí" id="text">

        <button>Enviar</button>
    </div> -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid card-style">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mt-2 mb-4 text-gray-800"><?php if (isset( $_SESSION['id'])){echo "Bienvenid@ " .  $user[1] . "!"; ?></h1>
                            <?php
                        }
                        ?>
                    </div>

                    <!-- Content Row -->
                    

                    
                    <!-- Content Row -->
                    <div class="row mt-2">

                        <!-- Content Column -->
                        
                        <div class="col-6">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                Crear una clase
                                </div>
                                <a href="clases.php" class="stretched-link"></a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-start-class text-white">
                                <div class="card-body text-center">
                                Comenzar una clase
                                </div>
                                <a href="iniciarClase.php" class="stretched-link"></a>
                            </div>
                        </div>
                        

                        <!-- ******************** DIV DE GENERACION DE GRAFICOS ********************* -->

                        
                            <!-- Project Card Example -->
                            <!-- <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                                </div>

                                




                                <div id="show" class="card-body">
                                    
                                </div>





                                
                            </div> -->

                            <!-- ******************** DIV DE GENERACION DE GRAFICOS ********************* -->

                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img class="d-block w-100" src="../img/carousel_1.png" alt="First slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="../img/carousel_2.png" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                            <img class="d-block w-100" src="../img/carousel_3.png" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
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
            $('#show').load('data.php')
        }, 1000);

        /* $('.carousel').carousel() */
    });
</script>
