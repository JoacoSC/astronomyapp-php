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
        <div class="form-group">
            <div class="custom-control custom-checkbox small">
                <input type="checkbox" class="custom-control-input" id="customCheck">
                <label class="custom-control-label" for="customCheck">Recuérdame</label>
            </div>
        </div>
        <button class="btn btn-primary btn-user btn-block" type="submit">
            Ingresar</button>
        <hr>
        <a href="index.php" class="btn btn-google btn-user btn-block">
            <i class="fab fa-google fa-fw"></i> Login with Google
        </a>
        <a href="index.php" class="btn btn-facebook btn-user btn-block">
            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
        </a>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="forgot-password.html">Forgot Password?</a>
    </div>
    <div class="text-center">
        <a class="small" href="register.php">Create an Account!</a>
    </div>

<?php

include 'footer_login.php';

?>