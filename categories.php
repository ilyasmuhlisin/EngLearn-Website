
<?php include('partials-front/navbar.php');?>

    <!-- Categories Section-->
    <section class="categories">
        <div class="container">
            <div class="margin-top">
                <h2 class="text-center">Explore courses</h2>
                <?php 
                    //query untuk menampilkan kategori dari database
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
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
                                                echo "<div class='error'>Image not Found</div>";
                                            }
                                        ?>
                                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                    </div>
                                </a>
                            <?php
                        }
                    }else{
                        //jika kategori tidak ada akan memberikan pesan
                        echo "<div class='error'>Category not found</div>";
                    }
                ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
<?php include('partials-front/footer.php');?>