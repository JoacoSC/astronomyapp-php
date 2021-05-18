                <?php

                include('srms.php');

				$object = new srms();

				if(!$object->is_login())
				{
				    header("location:".$object->base_url."");
				}

                if(!$object->is_master_user())
                {
                    header("location:".$object->base_url."admin/result.php");
                }

                include('header.php');
                include('../helper.php');

                ?>
                    <div class="container-fluid card-style mb-5 pb-4">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800 mt-3">Bienvenido!</h1>

                    <!-- Content Row -->
                    <div class="row row-cols-5">
                        <?php
                        if($object->is_master_user())
                        {
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col mb-4">
                            <div class="card border-left-warning h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Cantidad de clases</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $clases = contarClasesAdmin($con); echo $clases[0]; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col mb-4">
                            <div class="card border-left-info h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Cantidad de Estudiantes
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php $estudiantes = contarEstudiantesAdmin($con); echo $estudiantes[0]; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col mb-4">
                            <div class="card border-left-primary h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Cantidad de profesores</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $profesores = contarProfesoresAdmin($con); echo $profesores[0]; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <div class="col mb-4">
                            <div class="card border-left-danger h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Cantidad de instituciones</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $instituciones = contarInstitucionesAdmin($con); echo $instituciones[0]; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                  

                    <?php
                    }
                    ?>
                    </div>

                <?php
                include('footer.php');
                ?>