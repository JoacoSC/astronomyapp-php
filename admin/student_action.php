<?php

//subject_action.php

include('srms.php');

$object = new srms();

include('../connection.php');

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
		
		$student_email_id =	$_POST["student_email"];
		
		$query = "SELECT * FROM student_srms WHERE student_email_id = ?";

		$q = mysqli_stmt_init($con);

		mysqli_stmt_prepare($q, $query);

		// bind the statement
		mysqli_stmt_bind_param($q, 's', $student_email_id);

		// execute sql statement
		mysqli_stmt_execute($q);

		$result = mysqli_stmt_get_result($q);

		$row_count = mysqli_num_rows($result);
		
		if($row_count > 0)
		{
			$error = '<div class="alert alert-danger"><b>Error! </b>El email del estudiante ya está registrado</div>';
		}
		else
		{
			$name 		=	$_POST["student_name"];
			$ap_pat 	=	$_POST["student_ap_pat"];
			$ap_mat 	=	$_POST["student_ap_mat"];
			$rut 		=	$_POST["rut"];
			$dv 		=	$_POST["dv"];
			$email 		=	$_POST["student_email"];
			$dob 		=	$_POST["student_dob"];
			$tea_email 	=	$_POST["student_teacher_email"];
			$inst 		=	$_POST["student_institution"];

			//CALCULO DE CONTRASEÑA
			
			$primerResultado = substr($rut, 0, 4);
			$segundoResultado = substr($name, 0, 4);
			$contraseña = $primerResultado.$segundoResultado;

			$hashed_pass = password_hash($contraseña, PASSWORD_DEFAULT);
			
			//CALCULO DE CONTRASEÑA

			$query = "INSERT INTO student_srms (student_name, student_father_lastname, student_mother_lastname, rut, dv, student_email_id, student_dob, email_profesor, hashed_pass, institution)";
			/* VALUES ('$nombre', '$apellidoPat','$apellidoMat','$rut','$email','". md5($contraseña)."','$telefono','$fecha_nac','$region','$comuna')"); */
			$query .= " VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			// initialize a statement
			$q = mysqli_stmt_init($con);

			// prepare sql statement
			mysqli_stmt_prepare($q, $query);

			// bind values
			mysqli_stmt_bind_param($q, 'sssiisssss', $name, $ap_pat, $ap_mat, $rut, $dv, $email, $dob, $tea_email, $hashed_pass, $inst);

			// execute statement
			mysqli_stmt_execute($q);

			if(mysqli_stmt_affected_rows($q) == 1){

				$success = '<div class="alert alert-success"><b>Éxito! </b>Estudiante agregado correctamente!</div>';
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
		SELECT * FROM student_srms 
		WHERE student_id = '".$_POST["student_id"]."'
		";

		$result = $object->get_result();

		$data = array();

		foreach($result as $row)
		{
			$data['student_name'] 				= $row['student_name'];
			$data['student_ap_pat'] 			= $row['student_father_lastname'];
			$data['student_ap_mat'] 			= $row['student_mother_lastname'];
			$data['rut'] 						= $row['rut'];
			$data['dv'] 						= $row['dv'];
			$data['student_email'] 				= $row['student_email_id'];
			$data['student_dob']				= $row['student_dob'];
			$data['student_teacher_email']		= $row['email_profesor'];
			$data['student_institution']		= $row['institution'];
			
		}

		echo json_encode($data);
	}

	if($_POST["action"] == 'Edit')
	{
		$error = '';

		$success = '';

		$data = array(
			':student_id'		=>	$_POST['hidden_id']
		);

		$object->query = "
		SELECT * FROM student_srms 
		WHERE student_id = :student_id
		";

		$object->execute($data);

		if($object->row_count() > 1)
		{
			$error = '<div class="alert alert-danger"><b>Error!</b>Existe otro alumno con el mismo ID</div>';
		}
		else
		{

			$data = array(
				':student_name'			=>	$_POST["student_name"],
				':student_ap_pat'		=>	$_POST["student_ap_pat"],
				':student_ap_mat'		=>	$_POST["student_ap_mat"],
				':rut'					=>	$_POST["rut"],
				':dv'					=>	$_POST["dv"],
				':student_email'		=>	$_POST["student_email"],
				':student_dob'			=>	$_POST["student_dob"],
				':student_teacher_email'=>	$_POST["student_teacher_email"],
				':student_institution'	=>	$_POST["student_institution"]
			);

			$object->query = "
			UPDATE student_srms 
			SET student_name = :student_name, 
			student_father_lastname = :student_ap_pat, 
			student_mother_lastname = :student_ap_mat, 
			rut = :rut, 
			dv = :dv, 
			student_email_id = :student_email, 
			student_dob = :student_dob, 
			email_profesor = :student_teacher_email, 
			institution = :student_institution 
			WHERE student_id = '".$_POST['hidden_id']."'
			";

			$object->execute($data);

			$success = '<div class="alert alert-success"><b>Éxito! </b>Datos del estudiante actualizados, se refrescará la página...</div>';
			
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

		echo '<div class="alert alert-success">Estado del estudiante actualizado a: '.$_POST['next_status'].'</div>';
	}

	if($_POST["action"] == 'delete')
	{
		$object->query = "
		DELETE FROM student_srms 
		WHERE student_id = '".$_POST["id"]."'
		";

		$object->execute();

		echo '<div class="alert alert-success"><b>Éxito! </b>Estudiante eliminado correctamente</div>';
	}

}



?>