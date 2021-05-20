<?php

//classes.php

include('srms.php');

$object = new srms();

if(!$object->is_login())
{
    header("location:".$object->base_url."admin");
}

if(!$object->is_master_user())
{
    header("location:".$object->base_url."admin/result.php");
}

include('header.php');

include ('../helper.php');

$profesores = obtenerProfesoresAdmin($con);
$clases = obtenerClasesAdmin($con);

?>
<div class="container-fluid card-style mb-5 pb-4">
                    <!-- Page Heading -->
					<div class="row">
						<div class="col" align="left">
							<h1 class="h3 mt-2 mb-4 text-gray-800">Gestión de clases</h1>
                        </div>
						<div class="col" align="right">
							<button type="button" name="add_class" id="add_class" class="btn btn-info btn-sm mt-3 mr-2">Crear una nueva clase&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
                        </div>
					</div>

                    <!-- DataTales Example -->
                    <span id="message"></span>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="class_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre de la clase</th>
                                            <th style="min-width:200px;">Tema</th>
											<th>Profesor de la clase</th>
                                            <th>Añadir tema</th>
                                            <th>Editar tema</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
                        
									if(!empty($clases)){

										foreach ($clases as $clase) : 

											$id_clase = $clase[0];
											$temas = obtenerTemas($con, $id_clase);
									?>
										<tr>
										<td><?php echo $clase[1] ?></td>
										<td><?php

											$output = array();
											if(!empty($temas)){
												foreach ($temas as $tema) : 
													$output[] = $tema[2];
												endforeach;
												echo implode(', ', $output);
											}else{
												echo (" - ");
											}
											
											
										?>
										</td>
										<td>
											<?php
												$teacher_array = obtenerProfesorDeLaClase($con, $id_clase);
												
												if(!empty($teacher_array)){
													echo ($teacher_array[1]." ".$teacher_array[2]." ".$teacher_array[3]." - (".$teacher_array[6].")");
												}else{
													echo (" - ");
												}

											?>
										</td>
										<td align="center">
										<?php
											echo '<button type="button" name="add_subject" data-id="'.$clase[0].'" class="btn btn-info btn-sm add_subject"><i class="fas fa-plus"></i> Tema</button>';
										?>
										</td>
										<td align="center">
										<?php
											echo '<a href="subject.php?action=view&class='.$clase[2].'" class="btn btn-secondary btn-sm"><i class="fas fa-edit"></i> Tema</a>';
										?>
										</td>
										<td align="center">
										<?php

										if($clase[3] == 'Habilitado')
										{
											echo ('<button type="button" name="status_button" class="btn btn-primary btn-sm status_button" data-id="'.$clase[0].'" data-status="'.$clase[3].'">Habilitado</button>');
										}
										else
										{
											echo ('<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="'.$clase[0].'" data-status="'.$clase[3].'">Deshabilitado</button>');
										}
										?>
										</td>

										<td>
										<?php
										echo ('<div class="action_buttons" align="center">
											<button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="'.$clase[0].'"><i class="fas fa-edit"></i></button>
											&nbsp;
											<button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$clase[0].'"><i class="fas fa-times"></i></button>
											</div>
											');
										?>
										</td>

										</tr>
									<?php
										endforeach;
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

<div id="classModal" class="modal fade">
  	<div class="modal-dialog">
    	<form method="post" id="class_form">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="modal_title">Añadir clase</h4>
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		</div>
        		<div class="modal-body">
        			<span id="form_message"></span>
		          	<div class="form-group">
		          		<label>Nombre de la clase</label>
		          		<input type="text" name="class_name" id="class_name" class="form-control" required  data-parsley-trigger="keyup" />
		          	</div>
					<div class="form-group">
		          		<label>Profesor de la clase</label>
		          		<select type="text" name="class_teacher" id="class_teacher" class="form-control" data-parsley-trigger="keyup">

							<?php
								foreach ($profesores as $profesor) {
								?>
									<option value="<?php echo $profesor[0] ?>"><?php echo $profesor[1].' '.$profesor[2].' '.$profesor[3].' - ('.$profesor[6].')' ?></option>
								<?php
							}
							?>
						</select>
		          	</div>
					  
        		</div>
        		<div class="modal-footer">
          			<input type="hidden" name="hidden_id" id="hidden_id" />
          			<input type="hidden" name="action" id="action" value="Add" />
          			<input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Add" />
          			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        		</div>
      		</div>
    	</form>
  	</div>
</div>

<div id="subjectModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="subject_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="subject_modal_title">Añadir tema</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span id="subject_form_message"></span>
                    <div class="form-group">
                        <label>Nombre del tema</label>
                        <!-- <input type="text" name="subject_name" id="subject_name" class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-trigger="keyup" /> -->
                        <select type="text" name="subject_name" id="subject_name" class="form-control" data-parsley-trigger="keyup">

						<?php
							/* foreach ($temas as $tema) {
							?>
								<option value="<?php echo $tema[0] ?>"><?php echo $tema[2] ?></option>
							<?php
						} */
						?>
                            <option>Planetas del sistema solar</option>
                            <option>Eclipses</option>
                            <option>Fases de la luna</option>
                            <option>El día y la noche</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_subject_id" id="hidden_subject_id" />
                    <input type="hidden" name="class_id" id="class_id" />
                    <input type="hidden" name="hidden_action" id="hidden_action" value="Add" />
                    <input type="submit" name="submit" id="subject_form_submit_button" class="btn btn-success" value="Add" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function(){

	var dataTable = $('#class_table').DataTable({
		/* "processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"classes_action.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[2, 3, 5],
				"orderable":false,
			},
		], */
		scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        fixedColumns:   {
            leftColumns: 0,
            rightColumns: 4
        }
	});

	$('#add_class').click(function(){
		
		$('#class_form')[0].reset();

		$('#class_form').parsley().reset();

    	$('#modal_title').text('Añadir clase');

    	$('#action').val('Add');

    	$('#submit_button').val('Crear');

    	$('#classModal').modal('show');

    	$('#form_message').html('');

	});

	$('#class_form').parsley();

	$('#class_form').on('submit', function(event){
		event.preventDefault();
		if($('#class_form').parsley().isValid())
		{		
			$.ajax({
				url:"classes_action.php",
				method:"POST",
				data:$(this).serialize(),
				dataType:'json',
				beforeSend:function()
				{
					$('#submit_button').attr('disabled', 'disabled');
					$('#submit_button').val('Espere...');
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
						$('#classModal').modal('hide');
						$('#message').html(data.success);
						/* dataTable.ajax.reload(); */

						setTimeout(function(){

						$('#message').html('');
						location.reload();

						}, 1000);
					}
				}
			})
		}
	});

	$(document).on('click', '.edit_button', function(){

		var class_id = $(this).data('id');

		$('#class_form').parsley().reset();

		$('#form_message').html('');

		$.ajax({

	      	url:"classes_action.php",

	      	method:"POST",

	      	data:{class_id:class_id, action:'fetch_single'},

	      	dataType:'JSON',

	      	success:function(data)
	      	{

	        	$('#class_name').val(data.class_name);

				$('#class_teacher').val(data.class_teacher);

	        	$('#modal_title').text('Editar Clase');

	        	$('#action').val('Edit');

	        	$('#submit_button').val('Editar');

	        	$('#classModal').modal('show');

	        	$('#hidden_id').val(class_id);

	      	}

	    })

	});

	$(document).on('click', '.status_button', function(){
		var id = $(this).data('id');
    	var status = $(this).data('status');
		var next_status = 'Habilitado';
		if(status == 'Habilitado')
		{
			next_status = 'Deshabilitado';
		}
		if(confirm("Estás seguro de cambiar el estado de la clase a: "+next_status+"?"))
    	{

      		$.ajax({

        		url:"classes_action.php",

        		method:"POST",

        		data:{id:id, action:'change_status', status:status, next_status:next_status},

        		success:function(data)
        		{

          			/* dataTable.ajax.reload(); */
					$('#message').html(data);

          			setTimeout(function(){
            			$('#message').html('');
						location.reload();

          			}, 1000);

        		}

      		})

    	}
	});

	$(document).on('click', '.delete_button', function(){

    	var id = $(this).data('id');

    	if(confirm("Estás seguro de que quieres eliminarla?"))
    	{

      		$.ajax({

        		url:"classes_action.php",

        		method:"POST",

        		data:{id:id, action:'delete'},

        		success:function(data)
        		{

          			$('#message').html(data);

          			/* dataTable.ajax.reload(); */

          			setTimeout(function(){

            			$('#message').html('');
						location.reload();

          			}, 1000);

        		}

      		})

    	}

  	});

    $(document).on('click', '.add_subject', function(){
        
        $('#subject_form')[0].reset();

        $('#subject_form').parsley().reset();

        $('#subject_modal_title').text('Añadir tema');

        $('#hidden_action').val('Add');

        $('#subject_form_submit_button').val('Agregar');

        $('#subjectModal').modal('show');

        $('#subject_form_message').html('');

        var class_id = $(this).data('id');

        $('#class_id').val(class_id);

    });

    $('#subject_form').parsley();

    $('#subject_form').on('submit', function(event){
        event.preventDefault();
        if($('#subject_form').parsley().isValid())
        {       
            $.ajax({
                url:"subject_action.php",
                method:"POST",
                data:$(this).serialize(),
                dataType:'json',
                beforeSend:function()
                {
                    $('#subject_form_submit_button').attr('disabled', 'disabled');
                    $('#subject_form_submit_button').val('Espere...');
                },
                success:function(data)
                {
                    $('#subject_form_submit_button').attr('disabled', false);
                    if(data.error != '')
                    {
                        $('#subject_form_message').html(data.error);
                        $('#subject_form_submit_button').val('Agregar');
                    }
                    else
                    {
                        $('#subjectModal').modal('hide');
                        $('#message').html(data.success);
                        /* dataTable.ajax.reload(); */

                        setTimeout(function(){

                            $('#message').html('');
							location.reload();

                        }, 1000);
                    }
                }
            })
        }
    });



});
</script>