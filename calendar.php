<!DOCTYPE html>
<?php include "calendar/db_events.php"; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet/less" type="text/css" href="css/calendar.less" />
    <title>Grades | Calendar</title>
</head>
<body>
<div class="container">
    <div class="submission" id="e-sub">
        <div class="back" id="e-back">
            <button onclick="hideshow()" id="e-btn">Hide</button>
        </div>
        <div id="e-back2">
            <a href="account.php" id="b-btn">Back</a>
        </div>
        <form action="calendar/insert_events.php" method="POST" id="form">
            <div>
                <label for="e-name">Eventname</label>
                <input type="text" name="e-name">
                <div class="border"></div>
            </div>
            <div>
                <label for="e-date">Date</label>
                <input type="date" name="e-date">
                <div class="border"></div>
            </div>
            <div>
                <label for="e-time">Time</label>
                <input type="time" name="e-time">
                <div class="border"></div>
            </div>
            <div>
                <label for="">Reminder</label>
                <select name="e-reminder" id="reminder">
                    <option value="-">-</option>
                    <option value="12h">12 hours before</option>
                    <option value="1d">1 day before</option>
                    <option value="2d">2 days before</option>
                    <option value="1w">1 week before</option>
                </select>
                <div class="border"></div>
            </div>
            <div>
                <label for="">Priority</label>
                <select name="e-priority" id="priority">
                    <option value="-">-</option>
                    <option value="h">High</option>
                    <option value="m">Medium</option>
                    <option value="l">Low</option>
                </select>
                <div class="border"></div>
            </div>
            <div>
                <label for="e-description">Description</label>
                <textarea rows="5" cols="50" name="e-description" placeholder=""></textarea>
                <div class="border"></div>
            </div>
            <div>
                <input type="submit" name="e-submit" value="Add Event" id="e-add">
            </div>
        </form>
    </div>
        <div class="calendar">
            <!-- <button onclick="AddEvent()">Add Event</button> -->
            <!-- <div id="events"> -->
            <?php include "calendar/select_events.php"; ?>
            <!-- </div> -->
        </div>
</div>
<script src="js/calendar.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>