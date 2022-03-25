<?php include('partials/navbar.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Documents</h1>
                <br />
                <?php 
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br>

                <table class="tbl-full">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Username</th>
                        <th>Answer</th>
                        <th>Kategori</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //mengambil data dari database
                        $sql = "SELECT * FROM tbl_documents ORDER BY id DESC"; 
                        //jalankan Query
                        $res = mysqli_query($conn, $sql);
                        //menghitung data
                        $count = mysqli_num_rows($res);

                        $no = 1; //nilai awal buat penomoran

                        if($count>0){
                            while($row=mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title = $row['title'];
                                $username = $row['username'];
                                $answer = $row['answer'];
                                $category_file = $row['category_file'];
                                
                                ?>

                                    <tr>
                                        <td><?php echo $no++; ?>. </td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td><?php echo $answer; ?></td>
                                        <td><?php echo $category_file; ?></td>
                                        <td><a href="<?php echo SITEURL; ?>admin/view-document.php?id=<?php echo $id; ?>" class="btn-secondary">View</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-document.php?id=<?php echo $id; ?>&answer=<?php echo $answer;?>" class="btn-danger">Delete</a></td>
                                    </tr>

                                <?php

                            }
                        }else{
                            echo "<tr><td colspan='12' class='error'>Data tidak ada</td></tr>";
                        }
                    ?>
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>