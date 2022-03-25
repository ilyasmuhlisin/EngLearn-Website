<?php include('partials/navbar.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <?php 
         if(isset($_GET['id'])){
            //mengambil id
            $id = $_GET['id'];
         } 
        ?>
        <?php
            if(isset($_SESSION['pwd-not-match'])){
                echo $_SESSION['pwd-not-match'];//menampilkan pesan
                unset($_SESSION['pwd-not-match']);//menghapus pesan
                }
            if(isset($_SESSION['change-pwd-failed'])){
                echo $_SESSION['change-pwd-failed'];//menampilkan pesan
                unset($_SESSION['change-pwd-failed']);//menghapus pesan
                }
            if(isset($_SESSION['user-not-found'])){
                echo $_SESSION['user-not-found'];//menampilkan pesan
                unset($_SESSION['user-not-found']);//menghapus pesan
            }
        ?>
        <br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password : </td>
                    <td><input type="password" name="current_password" placeholder="Current password" required></td>
                </tr>
                <tr>
                    <td>New Password : </td>
                    <td><input type="password" name="new_password" placeholder="New password"  required></td>
                </tr>
                 <tr>
                    <td>Confirm Password : </td>
                    <td><input type="password" name="confirm_password" placeholder="Rewrite password"  required></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    //cek apakah button submit diclick
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        //menjadikan inputan string
        $current_password= mysqli_real_escape_string($conn,md5($_POST['current_password']));
        $new_password = mysqli_real_escape_string($conn,md5($_POST['new_password']));
        $confirm_password = mysqli_real_escape_string($conn,md5($_POST['confirm_password']));

        //query
        $sql = "SELECT * FROM tbl_admin  WHERE id=$id AND password = '$current_password'";
        //menjalankan query
        $res = mysqli_query($conn,$sql);

        //cek apkah data masuk ke database/tidak
        if($res==TRUE){
            $count = mysqli_num_rows($res);
            if($count==1){
                //cek apakah password cocok/dapat dikonfirmasi
                if($new_password == $confirm_password){
                    //update password
                    //tidak bisa membuat query baru di dialam sql yang sama
                    $sql2 = "UPDATE tbl_admin SET password = '$new_password'  WHERE id=$id";
                    $res2 = mysqli_query($conn,$sql2);
                    //cek apakah query jalan
                    if($res2==TRUE){
                        //session digunakan untuk menyimpan data selama menjalankan browser
                        //variable session untuk menampilkan pesan
                        $_SESSION['change-pwd'] = "<div class='success'>Password changed successfully</div>";
                        //menampilkan halaman manage admin
                        header("location:".SITEURL.'admin/manage-admin.php');
                    }else{
                        //session digunakan untuk menyimpan data selama menjalankan browser
                        //variable session untuk menampilkan pesan
                        $_SESSION['change-pwd-failed'] = "<div class='error'>Password failed to change</div>";
                        //menampilkan halaman manage admin
                        header("location:".SITEURL.'admin/update-password.php');
                    }
                }else{
                    //session digunakan untuk menyimpan data selama menjalankan browser
                    //variable session untuk menampilkan pesan
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password doesn't match</div>";
                    //menampilkan halaman manage admin
                    header("location:".SITEURL.'admin/update-password.php');
                }
            }
            
        }else{
            //session digunakan untuk menyimpan data selama menjalankan browser
            //variable session untuk menampilkan pesan
            $_SESSION['user-not-found'] = "<div class='error'>Current Passowrd False </div>";
            header("location:".SITEURL.'admin/update-password.php');
        }
    }
?>

<?php include('partials/footer.php') ?>