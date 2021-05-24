<?php
    include 'header.php';
?>

    <!-- <div id="sendCtrls">
        <input type="text" placeholder="Tu mensaje aquí" id="text">

        <button>Enviar</button>
    </div> -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid col-md-10 mb-5 pb-5">

                <!-- Page Heading -->
					<div class="another-row">
						<div class="col " align="center">
                        <h1 class="welcome-font h3 mt-2 mb-4"><?php if (isset( $_SESSION['id'])){echo "Bienvenid@ " .  $user[1] . "!"; ?></h1>
                            <?php
                        }
                        ?>
                        </div>
					</div>
                    <!-- Page Heading -->
                    <!-- Content Row -->
                    <span id="message"></span>
                    
                </div>
                
                <div class="another-row justify-content-center">
                    <div class="start-button bg-info text-white text-center">
                        <img class="start-button-img"src="../img/entrar_a_clases_2.png" alt="">
                        <a href="my_class.php" class="stretched-link"></a>
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
