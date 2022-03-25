<?php include('partials-front/navbar.php');?>

    <!-- course list-->
    <section class="course-menu ">
        <div class="container">
            <div class="margin-top">
                <h2 class="text-center">Payment Method</h2>
                <?php 
                    //query untuk menampilkan datadari database
                    $sql = "SELECT * FROM tbl_method";
                    //jalankan query
                    $res = mysqli_query($conn,$sql);
                    //menghitung data apakah kategoria tersedia
                    $count = mysqli_num_rows($res);

                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            //mengambil id,judul,gambar
                            $id = $row['id'];
                            $name = $row['name'];
                            $image_method = $row['image_method'];
                            $rek_method = $row['rek_method'];
                            ?>
                                <div class="course-menu-box">
                                    <div class="course-menu-img">
                                        <?php
                                            //apabila gambar tidak ada tidak ditampilkan
                                            if($image_method!=""){
                                                ?>
                                                    <a href="<?php echo SITEURL;?>confirm.php?method_id=<?php echo $id;?>"><img src="<?php echo SITEURL;?>images/<?php echo $image_method; ?>" class="img-responsive img-curve img-size"></a>
                                                <?php
                                            }else{
                                                echo "<div class='error'>Gambar Tidak Ada</div>";
                                            }
                                        ?>
                                    </div>
                                    <div class="course-menu-desc-method">
                                        <h4><?php echo $name; ?></h4><br>
                                        <p class="course-detail">
                                            <?php echo $rek_method; ?>
                                        </p>
                                    </div>
                                </div>
                            <?php
                        }
                    }else{
                        //jika kategori tidak ada akan memberikan pesan
                        echo "<div class='error'>Method not available</div>";
                    }
                ?>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
<?php include('partials-front/footer.php');?>