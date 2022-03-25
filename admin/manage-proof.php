<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Payments</h1>
                <br />
                <?php 
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                ?>
                <br>

                <table class="tbl-full">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Proof</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //mengambil data dari database
                        $sql = "SELECT * FROM tbl_pay ORDER BY id DESC"; 
                        //jalankan Query
                        $res = mysqli_query($conn, $sql);
                        //menghitung data
                        $count = mysqli_num_rows($res);

                        $no = 1; //nilai awal buat penomoran

                        if($count>0){
                            while($row=mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                                $proof = $row['proof'];
                                
                                ?>

                                    <tr>
                                        <td><?php echo $no++; ?>. </td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td>
                                                <?php
                                                    //cek apkah gambar ada dan menampilkannya
                                                    if($proof!=""){
                                                        //tampilkan gambar
                                                        ?>
                                                        <img src="<?php echo SITEURL;?>images/proof/<?php echo $proof; ?>" width="100px">
                                                        <?php
                                                    }else{
                                                        echo "<div class='error'>Image not available</div>";
                                                    }
                                                ?>
                                            </td>
                                        <td>
                                        <a href="<?php echo SITEURL; ?>admin/delete-proof.php?id=<?php echo $id; ?>&proof=<?php echo $proof;?>" class="btn-danger">Delete</a></td>
                                    </tr>

                                <?php

                            }
                        }else{
                            echo "<tr><td colspan='12' class='error'>Not available</td></tr>";
                        }
                    ?>
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>