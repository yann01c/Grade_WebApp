<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <title>Grades | All Grades</title>
    <link rel="icon" type="image/png" href="images/icons/icon_taskbar_transparent.png">
    <link rel="stylesheet" href="css/account.css">

    <link rel="manifest" href="manifest.json">

    <!-- IOS App Icon -->
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/iphone/icon_iphone_black.png">

</head>
<body id="grades">
    <div id="grades_cont">
        <div id="grades_main">
        <form action="#" method="POST">
            <div class="big-wrapper">
                <?php include 'all/allgrades.php'; ?>
            </div>
        </form>
        <div style="width:100%;display:flex;justify-content:center;"><a class="grades-back" href="index.php">Back</a></div>
        </div>
    </div>
    <script src="js/sort.js"></script>
</body>
</html>

