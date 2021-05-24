<?php
    include 'header.php';
    error_reporting(E_ALL & ~E_NOTICE);

    $key = array_search($_GET['subject_id'], array_column($_SESSION['subjects_array'], 'subject_id'));

    if($key !== false){
        
        $subject_name = $_SESSION['subjects_array'][$key]['subject_name'];
        $nextSubject_id = $_SESSION['subjects_array'][$key+1]['subject_id'];
        
    }else{
        echo 'No se encontró el tema!';
    }

?>
  
                <!-- Begin Page Content -->
                <div class="container-fluid card-style mb-5 pb-4">
                <div class="row">
                    <div class="col" align="left">
                        <h1 class="h3 mt-2 mb-4 text-gray-800">Tema: <?php echo $subject_name ?></h1>
                    </div>
                </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="show">
                            </div>
                            <?php
                                if(!is_null($nextSubject_id)){
                                    ?>
                                    
                                    <form class="user" method="POST" id="form_clase" action="siguienteClase_action.php">
                                        <input type="hidden" name="idClase" value="<?php echo $_GET['clase'] ?>">
                                        <input type="hidden" name="nextSubject" value="<?php echo $nextSubject_id ?>">
                                        <button class="btn btn-info mt-3" id="siguienteClase_submit" type="submit">Siguiente tema</button>
                                    </form>
                                    
                                    <?php
                                }
                            ?>
                            
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
