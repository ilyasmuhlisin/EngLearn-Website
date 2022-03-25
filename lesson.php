<?php include('partials-front/navbar.php');?>
<?php include('partials-front/login-check.php');?>
    <?php 
        //cek id
        if(isset($_GET['category_id']) && isset($_GET['course_id'])){
            //mengambil id
            $category_id = $_GET['category_id'];
            $course_id = $_GET['course_id'];
            //query
            $sql = "SELECT * FROM tbl_course WHERE id=$course_id";
            //menjalankan query
            $res = mysqli_query($conn, $sql);
            
            //mendapatkan data dari database
            $row = mysqli_fetch_assoc($res);
            //mendapatkan judul
            $course_url = $row['url'];
            $course_title = $row['title'];
            $des_course = $row['description_course'];
            $assignment = $row['assignment'];

            $sql4 = "SELECT * FROM tbl_category WHERE id=$category_id";
            //menjalankan query
            $res4 = mysqli_query($conn, $sql4);
            
            //mendapatkan data dari database
            $row4 = mysqli_fetch_assoc($res4);
            //mendapatkan judul
            // $category_title = $row4['title'];
            
        }else{
            //menuju halaman kategori jika id tidak ada
            header('location:'.SITEURL.'index.php');
        }
        function youtube($url){
            $link=str_replace('http://www.youtube.com/watch?v=', '', $url);
            $link=str_replace('https://www.youtube.com/watch?v=', '', $link);
            $data='<object width="90%" height="900" data="http://www.youtube.com/v/'.$link.'" type="application/x-shockwave-flash">
            <param name="src" value="http://www.youtube.com/v/'.$link.'" />
            </object>';
            return $data;
        } 
    ?>
    <!-- course search-->
    <section class="course-search text-center">
        <div class="container">
            <div class="margin-top">
            <form action="<?php echo SITEURL; ?>course-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for course.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
            </div>
        </div>
    </section>

    <!-- course lesson -->
    <section class="course-menu">
        <h2 class="text-center"><?php echo $course_title; ?></h2>
        <div class="container">
            <div class="text-center">
                <?php
                    echo youtube("$course_url");
                ?>
            </div>
            <br><br><br>
            <div class="text-left">
                <h2>Description</h2><hr><br>
                <p><?php echo $des_course; ?></p>
                <br><br>
                <h2>Assignment</h2><hr><br>
                <p><?php echo $assignment; ?></p>
                <br><br>
                <h2>Submit Assignments(pdf/docx)</h2><hr><br>
            </div><br>
            <div class="text-center">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td><h1>Select File:</h1></td>
                                <td><input type="file" class="btn" name="file_name"></td>
                                <td><input type="submit" class="btn btn-primary" name="submit" value="submit"></td>
                            </tr>
                        </table>
                    </form>
        <?php 
            //cek apakah button submit di click/tidak
            if(isset($_POST['submit'])){
                //mendapatkan nilai dari inputan
                $username = $_SESSION['user'];
                $category_title = $row4['title'];
                //cek file
                if(isset($_FILES['file_name']['name'])){
                    //upload gambar
                    //upload gambar memerlukan nama,sumber dan tujuan gambar
                    $file_name = $_FILES['file_name']['name'];
                    //hanya upload gambar jika gambar dipilih
                    if($file_name!=""){
                        //auto rename gambar supaya tidak ada penamaan yang sama
                        //memisahakan ekstensinya(delmiter,string)
                        //untuk mengambil index terakhir sudah pasti ekstensinya
                        //mengubah karakter menjadi kecil semua
                        $extValid = ['pdf','docx'];
                        $ext = explode('.',$file_name);
                        $ext = end($ext);
                        if(!in_array($ext,$extValid)){
                            echo "<script>
                                    alert('Wrong file format');
                                </script>";
                            die();
                        }
                        //mengganti nama menggunakan rand() dapat juga menggunakan uniqid()
                        $file_name = date("y-m-d_his_").rand(0000,9999).".".$ext; //contoh course_Category_111.jpg
                        $tmpName = $_FILES['file_name']['tmp_name'];
                        $file_destination = "images/documents/".$file_name;
                        //upload gambar
                        $upload = move_uploaded_file($tmpName, $file_destination);
                        //cek apakah gambar terupload
                        //jika tidak terupload tetap dihalaman dan menampilkan pesan error
                        if($upload==false){
                            //session digunakan untuk menyimpan data selama menjalankan browser
                            //variable session untuk menampilkan pesan
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'lesson.php');
                            //menghentikan proses
                            die();
                        }
                    }
                }else{
                    //jangan upload gambar jika nama kosong
                    $file_name = "";
                }
                //Query SQL untuk menyimpan ke database
                $sql3 = "INSERT INTO tbl_documents SET 
                    title = '$course_title',
                    username = '$username',
                    answer = '$file_name',
                    category_file = '$category_title'
                ";
                //menjalankan query
                $res3 = mysqli_query($conn, $sql3);
                //cek apkah query berjalan
                if($res3==TRUE){
                    //session digunakan untuk menyimpan data selama menjalankan browser
                    //variable session untuk menampilkan pesan
                    $_SESSION['upload-file'] = "<div class='success'>Data Berhasil diupdate</div>";
                    //menampilkan halaman manage admin
                    // header("location:".SITEURL.'lesson.php');
                    echo "<script>
                            alert('File Berhasil di upload');
                        </script>";
                }else{
                    //session digunakan untuk menyimpan data selama menjalankan browser
                    //variable session untuk menampilkan pesan
                    $_SESSION['upload-file'] = "<div class='error'>Data gagal diupdate</div>";
                    //menuju halaman yang diinginkan
                    echo "<script>
                            alert('File gagal di upload');
                        </script>";
                }
            }
        ?>
                </div>
            </div>
            <div class="clearfix"></div>
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
                        $id2 = $row['id'];
                        $title2 = $row['title'];
                        $des_title2 = $row['description_title'];
                        $image_name2 = $row['image_name'];
                        $category_id2 = $row['category_id']
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
                                            echo "<div class='error'>Gambar Tidak Ada</div>";
                                        }
                                    ?>
                                </div>
                                <div class="course-menu-desc">
                                    <h4><?php echo $title2; ?></h4><br>
                                    <p class="course-detail">
                                        <?php echo $des_title2; ?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL;?>lesson.php?category_id=<?php echo $category_id2;?>&course_id=<?php echo $id2;?>" class="btn btn-primary">Study Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }else{
                    //jika kategori tidak ada akan memberikan pesan
                    echo "<div class='error'>Menu Tidak Ada</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
<?php include('partials-front/footer.php');?>