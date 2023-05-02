<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add-cat'])) {
            echo $_SESSION['add-cat'];    // displaying session msg
            unset($_SESSION['add-cat']);  //removing session msg
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];    // displaying session msg
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
        <table width="30%">
            <tr>
                <td>Title:-</td>
                <td><input type="text" name="title" placeholder="Category title"></td>
            </tr>
            <tr>
                <td>Select Image:-</td>
                <td>
                    <input type="file" name="image" id="">
                </td>
            </tr>
            <tr>
                <td>Featured:-</td>
                <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:-</td>
                <td>
                    <input type="radio" name="active" value="Yes">Yes
                    <input type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                </td>
                </tr>
        </table>
        </form>

        <?php 
            if(isset($_POST['submit']))
            {
                $title = $_POST['title'];

                if(isset($_POST['featured']))       // featured ratio button
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No";
                }

                if(isset($_POST['active']))       // active ratio button
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                // print_r($_FILES['image']);       to print image data.
                // die();

                if(isset($_FILES['image']['name']))
                {
                    // upload image
                    $imageName = $_FILES['image']['name'];

                    $ext = end(explode('.',$imageName));         //get extension from image name
                    $imageName = "Food_Category_".rand(000,999).'.'.$ext;   //rename the image

                    $sourcePath = $_FILES['image']['tmp_name'];
                    $destinationPath = "../images/category/".$imageName;

                    $upload = move_uploaded_file($sourcePath, $destinationPath);
                    if($upload == false)
                    {
                        $_SESSION['upload'] = "<div class='error'>Fail to upload image</div>";
                        header('location:'.siteUrl.'admin/add-category.php');
                        die();              //stop process if image not uploaded
                    }
                }
                else
                {
                    $imageName = "";
                }

                //Ssql Query
                $sql = "insert into tbl_category (title,imageName,featured,active) 
                values('$title','$imageName','$featured','$active')";

                $res = mysqli_query($con, $sql);       //Execute query
                if ($res == true) {
                    //echo "Insertion Successfull";
                    // create session variable to display message
                    $_SESSION['add-cat'] = "<div class='success'>Category Added Successfully</div>";
                    // redirect page
                    header("location:" . siteUrl . 'admin/manage-category.php');
                } else {
                    // echo "Insertion not done";
                    // create session variable to display message
                    $_SESSION['add-cat'] = "<div class='error'>Fail to Added Category</div>";
                    // redirect page
                    header("location:" . siteUrl . 'admin/add-category.php');
                }
            }
        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>