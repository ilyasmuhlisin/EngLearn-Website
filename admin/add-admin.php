<?php include('partials/navbar.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Nama Lengkap: </td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" required></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your Username" required></td>
                </tr>
                <tr>
                    <td>Password: </td>
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
        //mendapatkan data dari inputan
        //menjadikan inputan sebuah string
        $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $def_password = md5($_POST['password']);//enkripsi password
        $password = mysqli_real_escape_string($conn, $def_password);
        
        //Query SQL untuk menyimpan ke database
        $sql = "INSERT INTO tbl_admin SET full_name='$full_name',username='$username',password='$password'";
        //menjalankan query      
        $res = mysqli_query($conn,$sql);

        //cek apkah data masuk ke database/tidak
        if($res==TRUE){
            //session digunakan untuk menyimpan data selama menjalankan browser
            //variable session untuk menampilkan pesan apabila data berhasil ditambahkan
            $_SESSION['add'] = "<div class='success'>Successfully added</div>";
            //menuju ke halaman manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }else{
            //variable session untuk menampilkan pesan apabila gagal ditambahkan
            $_SESSION['add'] = "<div class='error'>Failed added</div>";
            //tetap dihalaman tambah admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }

    } 
?>