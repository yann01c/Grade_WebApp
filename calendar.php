<!DOCTYPE html>
<?php include "calendar/db_events.php"; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet/less" type="text/css" href="css/calendar.less" />
    <title>Calendar</title>
</head>
<body>
<div class="container">
    <div class="submission">
        <form action="calendar/insert_events.php" method="POST">
            <div>
                <label for="e-name">Eventname</label>
                <input type="text" name="e-name">
            </div>
            <div>
                <label for="e-date">Date</label>
                <input type="date" name="e-date">
            </div>
            <div>
                <label for="e-time">Time</label>
                <input type="text" name="e-time">
            </div>
            <div>
                <label for="e-description">Description</label>
                <input type="textarea" name="e-description">
            </div>
            <div>
                <input type="submit" name="e-submit" value="Add Event">
            </div>
        </form>
    </div>
        <div class="calendar">
            <!-- <button onclick="AddEvent()">Add Event</button> -->
            <div id="events">
                <?php include "calendar/select_events.php"; ?>
            </div>
        </div>
</div>
<script src="js/calendar.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>