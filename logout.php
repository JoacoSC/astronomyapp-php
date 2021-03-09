<?php
session_start();
if (session_destroy()) {
    print("CERRANDO SESION...");
header("Location: index.php");
}
?>