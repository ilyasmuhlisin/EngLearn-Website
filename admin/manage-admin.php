<?php include('partials/navbar.php'); ?>
        <!-- main content section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
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
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>No</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        //query untuk mengaambil data admin di database
                        $sql = "SELECT * FROM tbl_admin";
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
                                    $full_name = $rows['full_name'];
                                    $username = $rows['username'];

                                    //menampilkan data
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $full_name;?></td>
                                            <td><?php echo $username;?></td>
                                            <td>
                                                <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                                <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                                <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
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