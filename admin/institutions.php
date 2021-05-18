<?php

//institution.php

include('srms.php');

$object = new srms();

/* CREAR CONTROL DE LOGIN / PROTECCION DE URL */

include('header.php');
include('../helper.php');
$instituciones = obtenerInstituciones($con);
$array_cantInscritos = array();
    foreach ($instituciones as $institucion) : 
        $array_cantInscritos[] = cantidadDeInscritosAInstitucion($con, $institucion[0]);
    endforeach;
    
?>
                    <div class="container-fluid card-style mb-5 pb-4">
                    <!-- Page Heading -->
					<div class="row">
						<div class="col" align="left">
							<h1 class="h3 mt-2 mb-4 text-gray-800">Lista de instituciones</h1>
                        </div>
						<div class="col" align="right">
                        <button type="button" name="add_institution" id="add_institution" class="btn btn-info btn-sm mt-3 mr-2" data-toggle="modal" data-target="#institutionModal">Agregar una institución&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
                        </div>
					</div>

                    <span id="message"></span>

                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Campus</th>
                                            <th>Cantidad de registros</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        if(!empty($instituciones)){

                                        $i = 0;

                                        foreach ($instituciones as $institucion) {
                                        ?>

                                        <tr>
                                            <td><?php echo $institucion[1] ?></td>
                                        
                                            <td><?php echo $institucion[2] ?></td>
                                            
                                            <td><?php echo ($array_cantInscritos[$i])?></td>
                                            
                                        
                                            <td>
                                            <?php
                                                echo ('<div align="center">
                                                    <button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="'.$institucion[0].'"><i class="fas fa-edit"></i></button>
                                                    &nbsp;
                                                    <button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$institucion[0].'"><i class="fas fa-times"></i></button>
                                                    </div>
                                                    ');
                                            ?>
                                            </td>
                                        </tr>
                                        
                                        <?php
                                        $i++;
                                        }
                                        
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php
                include('footer.php');
                ?>

<div id="institutionModal" class="modal fade">
  	<div class="modal-dialog">
    	<form method="post" id="institution_form">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="modal_title">Añadir institucion</h4>
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		</div>
        		<div class="modal-body">
        			<span id="form_message"></span>
		          	<div class="form-group">
		          		<label>Nombre</label>
		          		<input type="text" name="institution_name" id="institution_name" class="form-control" required data-parsley-trigger="keyup" />
		          	</div>
                    <div class="form-group">
		          		<label>Campus</label>
		          		<input type="text" name="institution_campus" id="institution_campus" class="form-control" required data-parsley-trigger="keyup" />
		          	</div>
        		</div>
        		<div class="modal-footer">
          			<input type="hidden" name="hidden_id" id="hidden_id" />
          			<input type="hidden" name="action" id="action" value="Add" />
          			<input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Agregar" />
          			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        		</div>
      		</div>
    	</form>
  	</div>
</div>
<script>
    $(document).ready(function(){
        $('#dataTable').DataTable( {
        });

        $('#institution_form').on('submit', function(event){
		event.preventDefault();
            if($('#institution_form').parsley().isValid())
            {		
                
                $.ajax({
                    url:"institution_action.php",
                    method:"POST",
                    data:$(this).serialize(),
                    dataType:'json',
                    beforeSend:function()
                    {
                        $('#submit_button').attr('disabled', 'disabled');
                        $('#submit_button').val('wait...');
                    },
                    success:function(data)
                    {
                        
                        $('#submit_button').attr('disabled', false);
                        if(data.error != '')
                        {
                            $('#form_message').html(data.error);
                            $('#submit_button').val('Agregar');
                        }
                        else
                        {
                            $('#institutionModal').modal('hide');
                            $('#message').html(data.success);
                            
                            setTimeout(function(){

                                $('#message').html('');
                                location.reload();

                            }, 2000);
                        }
                    }
                })
            }
        });

        $(document).on('click', '.edit_button', function(){

        var institution_id = $(this).data('id');

        $('#institution_form').parsley().reset();

        $('#form_message').html('');

        $.ajax({

            url:"institution_action.php",

            method:"POST",

            data:{institution_id:institution_id, action:'fetch_single'},

            dataType:'JSON',

            success:function(data)
            {

                $('#institution_name').val(data.institution_name);
                $('#institution_campus').val(data.institution_campus);

                $('#modal_title').text('Editar información de institución');

                $('#action').val('Edit');

                $('#submit_button').val('Editar');

                $('#institutionModal').modal('show');

                $('#hidden_id').val(institution_id);
            }

        })

        });

        $(document).on('click', '.delete_button', function(){

        var id = $(this).data('id');
        
        if(confirm("Estás seguro de que quieres eliminarlo?"))
        {

            $.ajax({

                url:"institution_action.php",

                method:"POST",

                data:{id:id, action:'delete'},

                dataType:'JSON',

                success:function(data)
                {
                    
                    if(data.error != '')
                        {
                            $('#message').html(data.error);
                        }
                        else
                        {
                            $('#message').html(data.success);
                            
                            setTimeout(function(){

                                $('#message').html('');
                                location.reload();

                            }, 2000);
                        }

                    /* $('#message').html(data);

                    setTimeout(function(){

                        $('#message').html('');

                        location.reload();

                    }, 2000); */

                }

            })

        }

        });
    });
</script>