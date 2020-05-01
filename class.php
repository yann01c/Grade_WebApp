<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - <?php include 'class/select_class.php'; ?></title>
    <link rel="stylesheet" href="css/main.css">
    <!-- are you sure you need ajax and bootstrap? or is bootstrap for the popup? -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body id="class">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper">
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="classes.php" class="active">Classes</a>
                </div>
                <div class="nav-link-wrapper">
                    <a href="account.php">Account</a>
                </div>
            </div>
            <div class="right-side">
            <img src="images/logo.png" class="logo" alt="logo"/>
            <?php 
                if (isset($_SESSION['userID'])) {
                    echo '<a href="account.php" class="userlogged">'.$_SESSION['userUID'].'</a>';
                } else {
                }
            ?>
            </div>
        </div>
        <div class="main">
            <div class="bck-btn">
                <a href="classes.php">Back</a>
            </div>
            <div class="title">
                <h2>Overview - <?php if(isset($_POST['c1-class']) || ($_GET['c1-class'])) {
                            include 'class/select_class.php';
                        } else {
			    header("Location: /classes.php\n\r");
                        }?></h2>
            </div>
            <div class="form">
               <div id="class-center">
                   <div>
                       <ul>
                           <?php
                               include 'class/select_grade.php';
                           ?>
                       </ul>
                       <?php include "class/total_grade.php"; ?>
                   </div>
               </div>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">Copyright - SPIE ICS ©</div>
        </div>
    </div>
    <script src="js/popup.js"></script>
</body>
</html>
