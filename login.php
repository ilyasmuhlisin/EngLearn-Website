<?php include('config/constants.php')?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br>

            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset ($_SESSION['no-login-message']);
                }
            ?><br>
            <!-- login form -->
            <form action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>

                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"><br>
                <a class="link-adm" href="admin/login.php">Admin?</a>
                <br><br>
                <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
                
            </form>
        </div>
    </body>
</html>
<?php 
    //cek apakah button submit diclick
    if(isset($_POST['submit'])){
        //proses login
        //mendapatkan data dari inputan
        // $username = $_POST['username'];
        //menjadikan inputan string
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $def_password = md5($_POST['password']);
        $password =  mysqli_real_escape_string($conn, $def_password);

        //sql untuk cek apakah username dan password terdapat di database
        $sql = "SELECT * FROM tbl_user WHERE username ='$username' AND password = '$password'";
        //menjalankan query
        $res = mysqli_query($conn,$sql);

        //menghitung data user ada atau tidak
        $count = mysqli_num_rows($res);

        //jika data yang dimasukan ada dan hanya 1
        if($count==1){
            $_SESSION['login']="<div class='success'>Login succesful</div>";
            $_SESSION['user'] = $username;//untuk mengethaui user login
            //menuju halaman yang diinginkan
            header('location: '.SITEURL.'lesson.php');
        }else{
            $_SESSION['login']="<div class='error text-center'>Username or Password wrong</div>";
            //menuju halaman yang diinginkan
            header('location: '.SITEURL.'login.php');
        }
    }

?>