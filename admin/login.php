<?php include('config/constants.php'); ?>
<html>
    <head>
        <title>Login - Food Order</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br><br>

            <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];    // displaying session msg
                unset($_SESSION['login']);  //removing session msg
            }

            if(isset($_SESSION['not-logedin']))
            {
                echo $_SESSION['not-logedin'];    // displaying session msg
                unset($_SESSION['not-logedin']);  //removing session msg
            }
            ?>
            <br><br>
            <!-- Login Form -->
            <form action="" method="post">
                Username:- <input type="text" name="userName" placeholder="Enter Username"><br><br>
                Password:- <input type="password" name="password" placeholder="Enter Password"><br><br> 
                
                <input type="submit" value="Login" name="submit" class="btn-primary">
            </form>

        </div>
    </body>
</html>

<?php 
    if(isset($_POST['submit']))
    {
        $userName = $_POST['userName'];
        $password = md5($_POST['password']);

        // sql query to check user exists
        $sql = "select * from tbl_admin where userName='$userName' and password='$password'";
        $res = mysqli_query($con, $sql);

        $count = mysqli_num_rows($res);
        if($count == 1)
        {
            // user available
            $_SESSION['login'] = "<div class='success'>Login Successfull</div>";
            $_SESSION['user'] = $userName;

            header("location:".siteUrl."admin/");
        }
        else
        {
            // user not available 
            $_SESSION['login'] = "<div class='error'>Username or password does not match</div>";
            header("location:".siteUrl."admin/login.php");
        }

    }
?>