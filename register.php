<?php

    include 'header_register.php';

?>

                            <div class="card">
                            <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Crea una cuenta!</h1>
                            </div>
                            <span id="message">
                                <?php
                                    if(isset($_GET["fallo"]) && $_GET["fallo"] == 'true')
                                    {
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show mt-3" id="success-alert" onload="showAlert()">
                                        <strong>Error!</strong> Este email ya está registrado. Por favor <a href="login.php">Inicie sesión</a>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php
                                    }
                                ?>
                                <?php
                                    if(isset($_GET["error"]) && $_GET["error"] == 'true')
                                    {
                                ?>
                                    <div class="alert alert-danger alert-dismissible fade show mt-3" id="success-alert" onload="showAlert()">
                                        <strong>Ups!</strong> Ocurrió algún error durante el registro.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php
                                    }
                                ?>
                            </span>
                            
                            <form class="user" method="POST" action="register_action.php">
                                <div class="form-group row mt-5" align="center">

                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                    <h6 class="h6 text-gray-900">Nombre</h6>
                                        <input type="text" class="form-control form-control-user" name="nombre" id="exampleFirstName"
                                            placeholder="Steven" required>
                                    </div>

                                    <div class="col-sm-4">
                                    <h6 class="h6 text-gray-900">Apellido Paterno</h6>
                                        <input type="text" class="form-control form-control-user" name="apellidoPat" id="exampleLastName"
                                            placeholder="Grant" required>
                                    </div>
                                    <div class="col-sm-4">
                                    <h6 class="h6 text-gray-900">Apellido Materno</h6>
                                        <input type="text" class="form-control form-control-user" name="apellidoMat" id="exampleLastName"
                                            placeholder="Rogers" required>
                                    </div>
                                    
                                </div>
                                <div class="form-group row mt-4" align="center">
                                    <div class="col-sm-6 mb-3">
                                    <h6 class="h6 text-gray-900">Email</h6>
                                        <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail"
                                        placeholder="cap_america@gmail.com" required>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                    <h6 class="h6 text-gray-900">Rut</h6>
                                        <input type="text" class="form-control form-control-user" name="rut" id="rut"
                                            placeholder="12345678" maxlength="8" required>
                                    </div>
                                    <div class="col-sm-2 mb-3" style="margin-top:18px">
                                    <h6 class="h6 text-gray-900"></h6>
                                        <input type="text" class="form-control form-control-user" name="dv" id="dv"
                                            placeholder="8" maxlength="1" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row mt-4" align="center">
                                    
                                    <div class="col-sm-6">
                                    <h6 class="h6 text-gray-900">Teléfono</h6>
                                        <input type="text" class="form-control form-control-user" name="telefono" id="exampleLastName"
                                            placeholder="9 1234 5678" maxlength="9">
                                    </div>
                                    <div class="col-sm-6">
                                    <h6 class="h6 text-gray-900">Fecha de nacimiento</h6>
                                        <input type="date" class="form-control form-control-user" name="fecha_nac" id="exampleInputEmail"
                                            placeholder="04-07-1918">
                                    </div>
                                    
                                </div>
                                <div class="form-group row" align="center">
                                <div class="col-sm-6">

                                <h6 class="h6 text-gray-900">Región</h6>
                                <div class="form-group">
                                    <select class="form-control" name="region" id="regiones" value="" required></select>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <h6 class="h6 text-gray-900">Comuna</h6>
                                <div class="form-group">
                                    <select class="form-control" name="comuna" id="comunas" required></select>
                                    </div></div>
                                </div>
                                <div class="form-group row justify-content-center" align="center">
                                <div class="col-sm-8">

                                <h6 class="h6 text-gray-900">Institución</h6>
                                <div class="form-group">
                                <select type="text" name="teacher_institution" id="teacher_institution" class="form-control" required>
                                    <option value="">Seleccione una institución</option>
                                    <?php
                                        foreach ($instituciones as $institucion) {
                                        ?>
                                            <option value="<?php echo $institucion[0] ?>"><?php echo $institucion[1].' - ('.$institucion[2].')' ?></option>
                                        <?php
                                        }
                                    ?>
                                    <option value="otro">Otro...</option>
                                </select>
                                <div class="form-group mt-2">
                                    <label>Ingrese otra institución a continuación: </label>
                                    <input type="text" name="other_teacher_institution" class="form-control hidden-textbox" />
                                    <label class="mt-2">Campus: (Ejemplo: San Felipe)</label>
                                    <input type="text" name="other_teacher_institution_campus" class="form-control hidden-textbox" />
                                </div>
                                </div>
                                </div></div>

                                <button class="btn btn-primary btn-user btn-block" type="submit">
                                    Registrarse
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Ya tienes una cuenta? Inicia sesión!</a>
                            </div>
                            </div></div></div>
<?php

include 'footer_register.php';

?>

<script>
$(document).ready(function(){
    $('#teacher_institution').on('change', function() {
    var changed = this,
    check = changed.value.toLowerCase() === "otro";
    
    $(changed).next().toggle(check).prop('required', check);
    }).change();
})
</script>