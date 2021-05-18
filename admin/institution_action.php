<?php

//subject_action.php

include('srms.php');

$object = new srms();

include('../connection.php');
include('../helper.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
		$order_column = array('student_srms.student_roll_no', 'student_srms.student_name', 'class_srms.class_name', 'student_srms.student_email_id', 'student_srms.student_gender', 'student_srms.student_dob', 'student_srms.student_added_on', 'student_srms.student_status');

		$output = array();

		$main_query = "
			SELECT * FROM student_srms 
			INNER JOIN class_srms 
			ON class_srms.class_id = student_srms.class_id 
		";

		$search_query = '';

		if(isset($_POST["search"]["value"]))
		{
			$search_query .= 'WHERE student_srms.student_roll_no LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR student_srms.student_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR class_srms.class_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR student_srms.student_email_id LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR student_srms.student_gender LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR student_srms.student_dob LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR student_srms.student_added_on LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR student_srms.student_status LIKE "%'.$_POST["search"]["value"].'%" ';
		}

		if(isset($_POST["order"]))
		{
			$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_query = 'ORDER BY student_srms.student_id DESC ';
		}

		$limit_query = '';

		if($_POST["length"] != -1)
		{
			$limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$object->query = $main_query . $search_query . $order_query;

		$object->execute();

		$filtered_rows = $object->row_count();

		$object->query .= $limit_query;

		$result = $object->get_result();

		$object->query = $main_query;

		$object->execute();

		$total_rows = $object->row_count();

		$data = array();

		foreach($result as $row)
		{
			$sub_array = array();
			$sub_array[] = html_entity_decode($row["student_roll_no"]);
			$sub_array[] = html_entity_decode($row["student_name"]);
			$sub_array[] = html_entity_decode($row["class_name"]);
			$sub_array[] = $row["student_email_id"];
			$sub_array[] = $row["student_gender"];
			$sub_array[] = $row["student_dob"];
			$sub_array[] = $row["student_added_on"];
			$status = '';
			if($row["student_status"] == 'Habilitado')
			{
				$status = '<button type="button" name="status_button" class="btn btn-primary btn-sm status_button" data-id="'.$row["student_id"].'" data-status="'.$row["student_status"].'">Habilitado</button>';
			}
			else
			{
				$status = '<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="'.$row["student_id"].'" data-status="'.$row["student_status"].'">Deshabilitado</button>';
			}
			$sub_array[] = $status;
			$sub_array[] = '
			<div align="center">
			<button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id="'.$row["student_id"].'"><i class="fas fa-edit"></i></button>
			&nbsp;
			<button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$row["student_id"].'"><i class="fas fa-times"></i></button>
			</div>
			';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"    			=> 	intval($_POST["draw"]),
			"recordsTotal"  	=>  $total_rows,
			"recordsFiltered" 	=> 	$filtered_rows,
			"data"    			=> 	$data
		);
			
		echo json_encode($output);
	}

	if($_POST["action"] == 'Add')
	{
		$error = '';

		$success = '';
		
		$institution_name =	$_POST["institution_name"];
        $institution_campus 	=	$_POST["institution_campus"];
		
		$query = "SELECT * FROM institution_srms WHERE institution_name = ? AND institution_campus = ?";

		$q = mysqli_stmt_init($con);

		mysqli_stmt_prepare($q, $query);

		// bind the statement
		mysqli_stmt_bind_param($q, 'ss', $institution_name, $institution_campus);

		// execute sql statement
		mysqli_stmt_execute($q);

		$result = mysqli_stmt_get_result($q);

		$row_count = mysqli_num_rows($result);
		
		if($row_count > 0)
		{
			$error = '<div class="alert alert-danger"><b>Error! </b>La institución ya está registrada</div>';
		}
		else
		{
			$institution_name 		=	$_POST["institution_name"];
			$institution_campus 	=	$_POST["institution_campus"];

			$query = "INSERT INTO institution_srms (institution_name, institution_campus)";
			/* VALUES ('$nombre', '$apellidoPat','$apellidoMat','$rut','$email','". md5($contraseña)."','$telefono','$fecha_nac','$region','$comuna')"); */
			$query .= " VALUES(?, ?)";

			// initialize a statement
			$q = mysqli_stmt_init($con);

			// prepare sql statement
			mysqli_stmt_prepare($q, $query);

			// bind values
			mysqli_stmt_bind_param($q, 'ss', $institution_name, $institution_campus);

			// execute statement
			mysqli_stmt_execute($q);

			if(mysqli_stmt_affected_rows($q) == 1){

				$success = '<div class="alert alert-success"><b>Éxito! </b>Agregando institución...</div>';
			}else{
				$error = '<div class="alert alert-danger"><b>Error! </b>Ocurrió algún error durante el registro</div>';
			}
		}

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);

	}

	if($_POST["action"] == 'fetch_single')
	{
		$object->query = "
		SELECT * FROM institution_srms 
		WHERE institution_id = '".$_POST["institution_id"]."'
		";

		$result = $object->get_result();

		$data = array();

		foreach($result as $row)
		{
			$data['institution_name'] 				= $row['institution_name'];
			$data['institution_campus'] 			= $row['institution_campus'];
			
		}

		echo json_encode($data);
	}

	if($_POST["action"] == 'Edit')
	{
		$error = '';

		$success = '';

		$data = array(
            ':institution_name'			=>	$_POST["institution_name"],
            ':institution_campus'		=>	$_POST["institution_campus"]
		);

		$object->query = "
		SELECT * FROM institution_srms 
		WHERE institution_name = :institution_name
        AND institution_campus = :institution_campus
		";

		$object->execute($data);

		if($object->row_count() > 0)
		{
			$error = '<div class="alert alert-danger"><b>Error! </b>Existe otro instituto con el mismo nombre y campus</div>';
		}
		else
		{

			$data = array(
				':institution_name'			=>	$_POST["institution_name"],
				':institution_campus'		=>	$_POST["institution_campus"]
			);

			$object->query = "
			UPDATE institution_srms 
			SET institution_name = :institution_name, 
			institution_campus = :institution_campus
			WHERE institution_id = '".$_POST['hidden_id']."'
			";

			$object->execute($data);

			$success = '<div class="alert alert-success"><b>Éxito! </b>Actualizando datos de la institución...</div>';
			
		}

		$output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);

	}

	if($_POST["action"] == 'change_status')
	{
		$data = array(
			':student_status'		=>	$_POST['next_status']
		);

		$object->query = "
		UPDATE student_srms 
		SET student_status = :student_status 
		WHERE student_id = '".$_POST["id"]."'
		";

		$object->execute($data);

		echo '<div class="alert alert-success">Actualizando estado del estudiante a: '.$_POST['next_status'].'</div>';
	}

	if($_POST["action"] == 'delete')
	{
        $error = '';

		$success = '';
		
		$institution_id =	$_POST["id"];
		
		$cantidad = cantidadDeInscritosAInstitucion($con, $institution_id);
		
		if($cantidad > 0)
		{
			$error = '<div class="alert alert-danger alert-dismissible fade show"><b>Error! </b>La institución no se puede eliminar porque hay profesores y/o alumnos registrados que pertenecen a esa institución.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>';
		}
		else
		{
            $object->query = "
            DELETE FROM institution_srms 
            WHERE institution_id = '".$_POST["id"]."'
            ";

            $object->execute();

            $success = '<div class="alert alert-success"><b>Éxito! </b>Eliminando institución...</div>';
        }

        $output = array(
			'error'		=>	$error,
			'success'	=>	$success
		);

		echo json_encode($output);
	}

}



?>