<?php include('partials/navbar.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update User</h1>
        <br>
         <?php 
            //mengambil id
            $id = $_GET['id'];
            //query
            $sql = "SELECT * FROM tbl_user WHERE id=$id";
            //menjalankan query
            $res = mysqli_query($conn,$sql);
            //cek apakah berjalan
            if($res==TRUE){
                //cek apakah database memiliki data / tidak
                $count = mysqli_num_rows($res);
                if($count==1){
                    $row = mysqli_fetch_assoc($res);
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }else{
                    header("location:".SITEURL.'admin/manage-user.php');
                }
            }else{

            }
        ?>
        <br><br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name: </td>
                    <td><input type="text" name="full_name" value="<?php echo $full_name;?>" required></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" value="<?php echo $username;?>" required></td>
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
        $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);

        //query
        $sql = "UPDATE tbl_user SET full_name = '$full_name', username = '$username' WHERE id='$id'";
        //menjalankan query
        $res = mysqli_query($conn,$sql);

        //cek apkah data masuk ke database/tidak
        if($res==TRUE){
            //session digunakan untuk menyimpan data selama menjalankan browser
            //variable session untuk menampilkan pesan
            $_SESSION['update'] = "<div class='success'>Update successful</div>";
            //menampilkan halaman manage admin
            header("location:".SITEURL.'admin/manage-user.php');
        }else{
            //session digunakan untuk menyimpan data selama menjalankan browser
            //variable session untuk menampilkan pesan
            $_SESSION['update'] = "<div class='error'>Update failed</div>";
            //menuju halaman yang diinginkan
            header("location:".SITEURL.'admin/manage-user.php');
        }
    }
?>

<?php include('partials/footer.php') ?>
