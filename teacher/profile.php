<?php

include('header.php');

?>

    <div class="container-fluid card-style mb-5 pb-4">
    <form method="post" action="profile_action.php" id="profile_form" enctype="multipart/form-data">
    <!-- Page Heading -->
    <div class="row">
        <div class="col" align="left">
            <h1 class="h3 mt-2 mb-4 text-gray-800">Perfil</h1>
        </div>
        <div class="col" align="right">
            <button type="submit" name="guardar_cambios" id="guardar_cambios" class="btn btn-info btn-sm mt-3 mr-2">Guardar cambios&nbsp;&nbsp;<i class="fas fa-edit"></i></button>
        </div>
    </div>
    
    <span id="message">
        <?php
            if(isset($_GET["exito"]) && $_GET["exito"] == 'true')
            {
        ?>
            <div class="alert alert-success alert-dismissible fade show mt-3" id="success-alert" onload="showAlert()">
                <strong>Éxito!</strong> La información se actualizó correctamente.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
            }
        ?>
    </span>
    
    <div class="card">
    
        <div class="row">
            <div class="col-md-10">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="tex" name="nombre" id="nombre" class="form-control" value="<?php echo $user['nombre'] ?>" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-maxlength="175" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label>Apellido paterno</label>
                        <input type="tex" name="apellido_pat" id="apellido_pat" class="form-control" value="<?php echo $user['apellido_pat'] ?>" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-maxlength="175" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label>Apellido paterno</label>
                        <input type="tex" name="apellido_mat" id="apellido_mat" class="form-control" value="<?php echo $user['apellido_mat'] ?>" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-maxlength="175" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label>Telefono (+569)</label>
                        <input type="tex" name="telefono" id="telefono" class="form-control" value="<?php echo $user['telefono'] ?>" required data-parsley-maxlength="8" data-parsley-type="integer" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="tex" name="email" id="email" class="form-control" value="<?php echo $user['email'] ?>" required data-parsley-maxlength="175" data-parsley-type="email" data-parsley-trigger="keyup" />
                    </div>
                    <!-- <div class="form-group">
                        <label>Foto de perfil</label><br />
                        <input type="file" name="user_image" id="user_image" />
                        <br />
                        <span class="text-muted">Sólo archivos en formato ".jpg" o ".png"</span><br />
                        <span id="uploaded_image"></span>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
</form>

<?php
include('footer.php');
?>

<script>
$('#profile_form').parsley();

$('#guardar_cambios').click(function(event){
    
    if($('#profile_form').parsley().isValid())
    {
        $('#profile_form').submit();
    }
});

</script>