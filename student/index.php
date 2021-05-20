<?php
    include 'header.php';
?>

    <!-- <div id="sendCtrls">
        <input type="text" placeholder="Tu mensaje aquí" id="text">

        <button>Enviar</button>
    </div> -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid col-md-10 card-style mb-5 pb-5">

                <!-- Page Heading -->
					<div class="row">
						<div class="col" align="left">
                        <h1 class="h3 mt-2 mb-4 text-gray-800"><?php if (isset( $_SESSION['id'])){echo "Bienvenid@ " .  $user[1] . "!"; ?></h1>
                            <?php
                        }
                        ?>
                        </div>
					</div>

                    <!-- Page Heading -->
                    

                    <!-- Content Row -->
                    <span id="message"></span>
                    <div class="row justify-content-around mt-2">

                        <!-- Content Column -->
                        
                        <div class="col-4">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                Entrar a una clase
                                </div>
                                <a href="iniciarClase.php" class="stretched-link"></a>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="container-fluid col-md-10 card-style mb-5 pb-4">

                    <div class="row justify-content-center">
                        <div class="card index-card mt-4">
                            
                            <div class="card-body">
                                
                                <div id="carouselExampleIndicators" class="carousel slide mt-5" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                        <img class="d-block w-100" src="../img/astronomyapp1.png" alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                        <img class="d-block w-100" src="../img/astronomyapp2.png" alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                        <img class="d-block w-100" src="../img/astronomyapp3.png" alt="Third slide">
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
                        </div>
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
