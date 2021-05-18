<?php

include('../connection.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de administración Astronomyapp</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <link href="../css/styles.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <!-- <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    
    <link href="../vendor/datatables/fixedcolumns-3.3.2/css/fixedcolumns.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="../vendor/parsley/parsley.css"/>

    <link rel="stylesheet" type="text/css" href="../vendor/bootstrap-select/bootstrap-select.min.css"/>

    <link rel="stylesheet" type="text/css" href="../vendor/datepicker/bootstrap-datepicker.css"/>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    
                </div>
                <!-- <i class="fas fa-laugh-wink"></i> -->
                <div class="sidebar-brand-text mx-3">Administración Astronomyapp</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <?php
            if($object->is_master_user())
            {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="classes.php">
                    <i class="fas fa-chalkboard"></i>
                    <span>Clases</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="students.php">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Estudiantes</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="exam.php">
                    <i class="fas fa-edit"></i>
                    <span>Opcion C</span></a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="teachers.php">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <span>Profesores</span></a>
            </li>
            <?php
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="institutions.php">
                    <i class="fas fa-school"></i>
                    <span>Instituciones</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline mt-3">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <?php
                        $object->query = "
                        SELECT * FROM user_srms 
                        WHERE user_id = '".$_SESSION['user_id']."'
                        ";

                        $user_result = $object->get_result();

                        $user_name = '';
                        $user_profile_image = '';
                        foreach($user_result as $row)
                        {
                            if($row['user_name'] != '')
                            {
                                $user_name = $row['user_name'];
                            }
                            else
                            {
                                $user_name = 'Master';
                            }

                            if($row['user_profile'] != '')
                            {
                                $user_profile_image = $row['user_profile'];
                            }
                            else
                            {
                                $user_profile_image = '../img/undraw_profile.svg';
                            }
                        }
                        ?>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="user_profile_name"><?php echo $user_name; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?php echo $user_profile_image; ?>" id="user_profile_image">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                