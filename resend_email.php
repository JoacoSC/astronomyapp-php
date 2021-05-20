<?php

    include 'header_login.php';

?>
    <div class="card">
        <div class="card-body">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Reenviaremos el correo de activación</h1>
                <span id="message">
                    <?php
                        if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true')
                        {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-3" id="success-alert" onload="showAlert()">
                            <strong>Error!</strong> La dirección de correo ingresada no se encuentra registrada en el sistema.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                        }
                    ?>
                </span>
                <span>
                    Por favor ingrese su dirección de correo electrónico:
                </span>
                <form class="user" method="POST" action="resend_email_action.php">
                    <div class="form-group">
                        <input type="email" class="form-control form-control-user"
                            id="exampleInputEmail" name="email" aria-describedby="emailHelp"
                            placeholder="ejemplo@gmail.com" required>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" type="submit">
                        Enviar</button>
                </form>
            </div>
        </div>
    </div>
    

<?php

include 'footer_login.php';

?>