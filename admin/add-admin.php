<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1> <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];    // displaying session msg
            unset($_SESSION['add']);  //removing session msg
        }
        ?>
        <br><br>

        <form action="" method="post">
            <table width="30%">
                <tr>
                    <td>Full Name:-</td>
                    <td><input type="text" name="fullName" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username:-</td>
                    <td><input type="text" name="userName" placeholder="Your username"></td>
                </tr>
                <tr>
                    <td>Password:-</td>
                    <td><input type="password" name="password" placeholder="Your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
//process the value from form in database
if (isset($_POST['submit'])) {
    // get data from form
    $fullName = $_POST['fullName'];
    $userName = $_POST['userName'];
    $password = md5($_POST['password']);

    // sql query
    $sql = "insert into tbl_admin set
                fullName = '$fullName',
                userName = '$userName',
                password = '$password' ";

    // execute query
    $res = mysqli_query($con, $sql);

    if ($res == true) {
        //echo "Insertion Successfull";
        // create session variable to display message
        $_SESSION['add'] = "Admin Added Successfully";
        // redirect page
        header("location:" . siteUrl . 'admin/manage-admin.php');
    } else {
        // echo "Insertion not done";
        // create session variable to display message
        $_SESSION['add'] = "Fail to Added Data";
        // redirect page
        header("location:" . siteUrl . 'admin/add-admin.php');
    }
}
?>