<?php 
    include('config/constants.php');
    session_destroy();

    header("location:".siteUrl."admin/login.php");
?>