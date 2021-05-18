<?php
    include 'header.php';

    $clases = obtenerClasesHabilitadasTeacher($con, $user['id']);
    $estudiantes = obtenerEstudiantes($con, $user['email']);

?>

    <!-- <div id="sendCtrls">
        <input type="text" placeholder="Tu mensaje aquí" id="text">

        <button>Enviar</button>
    </div> -->
    
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        
                    </div>

                    <div class="card-body">
                    <h6 class="h5 mb-4 text-gray-800">Para empezar, seleccione una clase:</h6>

                        <form action="iniciarClase.php" method="GET">

                            
                            <div class="form-group">
                                <select class="form-control" name="clase" id="clase" value="<?php if(isset($_GET['clase'])) {echo $_GET['clase'];} ?>">

                                    <option value="0">Seleccione clase</option>
                                    <?php
                                    if(!empty($clases)){

                                        foreach ($clases as $clase) : 
                                        ?>
                                            <option value="<?php echo $clase[0] ?>"><?php echo $clase[1] ?></option>

                                        <?php
                                        endforeach;
                                        }
                                        ?>
                                
                                </select>
                            </div>

                            <button class="btn btn-info btn-user mt-3" type="submit">Continuar</button>
                        
                        </form>

                    </div>

                    <div class="table-responsive px-3 ">
                    

                                <?php

                                if($_SERVER['REQUEST_METHOD']=='GET')
                                        {
                                            
                                            if (isset($_GET['clase'])){
                                                echo "<hr>";

                                                $id = $_GET['clase'];
                                                $resultados = obtenerClaseEspecifica($con, $id);

                                            }

                                            if(!empty($resultados)){

                                                foreach ($resultados as $resultado) : 
                                        ?>

                                <form class="user" method="POST" id="form_clase" action="iniciarClase_action.php">
                                        <div class="form-group">
                                            
                                            
                                            <h6 class="h3 mt-5 mb-5 text-gray-800">Clase: <?php echo $resultado[1] ?></h6>

                                            <h6 class="h5 mt-5 mb-4 text-gray-800">A continuación, puede modificar la lista de estudiantes para la clase:</h6>

                                            <?php
                                            
                                            endforeach;
                                            }
                                        }
                                        if (isset($_GET['clase'])){
                                            
                                            ?>
                                            <div>
                                                <select class="form-control" name="estudiantes" id="estudiantes" value="">
                                                <?php
                                                if(!empty($estudiantes)){

                                                foreach ($estudiantes as $estudiante) : 
                                                ?>
                                                    <option value="<?php echo $estudiante[0] ?>"><?php echo $estudiante[1]." ";  echo $estudiante[2]." "; echo $estudiante[3]." "; ?></option>

                                                <?php
                                                endforeach;
                                                }
                                                ?>
                                                    
                                                </select>
                                            </div>

                                            <a class="btn btn-success mt-3 mb-4" id="agregarLista">
                                                Agregar a la lista
                                            </a>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Apellido Paterno</th>
                                                        <th>RUT</th>
                                                        <th>E-mail</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tablaLista">
                                                    
                                                    
                                                </tbody>
                                            </table>
                                            
                                            <input type="hidden" name="idClase" value="<?php echo $id ?>">
                                            
                                        </div>
                                        
                                        <hr>
                                        <button class="btn btn-success mt-3" id="iniciarClase_submit" type="submit">
                                            Iniciar clase
                                        </button>

                                        <?php
                                        }
                                        ?>

                                        <!-- <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                            </div>

                    <!-- FIN DE SELECCION DE CLASE -->
                
                </div>
            </div>
            <!-- End of Main Content -->

<?php

    include 'footer.php';

?>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"cargar_datos_clases.php",
			data:"clase=" + $('#clase').val(),
			success:function(r){
                
                var resultado = JSON.parse(JSON.stringify(r));
				console.log(resultado);
                /* $('#clase').html(resultado); */
                
			}
		});

        /* console.log("resultado"); */
	}

    function cargarEstudiantes(){

        var json_estudiantes = <?php echo json_encode($estudiantes); ?>;
        console.log(json_estudiantes);
        arr = JSON.parse(JSON.stringify(json_estudiantes)); //convert to javascript array
        $.each(arr,function(key,estudiante){
            console.log(estudiante);
            html = '<tr><input type="hidden" name="estudiantesArray[]" value="'+estudiante[0]+'"><td class="celdaProducto">'+estudiante[1]+'</td><td class="celdaCantidad">'+estudiante[2]+'</td><td class="celdaStock">'+estudiante[4]+'</td><td class="celdaStock">'+estudiante[5]+'</td><td><a class="delete a-delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xe14c;</i></a></td></tr>';
            

            if ( $('#tablaLista').children().length > 0 ) {
                $('#tablaLista tr:last').after(html);
            }else{
                $('#tablaLista').html(html);
            }
        });
        
    }
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clase').val(0);
		recargarLista();
        cargarEstudiantes();

		$('#clase').change(function(){
			recargarLista();
		});
	})
</script>



<script>
    $(document).ready(function(){
    
    $('[data-toggle="tooltip"]').tooltip({
        trigger : 'hover'
    });

    $('[data-toggle="tooltip"]').on('click', function () {
        $(this).tooltip('hide')
    });
    var actions = $("table td:last-child").html();
    
    $('#agregarLista').on('click', function(){
                
        if(!$('#estudiantes').val()){

            alert("Ingrese ESTUDIANTES por favor");

        }/* else if(!$('#cantidad').val()){

            alert("Ingrese la CANTIDAD de estudiantes por favor");
            
        }else if(!$('#stock').val()){
            
            alert("Ingrese el STOCK de estudiantes por favor");

            } */else{

                $.ajax({
                    type:"POST",
                    url:"cargar_datos_especifico.php",
                    data:"estudiante=" + $('#estudiantes').val(),
                    success:function(r){
                        
                        html = r;
            
                        if ( $('#tablaLista').children().length > 0 ) {
                            $('#tablaLista tr:last').after(html);
                        }else{
                            $('#tablaLista').html(html);
                        }

                    }
                });
                
                /* html = '<tr><td class="celdaProducto">'+producto+'</td><td class="celdaCantidad">'+cantidad+'</td><td class="celdaStock">'+stock+'</td><td class="celdaStock">'+stock+'</td><td><a class="delete a-delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xe14c;</i></a></td></tr>'; */
                
                /* $('#tablaLista tr:last').after(html); */

                /* if ( $('#tablaLista').children().length > 0 ) {
                    $('#tablaLista tr:last').after(html);
                }else{
                    $('#tablaLista').html(html);
                } */
            }

    });
	
	$(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
		$(".add-new").removeAttr("disabled");
    });
});


/* $('#submit').click(function(){



    $('#submit').submit();
}); */
</script>