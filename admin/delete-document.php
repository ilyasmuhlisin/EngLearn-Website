<?php
    include('../config/constants.php');

    //cek apakah gambar dengan id sama
    // mengambil id dan gambar yang akan dihapus
    if(isset($_GET['id']) && isset($_GET['answer'])){
        //mengambil ida dan nama gambar
        $id = $_GET['id'];
        $answer = $_GET['answer'];

        //hapus gambar jika tersedia
        if($answer !=""){
            //jika tersedia hapus dari direktori
            $path = "../images/documents/".$answer;
            //menggunakan fungsi unlink
            $remove = unlink($path);//bernilai T/F
            //cek jika gagal dihapus
            if($remove==false){
                $_SESSION['remove'] = "<div class='error'>Failed to remove</div>";
                //halaman tujuan
                header("location:".SITEURL.'admin/manage-documents.php');
                //hentikan proses
                die();
            }
        }

        //hapus from database
        $sql = "DELETE FROM tbl_documents WHERE id=$id";
        //menjalankan query
        $res = mysqli_query($conn, $sql);

        //cek query apakah berhasil
        if($res==TRUE){
            $_SESSION['delete'] = "<div class='success'>Successfuly deleted</div>";
            //halaman tujuan
            header("location:".SITEURL.'admin/manage-documents.php');
        }else{
            $_SESSION['delete'] = "<div class='error'>Failed to delete</div>";
            header("location:".SITEURL.'admin/manage-documents.php');
        }
    }else{
        //menuju halaman yang diinginkan 
        //apabila user langsung menuju ke halaman delete akan dialihkan ke halaman kategori
        header("location:".SITEURL.'admin/manage-documents.php');
    }

?>