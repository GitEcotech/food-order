<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1> <br><br>

        <?php
        $id = $_GET['id'];
        $sql = "select * from tbl_admin where id=$id";
        $res = mysqli_query($con, $sql);

        if ($res == true) {
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $fullName = $row['fullName'];
                $userName = $row['userName'];
            } else {
                header("location:" . siteUrl . "admin/manage-admin.php");
            }
        }
        ?>

        <form action="" method="post">
            <table width="30%">
                <tr>
                    <td>Full Name:-</td>
                    <td><input type="text" name="fullName" value="<?php echo $fullName; ?>"></td>
                </tr>
                <tr>
                    <td>Username:-</td>
                    <td><input type="text" name="userName" value="<?php echo $userName; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $userName = $_POST['userName'];

    $sql = "update tbl_admin set 
    fullName = '$fullName',
    userName = '$userName' 
    where id = $id
    ";
    $res = mysqli_query($con, $sql);
    if ($res == true) {
        $_SESSION['update'] = "<div class='success'>Admin data updated</div>";
        header("location:" . siteUrl . "admin/manage-admin.php");
    } else {
        $_SESSION['update'] = "<div class='error'>Fail to updated Admin data</div>";
        header("location:" . siteUrl . "admin/manage-admin.php");
    }
}
?>

<?php include('partials/footer.php'); ?>