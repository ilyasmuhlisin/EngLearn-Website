<?php include('config/constants.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EngLearn Website</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar-->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo1.jpg"  class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>Courses.php">Course</a>
                    </li>
                    <!-- <li>
                        <a href="<?php echo SITEURL; ?>about.php">About Us</a>
                    </li> -->
                    <?php
                    if(isset($_SESSION['user'])){
                        ?><li>
                        <a href='<?php echo SITEURL; ?>logout.php'>Logout</a>
                    </li><?php
                    }else{
                        
                    };
                    ?>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>