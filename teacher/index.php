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
                    <div class="row">

                        <!-- Content Column -->
                        
                        <div class="col-6 mt-5 mb-4">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body text-center">
                                Crear una clase
                                </div>
                                <a href="clases.php" class="stretched-link"></a>
                            </div>
                        </div>
                        <div class="col-6 mt-5 mb-4">
                            <div class="card bg-start-class text-white shadow">
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
                    <h1 class="h3 mt-2 mb-4 text-gray-800">PONER UN SLIDER AQUI</h1>

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
		});
	</script>
