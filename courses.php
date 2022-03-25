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

    <!-- course list-->
    <section class="course-menu ">
        <div class="container">
            <h2 class="text-center">Courses List</h2>
            <?php 
                //query untuk menampilkan datadari database
                $sql = "SELECT * FROM tbl_course WHERE active='Yes'";
                //jalankan query
                $res = mysqli_query($conn,$sql);
                //menghitung data apakah kategoria tersedia
                $count = mysqli_num_rows($res);

                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        //mengambil id,judul,gambar
                        $id = $row['id'];
                        $title = $row['title'];
                        $des_title2 = $row['description_title'];
                        $image_name = $row['image_name'];
                        $category_id = $row['category_id'];
                        ?>
                            <div class="course-menu-box">
                                <div class="course-menu-img">
                                    <?php
                                        //apabila gambar tidak ada tidak ditampilkan
                                        if($image_name!=""){
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/course/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                            <?php
                                        }else{
                                            echo "<div class='error'>Image not available</div>";
                                        }
                                    ?>
                                </div>
                                <div class="course-menu-desc">
                                    <h4><?php echo $title; ?></h4><br>
                                    <p class="course-detail">
                                        <?php echo $des_title2; ?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL;?>lesson.php?category_id=<?php echo $category_id;?>&course_id=<?php echo $id;?>" class="btn btn-primary">Study Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }else{
                    //jika kategori tidak ada akan memberikan pesan
                    echo "<div class='error'>Not Available</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
<?php include('partials-front/footer.php');?>