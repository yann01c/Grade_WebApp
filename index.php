<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade - Submit</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" type="image/png" href="images/logo.png" sizes="96x96">
    <link rel="manifest" href="manifest.json">
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
                <form action="submit/insert_grade.php" method="post" enctype="multipart/form-data">
                    <div>
                    <label for="fileToUpload">Upload Screenshot:</label><br>
                        <input type="file" name="fileToUpload[]" id="fileToUpload" multiple>
                    </div>
                    <div class="float">
                        <label for="s_class">Class</label><br>
                        <select id="s-class" name="s_class">
                            <option value="none">&#8595</option>
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
                        <input type="number" step="0.01" name="s_weighting" placeholder="%">
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
                    echo "<div class='submitteddiv'><p class='submit-handler' style='color:red;'>Extension Invalid!</p>";
                }
                else if ($_GET['error'] == 'empty') {
                    echo "<div class='submitteddiv'><p class='submit-handler' style='color:red;'>Missing fields!</p></div>";
                }
                else if ($_GET['error'] == 'weighting') {
                    echo "<div class='submitteddiv'><p class='submit-handler' style='color:red;'>Weighting Invalid!</p></div>";
                }
                else if ($_GET['error'] == 'grade') {
                    echo "<div class='submitteddiv'><p class='submit-handler' style='color:red;'>Grade Invalid!</p></div>";
                }
                else if ($_GET['error'] == 'exist') {
                    echo "<div class='submitteddiv'><p class='submit-handler' style='color:blue;'>File already exists!</p></div>";
                }
                else if ($_GET['error'] == 'sql') {
                    echo "<div class='submitteddiv'><p class='submit-handler'style='color:orange;'>SQlite Error</p></div>";
                }
            }
            // Info Handler
            if (isset($_GET['info'])) {
                if ($_GET['info'] == 'success') {
                    echo "<div class='submitteddiv'><p class='submit-handler' style='color:lightgreen;'>Successfully Submitted Grade!</p></div>";
                }
            }
            ?>
            </div>
        <div class="footer">
            <div class="copyright">All Rights Reserved - © SPIE ICS</div>
        </div>
    </div>
</body>
</html>