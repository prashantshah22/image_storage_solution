<?php 
    session_start();
    $_SESSION=array();
    session_destroy();
    // header("Location:../../index.php")
    $rootPath = $_SERVER['DOCUMENT_ROOT'] . '/index.php';
    header("Location: /index.php");
    exit();
?>  