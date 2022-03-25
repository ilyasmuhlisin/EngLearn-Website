<?php
    //authorization-access control
    //cek apkah user login/tidak
    if(!isset($_SESSION['user'])){
        //jika user tidak login
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login first</div>";
        //kembali ke halaman login
        header('location:'.SITEURL.'login.php');
    }

?>