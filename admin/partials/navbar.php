<!-- karena navbar untuk semua halaman maka koneksi dimasukkan ke navbar -->
<?php 
    include('../config/constants.php');
    include('login-check.php');
?> 
<html>
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <section class="navbar">
        <div class="navbar text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-user.php">User</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-course.php">Course</a></li>
                    <li><a href="manage-documents.php">Documents</a></li>
                    <li><a href="manage-method.php">Method</a></li>
                    <li><a href="manage-proof.php">Payments</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        </section>