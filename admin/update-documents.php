<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php 
            //cek id
            if(isset($_GET['id'])){
                //mengambil id
                $id = $_GET['id'];

                //query ke tabel order
                $sql = "SELECT * FROM tbl_documents WHERE id=$id";
                //jalankan Query
                $res = mysqli_query($conn, $sql);
                //menghitung data
                $count = mysqli_num_rows($res);

                if($count==1){
                    $row=mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $username = $row['username'];
                    $answer = $row['answer'];
                }else{
                    //ke halaman tujuan
                    header('location:'.SITEURL.'admin/manage-documents.php');
                }
            }else{
                header('location:'.SITEURL.'admin/manage-documents.php');
            }      
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Title Name</td>
                    <td><b> <?php echo $title; ?> </b></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><b><?php echo $username; ?></b></td>
                </tr>
                <tr>
                    <td>Answer: </td>
                    <td><input type="file" name="customer_name" value="<?php echo $answer; ?>"></td>
                </tr>
                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


        <?php 
            //cek apakah sbutton submit diclick
            if(isset($_POST['submit']))
            {
                $id = $_POST['id'];
                $username = $_POST['username'];
                $answer = $_POST['answer'];
                //query update
                $sql2 = "UPDATE tbl_documents SET 
                    username = $username,
                    total = $total,
                    answer = '$answer',
                    WHERE id=$id
                ";

                //jalankan Query
                $res2 = mysqli_query($conn, $sql2);
                //cek apakah query jalan
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Update successful</div>";
                    header('location:'.SITEURL.'admin/manage-documents.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Update failed</div>";
                    header('location:'.SITEURL.'admin/manage-documents.php');
                }
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>