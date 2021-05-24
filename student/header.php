<?php 
    /* session_start(); */

    include('srms.php');

    $object = new srms();
    
    include ('../helper.php');

    $user = array();
    
    if(isset($_SESSION['id'])){
        /* print "entré"; */
        require ('../connection.php');
        $user = get_user_info($con, $_SESSION['id']);
        /* echo $_SESSION['id']; */
        /* echo "entre"; */
        /* echo isset($user[0]); */
        /* foreach ($user as $key => $value) {
            echo "Key: $key; Value: $value\n<br>";
        } */
    }else{
        header("location:".$object->base_url);
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Astronomyapp</title>

    <link rel="icon" type="image/png" href="../img/favicon.png" sizes="64x64">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../vendor/datatables/fixedcolumns-3.3.2/css/fixedcolumns.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../vendor/DataTables/datatables.min.css"/>
    <!-- <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

</head>

<body id="page-top">

<!-- <div class="text-center">
    <img class="img-fluid" src="../img/logo_grande.png" alt="">
</div> -->

    
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div class="student_background" id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top nav-shadow">
                
                    <div class="col-3">
                        <div class="text-center header_logo">
                        <a href="index.php"><img class="img-fluid" src="../img/logo_grande.png" alt=""></a>
                        </div>
                        
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                    <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-1 d-none d-lg-inline astronomy-font"><?php echo $user['student_name']?></span>
                                    <span class="mr-4 d-none d-lg-inline app-font"><?php echo $user['student_father_lastname'] ?> </span>
                                    <img class="img-profile rounded-circle"
                                        src="../img/undraw_profile_1.svg">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right profile-menu-shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="profile.php">
                                        <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Editar perfil
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