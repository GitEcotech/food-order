<?php 
    include('config/constants.php');
    // get id of admin
    $id = $_GET['id'];

    $sql = "delete from tbl_admin where id=$id";    //query
    $res = mysqli_query($con, $sql);    // execute query

    if($res == true)
    {
        // echo "Admin deleted";
        $_SESSION['delete'] = "<div class='success'>Admin Deleted</div>";
        header("location:".siteUrl."admin/manage-admin.php");
    }
    else
    {
        // echo "no";
        $_SESSION['delete'] = "<div class='error'>Fail to Delete Admin</div>";
        header("location:".siteUrl."admin/manage-admin.php");
    }
?>