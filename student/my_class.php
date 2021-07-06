<?php
    include 'header.php';
?>

    <!-- <div id="sendCtrls">
        <input type="text" placeholder="Tu mensaje aquí" id="text">

        <button>Enviar</button>
    </div> -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid col-md-8 student-card-style mb-5 pb-4">
                    
                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col" align="left">
                            <h1 class="h3 mt-2 mb-4 text-gray-800">Mi clase</h1>
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
                                <div class="card-body center">
                                    <h5 class="h5 mt-3 mb-4 text-gray-800 loading">Esperando al profesor para iniciar la clase</h5>
                                    <div id="dato"></div>
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

        setInterval(function() {
            setTimeout(function() {
                checkTriggerValue();
            }, 2000);
        }, 2000);

    });

    var checkTriggerValue = function() {
        if($('#trigger').val() != 0){
            $(location).attr('href', 'get_class_subject.php?classID=' + $('#trigger').val());
        }
    }

    var callTriggerValue = function() {
        $('#dato').load('callTriggerValue.php')
    };

    /* callTriggerValue(); */
    setInterval(callTriggerValue, 1000);
</script>
