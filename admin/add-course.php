<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Course</h1>
        <br>
        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?><br>
        <!-- enctype digunakan supaya dapat upload file gambar -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-50">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" placeholder="Title of the Course"></td>
                </tr>
                <tr>
                    <td>Description Title: </td>
                    <td><textarea  name="des_title" rows="5" cols="50" placeholder="Description of the Title"></textarea></td>
                </tr>
                <tr>
                    <td>Description Course: </td>
                    <td><textarea name="des_course" rows="5" cols="50" placeholder="Description of the Course"></textarea></td>
                </tr>
                <tr>
                    <td>Assignment: </td>
                    <td><textarea name="assignment"  rows="4" cols="40" placeholder="Assignment"></textarea></td>
                </tr>
                <tr>
                    <td>Url: </td>
                    <td><textarea name="url" placeholder="Url"></textarea></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
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
                                
                                //jalankan query
                                $res = mysqli_query($conn, $sql);

                                //menghitung data untuk cek apakah kategori ada
                                $count = mysqli_num_rows($res);

                                //kondisional jika kategori lebih dari 0
                                if($count>0){
                                    //perulangan apbila ada kategori di database
                                    while($row=mysqli_fetch_assoc($res)){
                                        //mengambil data
                                        $category_id = $row['id'];
                                        $category_title = $row['title'];
                                        ?>
                                        <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                }
                                else{
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="submit" class="btn-secondary">
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
                $des_title = mysqli_real_escape_string($conn,$_POST['des_title']);
                $des_course = mysqli_real_escape_string($conn,$_POST['des_course']);
                $assignment = mysqli_real_escape_string($conn,$_POST['assignment']);
                $url = mysqli_real_escape_string($conn,$_POST['url']);
                $category = $_POST['category'];

                //cek apakah inputan radio dipilih
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
                    //upload gambar
                    //upload gambar memerlukan nama,sumber dan tujuan gambar
                    $image_name = $_FILES['image']['name'];

                    //hanya upload gambar jika gambar dipilih
                    if($image_name!=""){
                        //auto rename gambar supaya tidak ada penamaan yang sama
                        //memisahakan ekstensinya(delmiter,string)
                        //untuk mengambil index terakhir sudah pasti ekstensinya
                        $ext = end(explode('.', $image_name));//contoh(jpg,png, dll)

                        //mengganti nama menggunakan rand() dapat juga menggunakan uniqid()
                        $image_name = "Course_Name_".rand(0000,9999).".".$ext; //contoh course_Category_111.jpg

                        $tmpName = $_FILES['image']['tmp_name'];
                        $image_destination = "../images/course/".$image_name;

                        //upload gambar
                        $upload = move_uploaded_file($tmpName, $image_destination);

                        //cek apakah gambar terupload
                        //jika tidak terupload tetap dihalaman dan menampilkan pesan error
                        if($upload==false){
                            //variable session untuk menampilkan pesan jika gagal upload
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-course.php');
                            //menghentikan proses
                            die();
                        }
                    }

                }else{
                    //jangan upload gambar jika nama kosong
                    $image_name = "";
                }
                //Query SQL untuk menyimpan ke database
                $sql2 = "INSERT INTO tbl_course SET 
                    title = '$title',
                    description_title = '$des_title',
                    description_course = '$des_course',
                    assignment = '$assignment',
                    url = '$url',
                    image_name = '$image_name',
                    category_id = $category,
                    active = '$active'
                ";
                //menjalankan query
                $res2 = mysqli_query($conn, $sql2);

                //cek apkah query berjalan
                if($res2 == true){
                    //session digunakan untuk menyimpan data selama menjalankan browser
                    //variable session untuk menampilkan pesan jika berhasil ditambahkan
                    $_SESSION['add'] = "<div class='success'>Successfully added</div>";
                    header('location:'.SITEURL.'admin/manage-course.php');
                }else{
                    //variable session untuk menampilkan pesan jika gagal ditambahkan
                    $_SESSION['add'] = "<div class='error'>Failed added</div>";
                    header('location:'.SITEURL.'admin/manage-course.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
