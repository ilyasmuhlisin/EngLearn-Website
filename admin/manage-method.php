<?php include('partials/navbar.php'); ?>
        <!-- main content section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Method</h1>
                <br>

                <!-- validasi session dan menampilkan pesan -->
                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];//menampilkan pesan
                        unset($_SESSION['add']);//menghapus pesan
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];//menampilkan pesan
                        unset($_SESSION['delete']);//menghapus pesan
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];//menampilkan pesan
                        unset($_SESSION['update']);//menghapus pesan
                    }
                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];//menampilkan pesan
                        unset($_SESSION['change-pwd']);//menghapus pesan
                    }
                ?>
                <br><br>

                <!-- button untuk menambah admin -->
                <a href="add-method.php" class="btn-primary">Add Method</a>
                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Method Image</th>
                        <th>Method Acc</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        //query untuk mengaambil data admin di database
                        $sql = "SELECT * FROM tbl_method";
                        //menjalnakn query
                        $res = mysqli_query($conn, $sql);
                        //cek apakah query jalan atau tidak
                        if($res==TRUE){
                            //menghitung ada berapa data ditabel dan mengambil semua data
                            $count = mysqli_num_rows($res);
                            $no=1;//membuat variable untuk nomor
                            //cek apakah didatabase memiliki data
                            if($count > 0){
                                while($rows=mysqli_fetch_assoc($res)){
                                    //perulangan akan dijalankan sesuai jumlah data
                                    $id = $rows['id'];
                                    $name = $rows['name'];
                                    $image_method = $rows['image_method'];
                                    $rek_method = $rows['rek_method'];

                                    //menampilkan data
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $name;?></td>
                                            <td>
                                                <?php
                                                    //cek apkah gambar ada dan menampilkannya
                                                    if($image_method!=""){
                                                        //tampilkan gambar
                                                        ?>
                                                        <img src="<?php echo SITEURL;?>images/<?php  echo $image_method; ?>" width="100px">
                                                        <?php
                                                    }else{
                                                        echo "<div class='error'>Image not available</div>";
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $rek_method;?></td>
                                            <td>
                                                <a href="<?php echo SITEURL;?>admin/update-method.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                                <a href="<?php echo SITEURL;?>admin/delete-method.php?id=<?php echo $id; ?>&image_name=<?php echo $image_method;?>" class="btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{

                            }
                        }
                    ?>
                </table>
            </div>

        </div>
<?php include('partials/footer.php'); ?>  