<?php include('partials/navbar.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br>
         <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//menampilkan pesan
                unset($_SESSION['add']);//menghapus pesan
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];//menampilkan pesan
                unset($_SESSION['upload']);//menghapus pesan
            }
        ?>
        <br>
        <!-- enctype digunakan supaya dapat upload file gambar -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title : </td>
                    <td><input type="text" name="title" placeholder="Category title" required></td>
                </tr>
                <tr>
                    <td>Select image :</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Active : </td>
                     <td>
                        <input type="radio" name="active" value="Yes" required>Yes
                        <input type="radio" name="active" value="No" required>No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
        //cek apakah button submit di click/tidak
        if(isset($_POST['submit'])){
            //mendapatkan nilai dari inputan
            //menjadikan inputan string
            $title = mysqli_real_escape_string($conn,$_POST['title']);
            //cek apakah inputan raduio dipilih
            if(isset($_POST['active'])){
                //mengambil nilai dari input
                 $active = $_POST['active'];
            }else{
                //mengatur nilai awal
                $active = "No";
            }
            // mengethaui output yang dihasilkan
            // print_r($_FILES['image']);
            // hasil:Array ( [name] => Image 2.png [type] => image/png [tmp_name] => C:\xampp\tmp\php4C81.tmp [error] => 0 [size] => 70820 )
            // die();//menghentikan program
            //cek apakah file dipilih
            if(isset($_FILES['image']['name'])){
                //upload gambar memerlukan nama,sumber dan tujuan gambar
                 $image_name = $_FILES['image']['name'];
                 //hanya upload gambar jika gambar dipilih
                 if($image_name!=""){
                    //auto rename gambar supaya tidak ada penamaan yang sama
                    //memisahakan ekstensinya(delmiter,string)
                    //untuk mengambil index terakhir sudah pasti ekstensinya
                    $ext = end(explode('.', $image_name));//contoh(jpg,png, dll)
                    //mengganti nama menggunakan nama yang ditentukan dan dengan fungsi rand()/uniqid()
                    $image_name = "Course_Category_".rand(0000,9999).".".$ext;//contoh Course_Category_1121.jpg
                    $tmpName = $_FILES['image']['tmp_name'];
                    $image_destination = "../images/category/".$image_name;
                    //upload gambar ke direktori yang diinginkan
                    $upload = move_uploaded_file($tmpName, $image_destination);
                    //cek apakah gambar terupload
                    //jika tidak terupload tetap dihalaman dan menampilkan pesan error
                    if($upload==false){
                        //variable session untuk menampilkan pesan jika gagal upload image
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        //tetap di halaman tambah kategori
                        header("location:".SITEURL.'admin/add-category.php');
                        //menghentikan proses sehingga data tidak masuk database
                        die();
                    }
                }
            }else{
                //jangan upload gambar jika nama kosong
                $image_name ="";
            }
            //Query SQL untuk menyimpan ke database
            $sql = "INSERT INTO tbl_category SET title='$title',image_name='$image_name',active='$active'";
            //menjalankan query      
            $res = mysqli_query($conn,$sql);
            //cek apkah query berjalan
            if($res==TRUE){
                //variable session untuk menampilkan pesan jika berhasil ditambahkan
                $_SESSION['add'] = "<div class='success'>Successfully added</div>";
                //menampilkan halaman manage admin
                header("location:".SITEURL.'admin/manage-category.php');
            }else{
                //variable session untuk menampilkan pesan jika gagal ditambahkan
                $_SESSION['add'] = "<div class='error'>Failed added</div>";
                //tetap dihalaman tambah admin
                header("location:".SITEURL.'admin/add-category.php');
            }
        } 
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>

