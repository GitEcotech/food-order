<?php include('config/constants.php'); 
    if(!isset($_SESSION['user']))
    {
        $_SESSION['not-logedin'] = "<div class='error'>Please login to access.</div>";
        header("location:".siteUrl."admin/login.php");
    }

?>


<html lang="en">
<head>
    <title>Food order website - Home page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

 <!-- Menu section -->
 <div class="menu">
        <div class="wrapper">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-food.php">Food</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>           
        </div>

    </div>

</body>
</html>