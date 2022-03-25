<?php include('partials/navbar.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Method</h1>
        <br>
         <?php 
            //cek id
            if(isset($_GET['id'])){
                //mengambil id
                $id = $_GET['id'];
                //query
                $sql = "SELECT * FROM tbl_method WHERE id=$id";
                //menjalankan query
                $res = mysqli_query($conn,$sql);
                //cek apakah berjalan
                //cek apakah database memiliki data / tidak
                $count = mysqli_num_rows($res);
                if($count==1){
                    //mengambil data
                    $row = mysqli_fetch_assoc($res);
                    $bank_name= $row['name'];
                    $current_image = $row['image_method'];
                    $acc = $row['rek_method'];
                }else{
                    $_SESSION['no-category-found'] = "<div class='error'>Not available</div>";
                    header("location:".SITEURL.'admin/manage-method.php');
                }
            }else{
                //menuju halaman kategori jika id tidak ada
                header("location:".SITEURL.'admin/manage-method.php');
            }
            
        ?>
        <br><br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Name: </td>
                    <td><input type="text" name="bank_name" value="<?php echo $bank_name;?>" required></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image != ""){
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/<?php echo $current_image;?>" width="100px">
                                <?php
                            }else{
                                echo "<div class='error'>Image not available</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                 <tr>
                    <td>Method Account: </td>
                    <td><input type="text" name="account" value="<?php echo $acc;?>" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            //cek apakah button submit diclick
            if(isset($_POST['submit'])){
                //mendapatkan nilai dari input
                $id = $_POST['id'];
                //menjadikan inputan string
                $bank_name = mysqli_real_escape_string($conn,$_POST['bank_name']);
                $current_image = $_POST['current_image'];
                $acc2 = $_POST['account'];
                //update gambar jiki dipilih
                //cek apakah gamabr dpilih
                if(isset($_FILES['image']['name'])){
                    //mendapatkan nama gambar
                    $image_name = $_FILES['image']['name'];
                    //cek apakah gambar ada
                    if($image_name!=""){
                        //upload gambar baru
                        //memisahakan ekstensinya(delmiter,string)
                        //untuk mengambil index terakhir sudah pasti ekstensinya
                        $ext = end(explode('.', $image_name));//contoh(jpg,png, dll)
                        //mengganti nama menggunakan rand() dapat juga menggunakan uniqid()
                        $image_name = "Bank_".rand(0000,9999).".".$ext;//contoh course_Category_111.jpg
                        $tmpName = $_FILES['image']['tmp_name'];
                        $image_destination = "../images/".$image_name;
                        //upload gambar
                        $upload = move_uploaded_file($tmpName, $image_destination);
                        //cek apakah gambar terupload
                        //jika tidak terupload tetap dihalaman dan menampilkan pesan error
                        if($upload==false){
                            //session digunakan untuk menyimpan data selama menjalankan browser
                            //variable session untuk menampilkan pesan jika upload gagal
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                            //menampilkan halaman manage admin
                            header("location:".SITEURL.'admin/manage-method.php');
                            //menghentikan proses sehingga data tidak masuk database
                            die();
                        }
                        //hapus image sebelumnya jika ada
                        if($current_image!=""){
                            $remove_path = "../images/".$current_image;
                            $remove = unlink($remove_path);
                            //cek apakah gambar dihapus atau tidak
                            //jika tidak terhapus tetap dihalaman dan menampilkan pesan error
                            if($remove==false){
                                //session digunakan untuk menyimpan data selama menjalankan browser
                                //variable session untuk menampilkan pesan
                                $_SESSION['remove'] = "<div class='error'>Failed to remove current image.</div>";
                                //menampilkan halaman manage kategori
                                header('location:'.SITEURL.'admin/manage-method.php');
                                //menghentikan proses sehingga data tidak masuk database
                                die();
                            }
                        }
                    }else{
                        //jika tidak ada yang dipilih
                        $image_name = $current_image;
                    }
                }else{
                    //jika tidak dipilih
                    $image_name = $current_image;
                }
                //update database
                //query
                $sql2 = "UPDATE tbl_method SET name = '$bank_name', image_method = '$image_name', rek_method = '$acc2' WHERE id=$id";
                //menjalankan query
                $res2 = mysqli_query($conn,$sql2);
                
                //cek apkah data masuk ke database/tidak
                if($res2==TRUE){
                    //session digunakan untuk menyimpan data selama menjalankan browser
                    //variable session untuk menampilkan pesan
                    $_SESSION['update'] = "<div class='success'>Update successful</div>";
                    //menampilkan halaman manage kategori
                    header("location:".SITEURL.'admin/manage-method.php');
                }else{
                    //session digunakan untuk menyimpan data selama menjalankan browser
                    //variable session untuk menampilkan pesan
                    $_SESSION['update'] = "<div class='error'>Update failed</div>";
                    //menuju halaman yang diinginkan
                    header("location:".SITEURL.'admin/manage-method.php');
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php') ?>
