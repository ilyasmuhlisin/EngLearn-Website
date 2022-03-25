<?php include('partials-front/navbar.php');?>
    <!-- course search Section -->
    <section class="course-search text-center">
        <div class="container">
            <div class="margin-top">
                <form action="<?php echo SITEURL; ?>course-search.php" method="POST">
                    <input type="search" name="search" placeholder="Search for Course.." required>
                    <input type="submit" name="submit" value="Search" class="btn btn-primary">
                </form>
            </div>
        </div>
    </section>
    <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];//menampilkan pesan
            unset($_SESSION['order']);//menghapus pesan
        }
    ?>
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Course</h2>
            <?php 
                //query untuk menampilkan kategori dari database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' LIMIT 3";
                //jalankan query
                $res = mysqli_query($conn,$sql);
                //menghitung data apakah kategoria tersedia
                $count = mysqli_num_rows($res);

                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        //mengambil id,judul,gambar
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>category-courses.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        //apabila gambar tidak ada tidak ditampilkan
                                        if($image_name!=""){
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                            <?php
                                        }else{
                                            echo "<div class='error'>Gambar Tidak Ada</div>";
                                        }
                                    ?>
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }else{
                    //jika kategori tidak ada akan memberikan pesan
                    echo "<div class='error'>Kategori Tidak Ada</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
     <?php
        if(!isset($_SESSION['user'])){
            ?><hr>
            <!-- Payment -->
            <section>
                <div class="container-payment">
                <div class="cards">
                    <div class="head">
                        <h1>1 Semester</h1>
                    </div>
                    <div class="payment-body">
                        <p>IDR 150,000</p>
                    </div>
                    <div class="foot">
                        <p>
                            Belajar Bahasa inggris dari dasar selama <strong>1 semester</strong> dengan
                            mengakses semua materi
                        </p>
                    </div>
                    <br><br><br><a href="<?php echo SITEURL;?>method.php"  class="btn btn-primary">Buy now</a>
                </div>
                <div class="cards">
                        <div class="head">
                            <h1>2 Semester</h1>
                        </div>
                    <div class="payment-body">
                        <p>IDR 250,000</p>
                    </div>
                    <div class="foot">
                        <p>
                            Belajar Bahasa inggris dari dasar selama <strong>2 semester</strong> dengan
                            mengakses semua materi
                        </p>
                    </div>
                    <br><br><br><a href="<?php echo SITEURL;?>method.php"  class="btn btn-primary">Buy now</a>
                </div>
                <div class="study-img">
                    <img src="images/study.png" alt="">
                </div>
            </div>
            </section><hr><?php
        }else{
                        
        };
        ?>
    
    <!-- course list -->
    <section class="course-menu">
        <div class="container">
            <h2 class="text-center">Course List</h2>
            <?php 
                //query untuk menampilkan datadari database
                $sql2 = "SELECT * FROM tbl_course WHERE active='Yes' LIMIT 6";
                //jalankan query
                $res2 = mysqli_query($conn,$sql2);
                //menghitung data apakah kategoria tersedia
                $count2 = mysqli_num_rows($res2);
                if($count2>0){
                    while($row=mysqli_fetch_assoc($res2)){
                        //mengambil id,judul,gambar
                        $id2 = $row['id'];
                        $title2 = $row['title'];
                        $des_title2 = $row['description_title'];
                        $image_name2 = $row['image_name'];
                        $category_id = $row['category_id'];
                        ?>
                            <div class="course-menu-box">
                                <div class="course-menu-img">
                                    <?php
                                        //apabila gambar tidak ada tidak ditampilkan
                                        if($image_name2!=""){
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/course/<?php echo $image_name2; ?>" class="img-responsive img-curve">
                                            <?php
                                        }else{
                                            echo "<div class='error'>Not available</div>";
                                        }
                                    ?>
                                </div>
                                <div class="course-menu-desc">
                                    <h4><?php echo $title2; ?></h4><br>
                                    <p class="course-detail">
                                        <?php echo $des_title2; ?>
                                    </p>
                                    <br>
                                        <a href="<?php echo SITEURL;?>lesson.php?category_id=<?php echo $category_id; ?>&course_id=<?php echo $id2;?>" class="btn btn-primary">Study Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }else{
                    //jika kategori tidak ada akan memberikan pesan
                    echo "<div class='error'>Not available</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="<?php echo SITEURL;?>courses.php">See All Courses</a>
        </p>
    </section>
<?php include('partials-front/footer.php');?>