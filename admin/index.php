<?php include('partials/navbar.php'); ?>
        <!-- main content section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <br>
                <?php 
                if(isset($_SESSION['login'])){
                    echo ($_SESSION['login']);
                    unset ($_SESSION['login']);
                }
                ?><br>
                <div class="col-4 text-center">
                <?php
                    //query
                    $sql = "SELECT * FROM tbl_category";
                    //jalankan
                    $res = mysqli_query($conn, $sql);
                    //menghitung data
                    $count = mysqli_num_rows($res);
                ?>
                    <h1><?php echo $count;?></h1>
                    <br>
                    categories
                </div>
                <div class="col-4 text-center">
                <?php
                    //query
                    $sql2 = "SELECT * FROM tbl_course";
                    //jalankan
                    $res2 = mysqli_query($conn, $sql2);
                    //menghitung data
                    $count2 = mysqli_num_rows($res2);
                ?>
                    <h1><?php echo $count2;?></h1>
                    <br>
                    Course
                </div>
                 <div class="col-4 text-center">
                <?php
                    //query
                    $sql3 = "SELECT * FROM tbl_documents";
                    //jalankan
                    $res3 = mysqli_query($conn, $sql3);
                    //menghitung data
                    $count3 = mysqli_num_rows($res3);
                ?>
                    <h1><?php echo $count3;?></h1>
                    <br>
                    Documents
                </div>              
                <div class="clearFix"></div>
            </div>
        </div>
<?php include('partials/footer.php'); ?>        