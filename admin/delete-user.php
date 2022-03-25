<?php
    include('../config/constants.php');

    //mengambil id yang akan dihapus
    $id = $_GET['id'];
    //query menghapus data admin
    $sql = "DELETE FROM tbl_user WHERE id=$id";
    //menjalankan query
    $res = mysqli_query($conn, $sql);

    //cek query apakah berhasil
    if($res==TRUE){
        $_SESSION['delete'] = "<div class='success'>Successfuly deleted</div>";
        //halaman tujuan
        header("location:".SITEURL.'admin/manage-user.php');
    }else{
        $_SESSION['delete'] = "<div class='error'>Failed to delete</div>";
        header("location:".SITEURL.'admin/manage-user.php');
    }
    //3

?>