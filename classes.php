<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Classes</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body id="classes">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper" id="a-submit">
                    <a href="index.php">Submit</a>
                </div>
                <div class="nav-link-wrapper" id="a-classes">
                    <a href="#" class="active">Classes</a>
                </div>
                <div class="nav-link-wrapper" id="a-account">
                    <a href="account.php">Account</a>
                </div>
            </div>
            <div class="right-side">
            <img src="images/logo.png" class="logo" alt="logo"/>
            <?php 
                if (isset($_SESSION['userID'])) {
                    echo '<a href="account.php" class="userlogged">'.$_SESSION['userUID'].'</a>';
                } else {
                    // Redirect to login page if no active session
		            header("Location: account.php");
                }
            ?>
            </div>
        </div>
        <div class="main">
            <div class="form">
                <form action="class.php" method="GET">
                <div id="c-add-cont">
                    <button onclick="newClass()" type="button" id="c-add" class="c-add">Add new Class</button>
                </div>
                    <div class="float">
                        <label for="c1-class">Class</label><br>
                        <select id="c1-class" name="c1-class" onchange="cbtnAppear()">
                            <option value="-">&#8595</option>
                            <?php include 'classes/select_classes.php';?>
                        </select>
                    </div>
                    <div>
                        <label for="c2-class">Average</label><br>
                        <input type="text" name="c2-grade" vaule="" disabled>
                    </div>
                    <div>
                        <button type="submit" class="c-button" id="c-btn">Go to</button>
                    </div>
                </form>
            </div>
            <div id="classadded_container">
                <p id="classadded"></p>
            </div>
        </div>
        <div class="footer">
            <div class="copyright">Copyright - SPIE ICS ©</div>
        </div>
    </div>
    <script src="js/main.js"></script>
</body>
</html>