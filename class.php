<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Class</title>
    <link rel="stylesheet" href="css/main.css">
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
                <h2>Overview - <?php include 'class/select_class.php'; ?></h2>
            </div>
            <div class="form">
                <form>
                    <div id="class-center">
                        <div>
                            <ul>
                                <?php include 'class/select_grade.php'; ?>
                            </ul>
                            <!-- The Modal -->
                            <div id="myModal" class="modal">
                            <!-- Modal content -->
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <p>Some text in the Modal..</p>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="c-button" id="class-btn">Go to Grade</button>                
                    </div>
                </form>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">Copyright - SPIE ICS ©</div>
        </div>
    </div>
    <script src="js/popup.js"></script>
</body>
</html>