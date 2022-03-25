<?php include('partials-front/navbar.php');?>
       <?php
         if(isset($_GET['method_id'])){
            //mengambil id
            $method_id = $_GET['method_id'];
            //query
            $sql = "SELECT * FROM tbl_method WHERE id=$method_id";
            //menjalankan query
            $res = mysqli_query($conn, $sql);
            //menghitung data untuk cek apakah kategori ada
            $count = mysqli_num_rows($res);
            //cek apakah data ada
            if($count==1){
                //perulangan apbila ada kategori di database
                $row=mysqli_fetch_assoc($res);
                //mengambil data
                $image_method = $row['image_method'];
                $rek_method = $row['rek_method'];
            }else{
                //menuju halaman yang diinginkan
                header('location:'.SITEURL.'index.php');
            }
            
        }else{
            //menuju halaman yang diinginkan
            header('location:'.SITEURL.'index.php');
        }
    ?>

    <!-- course sEARCH Section Starts Here -->
    <section class="course-menu">
        <div class="container">
                <fieldset>
                    <legend class="pay-label">Proof of payment</legend>
                     <div class="course-menu-img-confirm text-center">
                        <?php
                            //apabila gambar tidak ada tidak ditampilkan
                            if($image_method!=""){
                                ?>
                                    <img src="<?php echo SITEURL;?>images/<?php echo $image_method; ?>" class="text-center img-size">
                                <?php
                            }else{
                                echo "<div class='error'>Image not available</div>";
                            }
                        ?>
                        <h1 class="font-confirm">No Rek <?php echo $rek_method; ?></h1>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="pay-label">Full Name</div>
                        <input type="text" name="fullname" placeholder="ex budi" class="input-responsive" required>
                        <div class="pay-label">Email</div>
                        <input type="email" name="email" placeholder="ex@gmail.com" class="input-responsive" required>
                        <div class="pay-label">Proof</div>
                            <table>
                                <tr>
                                    <td><input type="file" class="btn" name="file_name"></td>
                                    <td><input type="submit" class="btn btn-primary" name="submit" value="submit"></td>
                                </tr>
                            </table>
                    </form>
                </fieldset>

            </form>
        <?php 
            //cek apakah button submit di click/tidak
            if(isset($_POST['submit'])){
                //mendapatkan nilai dari inputan
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                //cek file
                
                // mengethaui output yang dihasilkan
            // print_r($_FILES['image']);
            // hasil:Array ( [name] => Image 2.png [type] => image/png [tmp_name] => C:\xampp\tmp\php4C81.tmp [error] => 0 [size] => 70820 )
            // die();//menghentikan program
            //cek apakah file dipilih
            if(isset($_FILES['file_name']['name'])){
                //upload gambar memerlukan nama,sumber dan tujuan gambar
                 $image_name = $_FILES['file_name']['name'];
                 //hanya upload gambar jika gambar dipilih
                 if($image_name!=""){
                        //auto rename gambar supaya tidak ada penamaan yang sama
                        //memisahakan ekstensinya(delmiter,string)
                        //untuk mengambil index terakhir sudah pasti ekstensinya
                        $ext = end(explode('.', $image_name));//contoh(jpg,png, dll)

                        //mengganti nama menggunakan rand() dapat juga menggunakan uniqid()
                        $image_name = "Proof_".rand(0000,9999).".".$ext; //contoh course_Category_111.jpg

                        $tmpName = $_FILES['file_name']['tmp_name'];
                        $image_destination = "images/proof/".$image_name;

                        //upload gambar
                        $upload = move_uploaded_file($tmpName, $image_destination);

                        //cek apakah gambar terupload
                        //jika tidak terupload tetap dihalaman dan menampilkan pesan error
                        if($upload==false){
                            //variable session untuk menampilkan pesan jika gagal upload
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'confirm.php');
                            //menghentikan proses
                            die();
                        }
                    }
            }else{
                //jangan upload gambar jika nama kosong
                $image_name ="";
            }
            //Query SQL untuk menyimpan ke database
            $sql2 = "INSERT INTO tbl_pay SET name='$fullname', email='$email', proof='$image_name'";
            //menjalankan query      
            $res2 = mysqli_query($conn,$sql2);
            //cek apkah query berjalan
            if($res2==TRUE){
                //variable session untuk menampilkan pesan jika berhasil ditambahkan
                $_SESSION['add'] = "<div class='success'>Upload Successful</div>";
                //menampilkan halaman manage admin
                // header("location:".SITEURL.'index.php');
                 echo "
                    <script>
                            alert('Upload Successful, Check your email to get a login account');
                        </script> 
                    ";
            }else{
                //variable session untuk menampilkan pesan jika gagal ditambahkan
                $_SESSION['add'] = "<div class='error'>Failed to upload</div>";
                //tetap dihalaman tambah admin
                // header("location:".SITEURL.'confirm.php');
                 echo "
                        <script>
                                alert('Failed to upload');
                            </script> ";
            }
            }
        ?>
        </div>
    </section>
    <!-- course sEARCH Section Ends Here -->
<?php include('partials-front/footer.php');?>