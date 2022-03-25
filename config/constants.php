<?php
    //menjalanakn fungsi session
    session_start();
    //dibuat terpisah supaya tidak membuat ulang
    //konstanta berfungsi seperti variabel namun harus kapital semua
    //supaya tidak terlihat secara langsung
    define('SITEURL','http://localhost/tugas_final/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'elearning');

    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD);
    $db_select = mysqli_select_db($conn,DB_NAME);
    // $conn = mysqli_connect("localhost", "root", "", "elearning");
?>