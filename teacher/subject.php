<?php

//subject.php

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

$object->query = "
SELECT class_name FROM class_srms 
WHERE class_code = '".$_GET["class"]."'
";
$result = $object->get_result();

$class_name = '';

foreach($result as $row)
{
    $class_name = $row['class_name'];
}

?>

				<div class="container-fluid card-style">
                
                    <!-- Page Heading -->
					<h1 class="h3 mt-2 mb-4 text-gray-800">Gestión de temas de la clase: <?php echo $class_name; ?></h1>    

                    <!-- DataTales Example -->
                    <span id="message"></span>
                    <div class="card shadow mb-4">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="subject_table" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Creado el:</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
				</div>

                <?php
                include('footer.php');
                ?>

<div id="subjectModal" class="modal fade">
  	<div class="modal-dialog">
    	<form method="post" id="subject_form">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="modal_title">Añadir tema</h4>
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		</div>
        		<div class="modal-body">
        			<span id="form_message"></span>
		          	<div class="form-group">
		          		<label>Nombre</label>
		          		<input type="text" name="subject_name" id="subject_name" class="form-control" required data-parsley-trigger="keyup" />
		          	</div>
        		</div>
        		<div class="modal-footer">
          			<input type="hidden" name="hidden_id" id="hidden_id" />
          			<input type="hidden" name="hidden_action" id="hidden_action" value="Add" />
          			<input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Add" />
          			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        		</div>
      		</div>
    	</form>
  	</div>
</div>

<script>
$(document).ready(function(){

	var dataTable = $('#subject_table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"subject_action.php",
			type:"POST",
			data:{hidden_action:'fetch', class_code:'<?php echo $_GET["class"]; ?>'}
		},
		"columnDefs":[
			{
				"targets":[2, 3],
				"orderable":false,
			},
		],
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
					$('#submit_button').attr('disabled', 'disabled');
					$('#submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#submit_button').attr('disabled', false);
					if(data.error != '')
					{
						$('#form_message').html(data.error);
						$('#submit_button').val('Add');
					}
					else
					{
						$('#subjectModal').modal('hide');
						$('#message').html(data.success);
						dataTable.ajax.reload();

						setTimeout(function(){

				            $('#message').html('');

				        }, 5000);
					}
				}
			})
		}
	});

	$(document).on('click', '.edit_button', function(){

		var subject_id = $(this).data('id');

		$('#subject_form').parsley().reset();

		$('#form_message').html('');

		$.ajax({

	      	url:"subject_action.php",

	      	method:"POST",

	      	data:{subject_id:subject_id, hidden_action:'fetch_single'},

	      	dataType:'JSON',

	      	success:function(data)
	      	{

	        	$('#subject_name').val(data.subject_name);

	        	$('#modal_title').text('Editar tema');

	        	$('#hidden_action').val('Edit');

	        	$('#submit_button').val('Editar');

	        	$('#subjectModal').modal('show');

	        	$('#hidden_id').val(subject_id);

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
		if(confirm("Estás seguro de que quieres cambiar el estado a: "+next_status+"?"))
    	{

      		$.ajax({

        		url:"subject_action.php",

        		method:"POST",

        		data:{id:id, hidden_action:'change_status', status:status, next_status:next_status},

        		success:function(data)
        		{

          			$('#message').html(data);

          			dataTable.ajax.reload();

          			setTimeout(function(){

            			$('#message').html('');

          			}, 5000);

        		}

      		})

    	}
	});

	$(document).on('click', '.delete_button', function(){

    	var id = $(this).data('id');

    	if(confirm("Estás seguro de eliminarlo?"))
    	{

      		$.ajax({

        		url:"subject_action.php",

        		method:"POST",

        		data:{id:id, hidden_action:'delete'},

        		success:function(data)
        		{

          			$('#message').html(data);

          			dataTable.ajax.reload();

          			setTimeout(function(){

            			$('#message').html('');

          			}, 5000);

        		}

      		})

    	}

  	});

});
</script>