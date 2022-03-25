<?php
    //menjalanakn fungsi session
    session_start();
    //dibuat terpisah supaya tidak membuat ulang
    //konstanta berfungsi seperti variabel namun harus kapital semua
    //supaya tidak terlihat secara langsung
    define('SITEURL','http://localhost/tugas_final/');
    $servername = "localhost";
    $database = "elearning";
    $username = "root";
    $password = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
    mysqli_close($conn);

    // define('LOCALHOST', 'localhost');
    // define('DB_USERNAME', 'root');
    // define('DB_PASSWORD', '');
    // define('DB_NAME', 'elearning');

    // $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD);
    // $db_select = mysqli_select_db($conn,DB_NAME);
    // $conn = mysqli_connect("localhost", "root", "", "elearning");
?>