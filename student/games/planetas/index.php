<?php

/* session_start(); */

/* if(isset($_SESSION['id'])){
    echo ($_SESSION['id']);
}else{
    echo "No encontrado";
} */


?>

<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Puzzle Planetas</title>
    <link rel="shortcut icon" href="TemplateData/favicon.ico">
    <link rel="stylesheet" href="TemplateData/style.css">
    <script src="TemplateData/UnityProgress.javascript"></script>
    <script src="Build/UnityLoader.js"></script>
    <script>
        var gameInstance = UnityLoader.instantiate("gameContainer", "Build/planetas.json", {onProgress: UnityProgress});
    </script>
</head>
<body style="width: 800px">
<div class="webgl-content" style="width: 800px">
    <div id="gameContainer" style="width: 800px;"></div>
</div>
<div class="simmer">template by: <a href="https://simmer.io" target="_blank">SIMMER.io</a></div>
<script src="TemplateData/responsive.javascript"></script>
</body>
</html>