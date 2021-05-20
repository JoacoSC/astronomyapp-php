<?php
    include 'header.php';
?>

    <!-- <div id="sendCtrls">
        <input type="text" placeholder="Tu mensaje aquí" id="text">

        <button>Enviar</button>
    </div> -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid card-style mb-5 pb-4">
                <div class="row">
                    <div class="col" align="left">
                        <h1 class="h3 mt-2 mb-4 text-gray-800">Progreso de los estudiantes</h1>
                    </div>
                </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="show">
                            </div>
                            <form class="user" method="POST" id="form_clase" action="terminarClase_action.php">
                                <input type="hidden" name="idClase" value="<?php echo $_GET['clase'] ?>">
                                <button class="btn btn-danger mt-3" id="terminarClase_submit" type="submit">Terminar clase</button>
                            </form>
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
		});
	</script>
