<?php
    include('../config/constants.php');

    //cek apakah gambar dengan id sama
    // mengambil id dan gambar yang akan dihapus
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //mengambil ida dan nama gambar
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //hapus gambar jika tersedia
        if($image_name !=""){
            //jika tersedia hapus dari direktori
            $path = "../images/course/".$image_name;
            //menggunakan fungsi unlink
            $remove = unlink($path);//bernilai T/F
            //cek jika gagal dihapus
            if($remove==false){
                $_SESSION['remove'] = "<div class='error'>Failed to remove</div>";
                //halaman tujuan
                header("location:".SITEURL.'admin/manage-course.php');
                //hentikan proses
                die();
            }
        }

        //hapus from database
        $sql = "DELETE FROM tbl_course WHERE id=$id";
        //menjalankan query
        $res = mysqli_query($conn, $sql);

        //cek query apakah berhasil
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Successfuly deleted</div>";
            //halaman tujuan
            header("location:".SITEURL.'admin/manage-course.php');
        }else{
            $_SESSION['delete'] = "<div class='error'>Failed to delete</div>";
            header("location:".SITEURL.'admin/manage-course.php');
        }
    }else{
        //menuju halaman yang diinginkan 
        //apabila user langsung menuju ke halaman delete akan dialihkan ke halaman kursus
        header("location:".SITEURL.'admin/manage-course.php');
    }

?>