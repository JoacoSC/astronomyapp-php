<?php
    
    /* include('srms.php');

    $object = new srms();

    if(!$object->is_login())
    {
        header("location:".$object->base_url."admin");
    }

    if(!$object->is_master_user())
    {
        header("location:".$object->base_url."admin/result.php");
    } */

    include('header.php');
    
    /* include ('../helper.php'); */

    
    $estudiantes = obtenerEstudiantesTeacher($con, $user['email']);
    $profesores = obtenerProfesoresAdmin($con);
    $instituciones = obtenerInstitucionesAdmin($con);

    $array_instStud = array();
    if(!empty($estudiantes)){
        foreach ($estudiantes as $estudiante) : 
            $array_instStud[] = obtenerInstitucionTablaAdmin($con, $estudiante[12]);
        endforeach;
    }
    
    /* print_r ($estudiantes); */
    
    
?>

                <!-- Begin Page Content -->
                
                    <!-- Page Heading -->
                    <!-- <h1 class="h3 mb-2 text-gray-800">Consulta general</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p> -->

                            <div class="container-fluid card-style mb-5 pb-4">
                    <!-- DataTales Example -->
                    <!-- Page Heading -->
					<div class="row">
						<div class="col" align="left">
							<h1 class="h3 mt-2 mb-4 text-gray-800">Lista de estudiantes</h1>
                        </div>
						<div class="col" align="right">
                        <button type="button" name="add_student" id="add_student" class="btn btn-info btn-sm mt-3 mr-2" data-toggle="modal" data-target="#studentModal">Agregar un estudiante&nbsp;&nbsp;<i class="fas fa-plus"></i></button>
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
                                            <th>Apellido paterno</th>
                                            <th>Apellido materno</th>
                                            <th>RUT</th>
                                            <th>DV</th>
                                            <th>E-mail</th>
                                            <th style="min-width:200px">Institución</th>
                                            <th>Puntuaciones</th>
                                            <th>Estado</th>
                                            <th style="min-width:80px">Acciones</th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido paterno</th>
                                            <th>Apellido materno</th>
                                            <th>RUT</th>
                                            <th>E-mail</th>
                                        </tr>
                                    </tfoot> -->
                                    <tbody>
                                    <?php
                        
                                    if(!empty($estudiantes)){

                                        $i = 0;

                                        foreach ($estudiantes as $estudiante) : 
                                    ?>
                                        <tr>
                                        <td><?php echo $estudiante[1] ?></td>
                                        <td><?php echo $estudiante[2] ?></td>
                                        <td><?php echo $estudiante[3] ?></td>
                                        <td><?php echo $estudiante[4] ?></td>
                                        <td><?php echo $estudiante[5] ?></td>
                                        <td><?php echo $estudiante[6] ?></td>
                                        <td><?php echo ($array_instStud[$i][0][1]. " - ". $array_instStud[$i][0][2]) ?></td>
                                        <td><div align="center"><a type="button" name="scores_button" href="scores.php?student_id=<?php echo $estudiante[0]?>" class="btn btn-info btn-sm scores_button"><i class="fas fa-star"></i></a></div></td>
                                        <td>
                                        <?php

                                        if($estudiante[9] == 'Habilitado')
                                        {
                                            echo ('<button type="button" name="status_button" class="btn btn-primary btn-sm status_button" data-id="'.$estudiante[0].'" data-status="'.$estudiante[9].'">Habilitado</button>');
                                        }
                                        else
                                        {
                                            echo ('<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="'.$estudiante[0].'" data-status="'.$estudiante[9].'">Deshabilitado</button>');
                                        }
                                        ?>
                                        </td>

                                        <td>
                                        <?php
                                        echo ('<div align="center">
                                            <button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="'.$estudiante[0].'"><i class="fas fa-edit"></i></button>
                                            &nbsp;
                                            <button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$estudiante[0].'"><i class="fas fa-times"></i></button>
                                            </div>
                                            ');
                                        ?>
                                        </td>

                                        </tr>
                                    <?php
                                        $i++;
                                        endforeach;
                                        }
                                    ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div></div>

                
                <!-- /.container-fluid -->

                
            <!-- End of Main Content -->

<?php

include 'footer.php';

?>

<div id="studentModal" class="modal fade">
  	<div class="modal-dialog">
    	<form method="post" id="student_form">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="modal_title">Agregar estudiante</h4>
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		</div>
        		<div class="modal-body">
        			<span id="form_message"></span>
                    <div class="form-group">
		          		<label>Nombre del estudiante</label>
		          		<input type="text" name="student_name" id="student_name" class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-trigger="keyup" />
		          	</div>
                    <div class="form-group">
		          		<label>Apellido paterno</label>
		          		<input type="text" name="student_ap_pat" id="student_ap_pat" class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-trigger="keyup" />
		          	</div>
                    <div class="form-group">
		          		<label>Apellido materno</label>
		          		<input type="text" name="student_ap_mat" id="student_ap_mat" class="form-control" required data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-trigger="keyup" />
		          	</div>
                     <div class="form-group row" style="padding:12px;">
		          		<label>Rut</label>
		          		<input type="text" name="rut" id="rut" class="form-control col-4 ml-2" required maxlength="8" data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-trigger="keyup" />		          	
		          		<label class="ml-2  ">DV</label>
		          		<input type="text" name="dv" id="dv" class="form-control col-2 ml-2" required maxlength="1" data-parsley-pattern="/^[a-zA-Z0-9 \s]+$/" data-parsley-trigger="keyup" />
		          	</div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="student_email" id="student_email" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <label>Fecha de Nacimiento</label>
                        <input type="date" name="student_dob" id="student_dob" class="form-control datepicker" required data-parsley-trigger="keyup" />
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="student_teacher_email" value="<?php echo $user['email']?>">
                        
                    </div>
                    <div class="form-group">
                        <label>Institución</label>
                        <select type="text" name="student_institution" id="student_institution" class="form-control" data-parsley-trigger="keyup">
                            <?php
                                foreach ($instituciones as $institucion) {
                                ?>
                                    <option value="<?php echo $institucion[0] ?>"><?php echo $institucion[1].' - ('.$institucion[2].')' ?></option>
                                <?php
                                }
                            ?>
                            <!-- <option value="otro">Otro...</option> -->
                        </select>
                        <!-- <div class="form-group mt-2">
                            <label>Ingrese otra institución a continuación: </label>
                            <input type="text" name="other_teacher_institution" class="form-control hidden-textbox" data-parsley-trigger="keyup" />
                            <label>Campus: (Ejemplo: San Felipe)</label>
                            <input type="text" name="other_teacher_institution_campus" class="form-control hidden-textbox" data-parsley-trigger="keyup" />
                        </div> -->
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

    $('#student_teacher_email').on('change', function() {
    var changed = this,
    check = changed.value.toLowerCase() === "otro";
    
    $(changed).next().toggle(check).prop('required', check);
    }).change();

    var table = $('#dataTable').DataTable( {
        
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        fixedColumns:   {
            leftColumns: 0,
            rightColumns: 3
        },
        "columnDefs":[
			{
				"targets":[7, 8, 9],
				"orderable":false,
			},
		],
    } );

    $('#student_form').on('submit', function(event){
		event.preventDefault();
		if($('#student_form').parsley().isValid())
		{		
            
			$.ajax({
				url:"student_action.php",
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
                        $('#studentModal').modal('hide');
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

    $(document).on('click', '.status_button', function(){
		var id = $(this).data('id');
    	var status = $(this).data('status');
		var next_status = 'Habilitado';
		if(status == 'Habilitado')
		{
			next_status = 'Deshabilitado';
		}
		if(confirm("Estás seguro de que quieres cambiar el estado a: "+next_status+"?"))
    	{

      		$.ajax({

        		url:"student_action.php",

        		method:"POST",

        		data:{id:id, action:'change_status', status:status, next_status:next_status},

        		success:function(data)
        		{

          			/* $('#message').html(data); */

          			/* dataTable.ajax.reload(); */
                    location.reload();

          			setTimeout(function(){

            			$('#message').html('');
                        location.reload();

          			}, 2000);

        		}

      		})

    	}
	});

    $(document).on('click', '.edit_button', function(){

    var student_id = $(this).data('id');

    $('#student_form').parsley().reset();

    $('#form_message').html('');

    $.ajax({

      url:"student_action.php",

      method:"POST",

      data:{student_id:student_id, action:'fetch_single'},

      dataType:'JSON',

      success:function(data)
      {

        $('#student_name').val(data.student_name);
        $('#student_ap_pat').val(data.student_ap_pat);
        $('#student_ap_mat').val(data.student_ap_mat);
        $('#rut').val(data.rut);
        $('#dv').val(data.dv);
        $('#student_email').val(data.student_email);
        $('#student_dob').val(data.student_dob);
        $('#student_teacher_email').val(data.student_teacher_email);
        $('#student_institution').val(data.student_institution);

        $('#modal_title').text('Editar información de estudiante');

        $('#action').val('Edit');

        $('#submit_button').val('Editar');

        $('#studentModal').modal('show');

        $('#hidden_id').val(student_id);
      }

    })

    });

    $(document).on('click', '.delete_button', function(){

    var id = $(this).data('id');

    if(confirm("Estás seguro de que quieres eliminarlo?"))
    {

        $.ajax({

            url:"student_action.php",

            method:"POST",

            data:{id:id, action:'delete'},

            success:function(data)
            {

                $('#message').html(data);

                setTimeout(function(){

                    $('#message').html('');

                    location.reload();

                }, 2000);

            }

        })

    }

    });
        
});
</script>
