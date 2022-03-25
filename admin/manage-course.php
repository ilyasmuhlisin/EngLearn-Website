<?php include('partials/navbar.php'); ?>
        <!-- main content section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Course</h1>
                <br>
                    <?php
                        if(isset($_SESSION['add'])){
                            echo $_SESSION['add'];//menampilkan pesan
                            unset($_SESSION['add']);//menghapus pesan
                        }
                         if(isset($_SESSION['remove'])){
                            echo $_SESSION['remove'];//menampilkan pesan
                            unset($_SESSION['remove']);//menghapus pesan
                        }
                        if(isset($_SESSION['delete'])){
                            echo $_SESSION['delete'];//menampilkan pesan
                            unset($_SESSION['delete']);//menghapus pesan
                        }
                        if(isset($_SESSION['no-category-found'])){
                            echo $_SESSION['no-category-found'];//menampilkan pesan
                            unset($_SESSION['no-category-found']);//menghapus pesan
                        }
                        if(isset($_SESSION['update'])){
                            echo $_SESSION['update'];//menampilkan pesan
                            unset($_SESSION['update']);//menghapus pesan
                        }
                        if(isset($_SESSION['upload'])){
                            echo $_SESSION['upload'];//menampilkan pesan
                            unset($_SESSION['upload']);//menghapus pesan
                        }
                        if(isset($_SESSION['failed-remove'])){
                            echo $_SESSION['failed-remove'];//menampilkan pesan
                            unset($_SESSION['failed-remove']);//menghapus pesan
                        }
                    ?>
                <br><br>
                <!-- button untuk menambah admin -->
                <a href="<?php echo SITEURL;?>admin/add-course.php" class="btn-primary">Add Course</a>
                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                        //query untuk mengaambil data di database
                        $sql = "SELECT * FROM tbl_course";
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
                                    $title = $rows['title'];
                                    $category = $rows['category_id'];
                                    $image_name = $rows['image_name'];
                                    $active = $rows['active'];

                                    //menampilkan data
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $title;?></td>
                                            <td><?php echo $category;?></td>
                                            <td>
                                                <?php
                                                    //cek apkah gambar ada dan menampilkannya
                                                    if($image_name!=""){
                                                        //tampilkan gambar
                                                        ?>
                                                        <img src="<?php echo SITEURL;?>images/course/<?php  echo $image_name; ?>" width="100px">
                                                        <?php
                                                    }else{
                                                        echo "<div class='error'>Image not available</div>";
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $active;?></td>
                                            <td>
                                                <a href="<?php echo SITEURL;?>admin/update-course.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                                <a href="<?php echo SITEURL;?>admin/delete-course.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                ?>
                                    <!-- menampilkan pesan di table jika tidak ada data -->
                                    <tr>
                                        <td><div colspan="6" class="error">Data Not Found</div></td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
<?php include('partials/footer.php'); ?>  