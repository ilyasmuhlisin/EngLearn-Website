<?php include('partials/navbar.php'); ?>

<?php 
    //cek id
    if(isset($_GET['id'])){
        //mengambil id
        $id = $_GET['id'];

        //query
        $sql2 = "SELECT * FROM tbl_course WHERE id=$id";
        //menjalankan query
        $res2 = mysqli_query($conn, $sql2);
    //cek apakah berjalan
        //cek apakah database memiliki data / tidak
        $count2 = mysqli_num_rows($res2);
        if($count2==1){
            //mengambil data
            $row = mysqli_fetch_assoc($res2);
            $title = $row['title'];
            $description_title = $row['description_title'];
            $description_course = $row['description_course'];
            $assignmentt = $row['assignment'];
            $url = $row['url'];
            $current_image = $row['image_name'];
            $current_category = $row['category_id'];
            $active = $row['active'];
        }else{
            $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
            header("location:".SITEURL.'admin/manage-course.php');
        }
    }else{
        //menuju halaman kategori jika id tidak ada
        header('location:'.SITEURL.'admin/manage-course.php');
    }
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Course</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Description Title: </td>
                    <td><textarea name="des_title" rows="5" cols="50"><?php echo $description_title; ?></textarea></td>
                </tr>
                <tr>
                    <td>Description Course: </td>
                    <td><textarea name="des_course" rows="5" cols="50"><?php echo $description_course; ?></textarea></td>
                </tr>
                <tr>
                    <td>Assignment: </td>
                    <td><textarea name="assignment" rows="4" cols="40"><?php echo $assignmentt; ?></textarea></td>
                </tr>
                <tr>
                    <td>Url: </td>
                    <td><textarea name="url"><?php echo $url; ?></textarea></td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                 ?>
                                <img src="<?php echo SITEURL; ?>images/course/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                               echo "<div class='error'>Image not Available.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select New Image: </td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                ///menampilkan option dari tabel kategori
                                //membuat SQL untuk mengambil kategori yang aktif 
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                //jalankan Query
                                $res = mysqli_query($conn, $sql);
                                //menghitung data untuk cek apakah kategori ada
                                $count = mysqli_num_rows($res);
                                //kondisional jika kategori lebih dari 0
                                if($count>0){
                                    //perulangan apbila ada kategori di database
                                    while($row=mysqli_fetch_assoc($res)){
                                        //mengambil data
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                        
                                        // <!-- mengambil kategori sebelumnya -->
                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                }else{
                                    echo "<option value='0'>Category Not Available.</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td><!-- <td>memberikan value sebelumnya -->
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes 
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No 
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Submit" class="btn-secondary">
                    </td>
                </tr>
            
            </table>
        
        </form>

        <?php 
        
            if(isset($_POST['submit'])){
               //cek apakah button submit diclick
                $id = $_POST['id'];
                //menjadikan inputan string
                $title = mysqli_real_escape_string($conn,$_POST['title']);
                $des_title = mysqli_real_escape_string($conn,$_POST['des_title']);
                $des_course = mysqli_real_escape_string($conn,$_POST['des_course']);
                $assignment = mysqli_real_escape_string($conn,$_POST['assignment']);
                $url = mysqli_real_escape_string($conn,$_POST['url']);
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $active = $_POST['active'];
                //update gambar jiki dipilih
                //cek apakah gamabr dpilih
                if(isset($_FILES['image']['name'])){
                    //mendapatkan nama gambar
                    $image_name = $_FILES['image']['name'];
                    //cek apakah gambar dipilih
                    if($image_name!=""){
                        //upload gambar baru
                        //memisahakan ekstensinya(delmiter,string)
                        //untuk mengambil index terakhir sudah pasti ekstensinya
                        $ext = end(explode('.', $image_name)); //contoh(jpg,png, dll)
                        //mengganti nama menggunakan rand() dapat juga menggunakan uniqid()
                        $image_name = "Course-Name-".rand(0000, 9999).'.'.$ext; //contoh course_Category_1111.jpg
                        $tmpName = $_FILES['image']['tmp_name'];
                        $image_destination = "../images/course/".$image_name;
                        //Upload 
                        $upload = move_uploaded_file($tmpName, $image_destination);
                        //cek apakah gambar terupload
                        //jika tidak terupload tetap dihalaman dan menampilkan pesan error
                        if($upload==false){
                            //session digunakan untuk menyimpan data selama menjalankan browser
                            //variable session untuk menampilkan pesan
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                            //menampilkan halaman manage course 
                            header('location:'.SITEURL.'admin/manage-course.php');
                            //menghentikan proses sehingga data tidak masuk database
                            die();
                        }
                        //hapus image sebelumnya jika ada
                        if($current_image!=""){
                            $remove_path = "../images/course/".$current_image;
                            $remove = unlink($remove_path);
                            //cek apakah gambar dihapus atau tidak
                            //jika tidak terhapus tetap dihalaman dan menampilkan pesan error
                            if($remove==false){
                                //session digunakan untuk menyimpan data selama menjalankan browser
                                //variable session untuk menampilkan pesan
                                $_SESSION['remove'] = "<div class='error'>Failed to remove current image.</div>";
                                //menampilkan halaman manage kategori
                                header('location:'.SITEURL.'admin/manage-course.php');
                                //menghentikan proses sehingga data tidak masuk database
                                die();
                            }
                        }
                    }else{
                        $image_name = $current_image; //jika tidak ada yang dipilih
                    }
                }else{
                    $image_name = $current_image; //jika tidak ada yang dipilih
                }
                //update database
                //query
                $sql3 = "UPDATE tbl_course SET 
                    title = '$title',
                    description_title = '$des_title',
                    description_course = '$des_course',
                    assignment = '$assignment',
                    url = '$url',
                    image_name = '$image_name',
                    category_id = '$category',
                    active = '$active'
                    WHERE id=$id
                ";
                //jalankan query
                $res3 = mysqli_query($conn, $sql3);
                //cek apkah data masuk ke database/tidak
                if($res3==true){
                    //session digunakan untuk menyimpan data selama menjalankan browser
                    //variable session untuk menampilkan pesan
                    $_SESSION['update'] = "<div class='success'>Update Successful</div>";
                    header('location:'.SITEURL.'admin/manage-course.php');
                }else{
                    //session digunakan untuk menyimpan data selama menjalankan browser
                    //variable session untuk menampilkan pesan
                    $_SESSION['update'] = "<div class='error'>Update failed</div>";
                    header('location:'.SITEURL.'admin/manage-course.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>