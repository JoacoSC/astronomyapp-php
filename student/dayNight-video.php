<?php
    include 'header.php';
?>

    <!-- <div id="sendCtrls">
        <input type="text" placeholder="Tu mensaje aquí" id="text">

        <button>Enviar</button>
    </div> -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid col-md-8 card-style mb-5 pb-4">
                    
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col" align="left">
                            <h1 class="h3 mt-2 mb-4 text-gray-800">El día y la noche</h1>
                        </div>
                        <!-- <div class="col" align="right">
                            <button type="submit" name="guardar_cambios" id="guardar_cambios" class="btn btn-info btn-sm mt-3 "><i class="fas fa-edit"></i> Confirmar cambios</button>
                        </div> -->
                    </div>
                
                    <!-- Content Row -->
                    <span id="message"></span>

                    <div class="card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="yt-container">
                                        <iframe src="https://www.youtube-nocookie.com/embed/v0X8Wn2TP88?rel=0"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="another-row justify-content-center mt-3">
                    <div class="student-class-button bg-info text-white text-center">
                        <p class="student-class-text">Ya vi el video</p>
                        <a href="dayNight-game.php" class="stretched-link"></a>
                    </div>
                </div>
                    
                </div>
                
                <!-- /.container-fluid -->

            </div>
            <div id="dato"></div>
            <!-- End of Main Content -->
            

<?php

    include 'footer.php';

?>            
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            storeCurrentSubject();
        }, 3000);

        setInterval(function() {
            setTimeout(function() {
                checkTriggerValue(); 
                checkClassEnd();
            }, 2000);
        }, 2000);

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
    setInterval(callTriggerValue, 1000);
</script>