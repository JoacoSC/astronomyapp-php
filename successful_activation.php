<?php

    include 'header_login.php';

?>
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Te damos la bienvenida a <b>Astronomyapp!</b></h1>
                <span id="message">
                    <?php
                        if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true')
                        {
                    ?>
                        <div class="alert alert-danger fade show mt-3" id="success-alert" onload="showAlert()">
                            <strong>Error!</strong> Tu cuenta ya estaba activada, no es necesario que vuelvas a activarla.
                            
                        </div>
                    <?php
                        }
                    ?>
                </span>
                <p>
                    Serás redireccionado en <b><span id="contador">5</span></b> segundo(s).
                </p>
            </div>
        </div>
    </div>
    

<?php

include 'footer_login.php';

?>

<script>
function countdown() {
    var i = document.getElementById('contador');
    if (parseInt(i.innerHTML)<=0) {
        location.href = 'login.php';
    }
if (parseInt(i.innerHTML)!=0) {
    i.innerHTML = parseInt(i.innerHTML)-1;
}
}
setInterval(function(){ countdown(); },1000);

</script>