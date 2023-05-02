<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1><br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="post">
            <table width="40%">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="oldPass"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="newPass"></td>
                </tr>
                <tr> 
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confPass"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php 
    if(isset($_POST['submit']))
    {
        $oldPass = md5($_POST['oldPass']);
        $newPass = md5($_POST['newPass']);
        $confPass = md5($_POST['confPass']);

        $sql = "select * from tbl_admin where id=$id and password='$oldPass'";
        $res = mysqli_query($con, $sql);
         
        if($res == true)
        {
            $count = mysqli_num_rows($res);
            if($count ==1)
            {
                // user exist
                if($newPass == $confPass)
                {
                    $sql2 = " update tbl_admin set password='$newPass' where id=$id";
                    $res = mysqli_query($con, $sql2);
                    if($res == true)
                    {
                        $_SESSION['pass-found'] = "<div class='success'>Password Changed.</div>";
                        header("location:".siteUrl."admin/manage-admin.php");
                    }
                    else
                    {
                        $_SESSION['pass-found'] = "<div class='error'>Fail to Change password.</div>";
                        header("location:".siteUrl."admin/manage-admin.php");
                    }
                }
                else
                {
                    echo '<script type="text/javascript">
                    alert("new password and confirm password does not match");</script>';
                } 
            }
            else
            {
                // user not exist
                $_SESSION['pass-found'] = "<div class='error'>User not found.</div>";
                header("location:".siteUrl."admin/manage-admin.php");
            }
        }

    }
?>

<?php include('partials/footer.php'); ?>