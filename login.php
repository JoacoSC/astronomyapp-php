<?php

    session_start();

    include 'header_login.php';

    $user = array();


    if(isset($_SESSION['id'])){
        $user = get_user_info($con, $_SESSION['id']);
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        require ('login_action.php');
    }

?>


    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Bienvenido de nuevo!</h1>
    </div>
    <span id="message">
        <?php
            if(isset($_GET["deshabilitado"]) && $_GET["deshabilitado"] == 'true')
            {
        ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" id="success-alert" onload="showAlert()">
                <strong>Error!</strong> Usted está deshabilitado del sistema, por favor contáctese con el administrador.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
            }
        ?>
        <?php
            if(isset($_GET["not_record"]) && $_GET["not_record"] == 'true')
            {
        ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" id="success-alert" onload="showAlert()">
                <strong>Error!</strong> Usted no está registrado en el sistema.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
            }
        ?>
        <?php
            if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true')
            {
        ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" id="success-alert" onload="showAlert()">
                <strong>Error!</strong> La contraseña ingresada es incorrecta.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
            }
        ?>
        <?php
            if(isset($_GET["no_activado"]) && $_GET["no_activado"] == 'true')
            {
        ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" id="success-alert" onload="showAlert()">
                <strong>Error!</strong> Debe activar su cuenta, por favor revise su correo electrónico. En caso de que no encuentre
                su correo de activación, no olvide verificar la carpeta de SPAM.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
            }
        ?>
    </span>
    <form class="user" method="POST" action="login.php">
        <div class="form-group">
            <input type="email" class="form-control form-control-user"
                id="exampleInputEmail" name="email" aria-describedby="emailHelp"
                placeholder="Correo electrónico" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-user"
                id="exampleInputPassword" name="contraseña" placeholder="Contraseña" required>
        </div>
        <!-- <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="customCheck">
                <label class="custom-control-label" for="customCheck">Recuérdame</label>
            </div>
        </div> -->
        <button class="btn btn-primary btn-user btn-block" type="submit">
            Ingresar</button>
        <!-- <hr>
        <a href="index.php" class="btn btn-google btn-user btn-block">
            <i class="fab fa-google fa-fw"></i> Login with Google
        </a>
        <a href="index.php" class="btn btn-facebook btn-user btn-block">
            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
        </a> -->
    </form>
    <!-- <hr>
    <div class="text-center">
        <a class="small" href="forgot-password.html">Forgot Password?</a>
    </div>
    <div class="text-center">
        <a class="small" href="register.php">Create an Account!</a>
    </div> -->

<?php

include 'footer_login.php';

?>