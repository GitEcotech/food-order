<?php include('partials/menu.php'); ?>

    <!-- Main Section -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Dashboard</h1><br><br>
            
            <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];    // displaying session msg
                unset($_SESSION['login']);  //removing session msg
            }
            ?>
            <br><br>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>

            <div class="col-4 text-center">
                <h1>5</h1>
                <br>
                Categories
            </div>

            <div class="clearfix"></div>

        </div>
    </div>

<?php include('partials/footer.php'); ?>