<?php include('partials/navbar.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add User</h1>
        <br>
         <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//menampilkan pesan
                unset($_SESSION['add']);//menghapus pesan
            }
        ?>
        <br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name : </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" required></td>
                </tr>
                <tr>
                    <td>Username : </td>
                    <td><input type="text" name="username" placeholder="Your Username" required></td>
                </tr>
                <tr>
                    <td>Password : </td>
                    <td><input type="password" name="password" placeholder="Your Password" required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php 
    //memproses nilai input dan disimpan ke database
    //cek apakah button submit di click/tidak
    if(isset($_POST['submit'])){
        //echo ""

        //mendapatkan data dari inputan
        //menjadikan inputan sebuah string
        $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $def_password = md5($_POST['password']);//enkripsi password
        $password = mysqli_real_escape_string($conn, $def_password);
        
        //Query SQL untuk menyimpan ke database
        $sql = "INSERT INTO tbl_user SET full_name='$full_name',username='$username',password='$password'";
        //menjalankan query      
        $res = mysqli_query($conn,$sql) or die(mysqli_error());//menampilkan pesan salah jika query tidak jalan

        //cek apkah data masuk ke database/tidak
        if($res==TRUE){
            //session digunakan untuk menyimpan data selama menjalankan browser
            //variable session untuk menampilkan pesan jika b erhasil ditambahkan
            $_SESSION['add'] = "<div class='success'>Successfully added</div>";
            //menampilkan halaman manage user
            header("location:".SITEURL.'admin/manage-user.php');
        }else{
            //variable session untuk menampilkan pesan jika gagal ditambahkan
            $_SESSION['failed-add'] = "<div class='error'>Failed added</div>";
            //tetap dihalaman tambah admin
            header("location:".SITEURL.'admin/add-user.php');
        }

    } 
?>