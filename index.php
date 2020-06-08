<?php session_start(); ?>
<?php include "classes/db_classes.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <title>Grade - Submit</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" type="image/png" href="images/logo.png" sizes="96x96">
    <link rel="manifest" href="manifest.json">

    <!-- IOS Icon (instead of manifest icon) -->
    <link rel="apple-touch-icon" href="images/logo.png">
    <link rel="apple-touch-icon" sizes="152x152" href="images/logo.png">
    <link rel="apple-touch-icon" sizes="180x180" href="images/logo.png">
    <link rel="apple-touch-icon" sizes="167x167" href="images/logo.png">

    <!-- IOS Startup -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link href="images/splash/splash_2048x2732.png" sizes="2048x2732" rel="apple-touch-startup-image" />
    <link href="images/splash/splash_1668x2224.png" sizes="1668x2224" rel="apple-touch-startup-image" />
    <link href="images/splash/splash_1536x2048.png" sizes="1536x2048" rel="apple-touch-startup-image" />
    <link href="images/splash/splash_1125x2436.png" sizes="1125x2436" rel="apple-touch-startup-image" />
    <link href="images/splash/splash_1242x2208.png" sizes="1242x2208" rel="apple-touch-startup-image" />
    <link href="images/splash/splash_750x1334.png" sizes="750x1334" rel="apple-touch-startup-image" />
    <link href="images/splash/splash_640x1136.png" sizes="640x1136" rel="apple-touch-startup-image" />

</head>
<body id="index">
    <div class="container">
        <div class="nav-wrapper">
            <div class="left-side">
                <div class="nav-link-wrapper" id="a-submit">
                    <a href="#" class="active">Submit</a>
                </div>
                <div class="nav-link-wrapper" id="a-classes">
                    <a href="classes.php">Classes</a>
                </div>
                <div class="nav-link-wrapper" id="a-account">
                    <a href="account.php">Account</a>
                </div>
            </div>
            <div class="right-side">
                <a href="secret.php"><img src="images/logo.png" class="logo" alt="logo"/></a>
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
                <form action="submit/insert_grade.php" method="post" enctype="multipart/form-data">
                    <div>
                    <label for="fileToUpload">Upload Screenshot:</label><br>
                        <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
                    </div>
                    <div class="float">
                        <label for="s_class">Class</label><br>
                        <select id="s-class" name="s_class">
                            <option value="">&#8595</option>
                            <?php include 'submit/select_s_classes.php';?>
                        </select>
                    </div>
                    <div>
                        <label for="s_grade">Grade</label><br>
                        <input type="number" step="0.1" name="s_grade">
                    </div>
                    <div class="float">
                        <label for="s_date">Date</label><br>
                        <input type="date" name="s_date">
                    </div>
                    <div>
                        <label for="s_weighting">Weighting</label><br>
                        <select name="s_weighting">
                            <option value="">&#8595</option>
                            <option value="0.0">0%</option>
                            <option value="0.25">25%</option>
                            <option value="0.5">50%</option>
                            <option value="0.75">75%</option>
                            <option value="1">100%</option>
                        </select>
                        <!--<input type="number" step="0.01" name="s_weighting" placeholder="%">-->
                    </div>
                    <div>
                        <label for="s_description">Description</label><br>
                        <textarea rows="6" cols="50" name="s_description" placeholder=""></textarea>
                    </div>
                    <button name="submit" type="submit" value="Submit">Submit</button>
                </form>
            </div>
            <?php
            // Error Handler
            if (isset($_GET['error'])) {
                if ($_GET['error'] == 'wrongext') {
                    //echo "<div class='submitteddiv'><p class='submit-handler' style='color:red;'>Extension Invalid!</p>";
                    $message = "Extension Invalid";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == 'empty') {
                    //echo "<div class='submitteddiv'><p class='submit-handler' style='color:red;'>Missing fields!</p></div>";
                    $message = "Missing fields!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == 'weighting') {
                    //echo "<div class='submitteddiv'><p class='submit-handler' style='color:red;'>Weighting Invalid!</p></div>";
                    $message = "Weighting Invalid!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == 'grade') {
                    //echo "<div class='submitteddiv'><p class='submit-handler' style='color:red;'>Grade Invalid!</p></div>";
                    $message = "Grade Invalid!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                else if ($_GET['error'] == 'exist') {
                    //echo "<div class='submitteddiv'><p class='submit-handler' style='color:blue;'>File already exists!</p></div>";
                }
                else if ($_GET['error'] == 'sql') {
                    //echo "<div class='submitteddiv'><p class='submit-handler'style='color:orange;'>SQlite Error</p></div>";
                    $message = "SQlite Error!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
            // Info Handler
            if (isset($_GET['info'])) {
                if ($_GET['info'] == 'success') {
                    //echo "<div class='submitteddiv'><p class='submit-handler' style='color:lightgreen;'>Successfully Submitted Grade!</p></div>";
                    $message = "Successfully submitted Grade!";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
            }
            ?>
            </div>
        <div class="footer">
            <div class="copyright"><a style="text-decoration:none;" href="privacy.php">All Rights Reserved - © SPIE ICS</a></div>
        </div>
    </div>
    <script src="js/install.js"></script>
</body>
</html>