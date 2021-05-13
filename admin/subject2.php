<?php

//subject.php

include('srms.php');

$object = new srms();

/* CREAR CONTROL DE LOGIN / PROTECCION DE URL */

include('header.php');
include('../helper.php');
$temas = obtenerTemas($con);

?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Temas</h1>

                    <!-- DataTales Example -->
                    <span id="message"></span>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col">
                            		<h6 class="m-0 font-weight-bold text-primary">Lista de temas</h6>
                            	</div>
                            	<div class="col" align="right">

                            	</div>
                            </div>
                        </div>
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

                                    <?php
                                        foreach ($temas as $tema) {
                                        ?>

                                        <tr>
                                            <td><?php echo $tema[2] ?></td>
                                        
                                            <td><?php echo $tema[4] ?></td>
                                        
                                            <td><?php echo $tema[3] ?></td>
                                        
                                            <td>
                                                <div align="center">
                                                    <button type="button" name="edit_button" class="btn btn-warning btn-circle btn-sm edit_button" data-id=""><i class="fas fa-edit"></i></button>
                                                    &nbsp;
                                                    <button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id=""><i class="fas fa-times"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php
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