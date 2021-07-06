<?php
    include 'game-header.php';
?>

    <!-- <div id="sendCtrls">
        <input type="text" placeholder="Tu mensaje aquí" id="text">

        <button>Enviar</button>
    </div> -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid col-md-12 student-card-style mb-5 pb-4">
                    
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col" align="left">
                            <h1 class="h3 mt-2 mb-4 text-gray-800">Los planetas del sistema solar</h1>
                        </div>
                        <!-- <div class="col" align="right">
                            <button type="submit" name="guardar_cambios" id="guardar_cambios" class="btn btn-info btn-sm mt-3 "><i class="fas fa-edit"></i> Confirmar cambios</button>
                        </div> -->
                    </div>
                
                    <!-- Content Row -->
                    <span id="message"></span>

                    <div class="card" style="height: 100%">
                        <div class="row">
                            <div class="col-md-12" style="width: 800px">
                                <div class="card-body" style="min-height: 400px">
                                    <div class="webgl-content" style="width: 800px">
                                        <div id="gameContainer" style="width: 800px; height: 600px; position:absolute;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="another-row justify-content-center mt-3">
                    <div class="student-class-button bg-info text-white text-center">
                        <p class="student-class-text"></p>
                        <a href="planets-game.php" class="stretched-link"></a>
                    </div>
                </div>
                    
                </div>
                
                <!-- /.container-fluid -->

            </div>
            <div id="dato"></div>
            <!-- End of Main Content -->
            

<?php

    include 'game-footer.php';

?>            
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            storeCurrentSubject();
        }, 1500);

        setInterval(function() {
            setTimeout(function() {
                checkTriggerValue(); 
                checkClassEnd();
            }, 1000);
        }, 1000);

    });

    var storeCurrentSubject = function() {
        $currentSubject = $('#trigger').val();
        /* $('#currentSubject').html('<input type="hidden" id="currentSubject" value='+ $currentSubject +'>'); */
    }

    var checkClassEnd = function() {
            
            if($('#trigger').val() == 0){
                $(location).attr('href', 'index.php');
            }
            
        }

    var checkTriggerValue = function() {
            
        if($('#trigger').val() != $currentSubject){
            $(location).attr('href', 'get_class_subject.php?subjectID=' + $('#trigger').val());
        }
        
    }

    var callTriggerValue = function() {
        $('#dato').load('newSubjectTrigger.php')
    };

    /* callTriggerValue(); */
    setInterval(callTriggerValue, 300);
</script>