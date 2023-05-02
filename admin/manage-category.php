<?php include('partials/menu.php'); 
    if(isset($_GET['id']) && isset($_GET['imageName']))
    {
        deleteCategory($_GET['id'],$_GET['imageName']);
    }
    // $delete = deleteCategory();
    function deleteCategory($id,$imageName)
    {
        // echo "Delete";
        // echo $id;
        // echo $imageName;
        if($imageName != "")
        {
            $path = "../images/category".$imageName;
            $remove = unlink($path);
            if($remove == false)
            {
                $_SESSION['remove'] = "<div class='error'>Fail to remove image</div>";
                header('location:'.siteUrl.'admin/manage-category.php');
                die();
            }
        }
        $sql = "delete * from tbl_category where id=$id";
        $res = mysqli_query($con,$sql);
        if($res == true)
        {
            echo "Deleted";
            //$_SESSION['del-cat']="<div class='successs'>Category deleted successfully</div>";
            //header('loaction:'.siteUrl.'admin/manage-category.php');
        }
        else
        {
            //$_SESSION['del-cat']="<div class='error'>Failed to delete Category </div>";
           // header('loaction:'.siteUrl.'admin/manage-category.php');
        }
    }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1><br><br>

        <?php 
            if (isset($_SESSION['add-cat'])) {
                echo $_SESSION['add-cat'];    // displaying session msg
                unset($_SESSION['add-cat']);  //removing session msg
            }

            if (isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];    // displaying session msg
                unset($_SESSION['remove']);  //removing session msg
            }

            // if (isset($_SESSION['del-cat'])) {
            //     echo $_SESSION['del-cat'];    // displaying session msg
            //     unset($_SESSION['del-cat']);  //removing session msg
            // }
        ?>
        <br><br>
        <a href="<?php echo siteUrl; ?>admin/add-category.php" 
        class="btn-primary">Add Category</a><br><br>

        <table class="tbl-full"> 
            <tr>
                <th>Sr.No</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php 
                $sql = "SELECT * FROM tbl_category";
                $res = mysqli_query($con, $sql);
                $count = mysqli_num_rows($res);

                $sn = 1;
                if($count>0)
                {
                    while($row = mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $imageName = $row['imageName'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                        <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        
                        <td>
                            <?php 
                                if($imageName)
                                {
                                    ?>
                                    <img src="<?php echo siteUrl; ?>images/category/<?php echo $imageName; ?>"
                                    height="40px" width="55px">
                                    <?php
                                }
                                else
                                {
                                    echo "No Image";
                                }
                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="#" class="btn-secondary">Update</a>
                            <a href="?id=<?php echo $id ?>& imageName=<?php echo $imageName ?>"
                            class="btn-danger">Delete</a>
                        </td>
                        </tr>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td><div class="error">No category added.</div></td>
                    </tr>
                    <?php
                }
            ?>
            
        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>