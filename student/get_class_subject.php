<?php
    include 'header.php';

    if(isset($_GET['classID'])){
        $class_array = infoClaseActualStudent($con, $_GET['classID'], $user[0]);
        $subject_array = infoTemaActualStudent($con, $class_array['current_subject_id']);

        if($subject_array['subject_name'] == 'Planetas del sistema solar'){
            
            header('location: planets-video.php?studentID='.$user[0]);
            exit();
        }
        if($subject_array['subject_name'] == 'Eclipses'){
            
            header('location: eclipses-video.php?studentID='.$user[0]);
            exit();
        }
        if($subject_array['subject_name'] == 'Fases de la luna'){
            
            header('location: moon-video.php?studentID='.$user[0]);
            exit();
        }
        if($subject_array['subject_name'] == 'El día y la noche'){
            
            header('location: dayNight-video.php?studentID='.$user[0]);
            exit();
        }
    }else if(isset($_GET['subjectID'])){
        
        $subject_array = infoTemaActualStudent($con, $_GET['subjectID']);

        if($subject_array['subject_name'] == 'Planetas del sistema solar'){

            header('location: planets-video.php?studentID='.$user[0]);
            exit();
        }
        if($subject_array['subject_name'] == 'Eclipses'){
            
            header('location: eclipses-video.php?studentID='.$user[0]);
            exit();
        }
        if($subject_array['subject_name'] == 'Fases de la luna'){
            
            header('location: moon-video.php?studentID='.$user[0]);
            exit();
        }
        if($subject_array['subject_name'] == 'El día y la noche'){
            
            header('location: dayNight-video.php?studentID='.$user[0]);
            exit();
        }
    }
    
?>