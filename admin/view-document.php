<?php include('partials/navbar.php'); ?>

<?php 
    //cek id
    if(isset($_GET['id'])){
        //mengambil id
        $id = $_GET['id'];

        //query
        $sql = "SELECT * FROM tbl_documents WHERE id=$id";
        //menjalankan query
        $res = mysqli_query($conn, $sql);
        //cek apakah berjalan
        //cek apakah database memiliki data / tidak
        $count = mysqli_num_rows($res);
        if($count==1){
            //mengambil data
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $username = $row['username'];
            $answer = $row['answer'];

        }else{
            $_SESSION['no-category-found'] = "<div class='error'>Tidak ada kategori</div>";
            header("location:".SITEURL.'admin/manage-documents.php');
        }
    }else{
        //menuju halaman kategori jika id tidak ada
        header('location:'.SITEURL.'admin/manage-documents.php');
    }
    //memanggil file example.pdf yang berada di folder bernama file
    $filePath = '../images/documents/'.$answer;
    //Membuat kondisi jika file tidak ada
    if (!file_exists($filePath)) {
        echo "File $filePath Tidak ditemukan";
        die();
    }
    //nama file untuk tampilan
    $filename=$answer;
    header('Content-type:application/pdf');
    header('Content-disposition: inline; filename="'.$filename.'"');
    header('content-Transfer-Encoding:binary');
    header('Accept-Ranges:bytes');
    //membaca dan menampilkan file
    readfile($filePath);
?>
