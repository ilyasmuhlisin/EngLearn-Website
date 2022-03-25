<?php
    include('../config/constants.php');
    //hapus session
    session_destroy();
    //ke halaman login
    header('location:'. SITEURL.'admin/login.php');
?>