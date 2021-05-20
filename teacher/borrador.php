<?php

        /* $data = array(
				':class_name'			=>	$object->clean_input($_POST["class_name"]),
				':class_code'			=>	md5(uniqid()),
				':class_status'			=>	'Habilitado',
				':class_created_on'		=>	$object->now
			); */


            /* $('#class_form').on('submit', function(event){
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
						dataTable.ajax.reload();

						 setTimeout(function(){

				            $('#message').html('');

				        }, 5000); 
					}
				}
			})
		}
	});        */     


    
    if($_POST["hidden_action"] == 'Add')
	{
		$error = '';

		$success = '';
		

		/* $data = array(
			':class_id'		=>	$_POST["class_id"],
			':subject_name'	=>	$_POST["subject_name"]
		);

		$object->query = "
		SELECT * FROM subject_srms 
		WHERE class_id = :class_id 
		AND subject_name = :subject_name
		";

		$object->execute($data); */

		':class_id' = $_POST["class_id"];
		':subject_id' = $_POST["subject_name"];

		$query = "SELECT * FROM class_subject_srms WHERE class_id = :class_id";

		$q = mysqli_stmt_init($con);

		mysqli_stmt_prepare($q, $query);

		mysqli_stmt_execute($q);

		$result = mysqli_stmt_get_result($q);

		$rows = mysqli_fetch_all($result);

		$i = 0;

		foreach ($rows as $row) { 

			$j = $row[1];
			$subject_id = $_POST["subject_name"];

			if($j == $subject_id){
				$error = '<div class="alert alert-danger">Ese tema ya existe en la clase <b>'.$object->Get_class_name($_POST["class_id"]).'</b></div>';
				break;
			}else{

				if($j == 0){
					$class_id = $_POST["class_id"];
					$subject_id = $_POST["subject_name"];

					$query = "UPDATE class_subject_srms SET subject_id = '?' WHERE class_id = '?' AND subject_id = '?'";
			
					$q = mysqli_stmt_init($con);
					mysqli_stmt_prepare($q, $query);

					// bind parameter
					mysqli_stmt_bind_param($q, 'iii', $subject_id, $class_id, $j);
					
					// execute statement
					mysqli_stmt_execute($q);

					/* $object->query = "
					UPDATE class_subject_srms SET subject_id = :subject_id WHERE class_id = :class_id
					";

					$object->execute($data); */

					$success = '<div class="alert alert-success">Tema añadido en la clase <b>'.$object->Get_class_name($_POST["class_id"]).'</b></div>';

				}
			}
			
		}

		/* if($object->row_count() > 0)
		{
			$error = '<div class="alert alert-danger">Ese tema ya existe en la clase <b>'.$object->Get_class_name($_POST["class_id"]).'</b></div>';
		} */
		/* else
		{ */
			/* $data = array(
				':class_id'				=>	$object->clean_input($_POST["class_id"]),
				':subject_id'			=>	$object->clean_input($_POST["subject_id"])
			); */

			/* $class_id = $_POST["class_id"];
			$subject_id = $_POST["subject_name"];

			

			$query = "UPDATE class_subject_srms SET nombre = ? WHERE ID= ?";
    
			$q = mysqli_stmt_init($con);
			mysqli_stmt_prepare($q, $query); */

			// bind parameter
			/* mysqli_stmt_bind_param($q, 'si', $nombrecate, $id); */
			
			// execute statement
			/* mysqli_stmt_execute($q); */

			/* $object->query = "
			UPDATE class_subject_srms SET subject_id = :subject_id WHERE class_id = :class_id
			";

			$object->execute($data); */

			/* $success = '<div class="alert alert-success">Tema añadido en la clase <b>'.$object->Get_class_name($_POST["class_id"]).'</b></div>';
		} */

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);

	}