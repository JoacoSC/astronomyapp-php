<?php

    include 'header_register.php';

?>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crea una cuenta!</h1>
                            </div>
                            <form class="user" method="POST" action="register_action.php">
                                <div class="form-group row">

                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="nombre" id="exampleFirstName"
                                            placeholder="Nombre">
                                    </div>

                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" name="apellidoPat" id="exampleLastName"
                                            placeholder="Apellido Paterno">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" name="apellidoMat" id="exampleLastName"
                                            placeholder="Apellido Materno">
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail"
                                        placeholder="Email" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3">
                                        <input type="text" class="form-control form-control-user" name="rut" id="rut"
                                            placeholder="Rut" oninput="checkRut(this)" maxlength="10" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="telefono" id="exampleLastName"
                                            placeholder="Teléfono: 9 1234 5678" maxlength="9">
                                    </div>
                                    
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-900 mb-2">Fecha de nacimiento</p>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user" name="fecha_nac" id="exampleInputEmail"
                                        placeholder="Fecha de nacimiento">
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-900 mb-2">Región</p>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="region" id="regiones" value=""></select>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-900 mb-2">Comuna</p>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="comuna" id="comunas"></select>
                                </div>

                                <button class="btn btn-primary btn-user btn-block" type="submit">
                                    Registrarse
                                </button>
                                <hr>
                                <a href="index.php" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.php" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
<?php

include 'footer_register.php';

?>