<?php
    include 'header.php';
?>

    <!-- <div id="sendCtrls">
        <input type="text" placeholder="Tu mensaje aquí" id="text">

        <button>Enviar</button>
    </div> -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    
                        <!-- ******************** DIV DE GENERACION DE GRAFICOS ********************* -->

                        
                            <!-- Project Card Example -->
                            <div class="card shadow mt-5 mb-4">
                                <div class="card-header py-3">
                                
                                    <h6 class="h3 mb-0 text-gray-800">Progreso de los estudiantes: </h6>
                                </div>

                                

                                <div id="show" class="card-body">
                                    
                                </div>

                                <form class="user" method="POST" id="form_clase" action="terminarClase_action.php">

                                    <input type="hidden" name="idClase" value="<?php echo $_GET['clase'] ?>">

                                    <button class="btn btn-danger mt-3" id="terminarClase_submit" type="submit">Terminar clase</button>
                                </form>
                            </div>

                            

                            <!-- ******************** DIV DE GENERACION DE GRAFICOS ********************* -->

                    

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
