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
            <div class="grades_wrapper">
                <table class="grades_table" id="gradestable">
                    <tr>
                        <th onclick='sortTable(0)' class='idtable'>ID</th>
                        <th onclick='sortTable(1)' class='gradetable'>Grade</th>
                        <th onclick='sortTable(2)'>Date</th>
                        <th onclick='sortTable(3)' class='weightingtable'>%</th>
                        <!-- <th onclick='sortTable(4)'>Description</th> -->
                        <th onclick='sortTable(4)'>Status</th>
                        <th onclick='sortTable(5)'>Class</th>
                    </tr>
                    <?php include 'all/allgrades.php'; ?>
                </table>
            </div>
        </form>
        <div style="width:100%;display:flex;justify-content:center;"><a class="grades-back" href="index.php">Back</a></div>
        </div>
    </div>
    <script src="js/sort.js"></script>
    <script>alert("You can sort the table by clicking on the column name!");</script>
</body>
</html>

