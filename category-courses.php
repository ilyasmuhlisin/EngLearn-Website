<?php include('partials-front/navbar.php');?>
    <?php 
        //cek id
        if(isset($_GET['category_id'])){
            //mengambil id
            $category_id = $_GET['category_id'];
            //query
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
            //menjalankan query
            $res = mysqli_query($conn, $sql);
            
            //mendapatkan data dari database
            $row = mysqli_fetch_assoc($res);
            //mendapatkan judul
            $category_title = $row['title'];
            
        }else{
            //menuju halaman kategori jika id tidak ada
            header('location:'.SITEURL.'admin/index.php');
        }
    ?>
    <!-- course search Section -->
    <section class="course-search text-center">
        <div class="container">
            <div class="margin-top">
            <h2>Courses on <a href="#" class="text-grey">"<?php echo $category_title; ?>"</a></h2>
            </div>
        </div>
    </section>

    <!-- course list -->
    <section class="course-menu">
        <div class="container">
            <h2 class="text-center">Course List</h2>
            <?php 
                //query untuk menampilkan datadari database
                $sql2 = "SELECT * FROM tbl_course WHERE category_id = $category_id";
                //jalankan query
                $res2 = mysqli_query($conn,$sql2);
                //menghitung data apakah kategoria tersedia
                $count2 = mysqli_num_rows($res2);

                if($count2>0){
                    while($row=mysqli_fetch_assoc($res2)){
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
                                            echo "<div class='error'>Image not found</div>";
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
                    echo "<div class='error'>Category not found</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>

<?php include('partials-front/footer.php');?>