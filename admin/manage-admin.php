<?php include('partials/menu.php'); ?>

<!-- Main Section -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1><br><br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];    // displaying session msg
                unset($_SESSION['add']);  //removing session msg
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];    // displaying session msg
                unset($_SESSION['delete']);  //removing session msg
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];    // displaying session msg
                unset($_SESSION['update']);  //removing session msg
            }

            if(isset($_SESSION['pass-found']))
            {
                echo $_SESSION['pass-found'];    // displaying session msg
                unset($_SESSION['pass-found']);  //removing session msg
            }
        ?>
        <br><br>
        <!-- button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a><br><br>

        <table class="tbl-full">
            <tr>
                <th>Sr.No</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php 
                $sql = "select * from tbl_admin";
                $res = mysqli_query($con, $sql);

                if($res==true)
                {
                    $count = mysqli_num_rows($res);
                    if($count>0)
                    {
                        $sn = 1;
                        //display data
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $id = $rows['id'];
                            $fullName = $rows['fullName'];
                            $userName = $rows['userName'];
                            
                            //Display data into table
                            ?>

                            <tr>
                                <td> <?php echo $sn++; ?> </td>
                                <td><?php echo $fullName; ?></td>
                                <td><?php echo $userName; ?></td>
                                <td>
                                <a href="<?php echo siteUrl;?>admin/update-password.php?id=<?php echo $id;?>" 
                                class="btn-primary">Change Password</a>
                                
                                <a href="<?php echo siteUrl; ?>admin/update-admin.php?id=<?php echo $id; ?>" 
                                class="btn-secondary">Update Admin</a>
                                
                                <a href="<?php echo siteUrl; ?>admin/delete-admin.php?id=<?php echo $id; ?>" 
                                class="btn-danger">Delete Admin</a>
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    else{
                        //no data 
                    }
                }
            ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>