<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Execption;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

session_start();
$db = new SQLite3("../sqlite/webapp.db");

$sql = $db->prepare("SELECT * FROM events");
$result = $sql->execute();

while ($row = $result->fetchArray()) {

    $eventname = $row['eventname'];

    // Mail basics
    $to = $row['email'];
    $subject = "Reminder: $eventname";
    $rtime = $row['reminder'];
    $id = $row['event_id'];
    $msg = "

    <style>
    .title {
        font-size: 1.4em;
        text-shadow: 2px 2px black;
    }
    .text {
        font-size: 1.0em;
    }
    </style>

    <div class='container'><div class='main'><h1 class='title'>Quick Reminder for $eventname!</h1>\n\n <p class='text'>Your event will take place in $rtime.</p>\n\n<p style='font-size: 0.7em;color:darkblue;'>Thanks for using SPIE Grades</p></div></div>
    ";

    // if ($row['check'] != 1) {

        // 1 day reminder
        if ($row['reminder'] == "1d") {
            $now = date("Y-m-d");
            $date = $row['date'];
            $time = strtotime("$date -1 days");
            $date = date("Y-m-d", $time);

            if ($date == $now) {
                
                // Send mail

                $mail = new PHPMailer(true);

                try {
                    // Server
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->SMTPSecure = false;
                    $mail->SMTPAutoTLS = false;
                    $mail->isSMTP();
                    $mail->Host      = '100.100.101.25';
                    $mail->Port      = 25;
                    // Recipients
                    $mail->setFrom('info@grades.spie.ch','Grades-Mailer');
                    $mail->addAddress($to);
                    // Content
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = $subject;
                    $mail->Body    = $msg;
                    $mail->AltBody = $msg;
                    $mail->send();
                    echo 'Message has been sent';
                    echo " - 1 Day\n";
                    $usql = $db->prepare("UPDATE events SET check = 1 WHERE event_id = $id");
                    $uresult = $usql->execute();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
        // 2 days reminder
        else if ($row['reminder'] == "2d") {
            $now = date("Y-m-d");
            $date = $row['date'];
            $time = strtotime("$date -2 days");
            $date = date("Y-m-d", $time);

            if ($date == $now) {
                
                $mail = new PHPMailer(true);

                try {
                    // Server
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->SMTPSecure = false;
                    $mail->SMTPAutoTLS = false;
                    $mail->isSMTP();
                    $mail->Host      = '100.100.101.25';
                    $mail->Port      = 25;
                    // Recipients
                    $mail->setFrom('info@grades.spie.ch','Grades-Mailer');
                    $mail->addAddress($to);
                    // Content
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = $subject;
                    $mail->Body    = $msg;
                    $mail->AltBody = $msg;
                    $mail->send();
                    echo 'Message has been sent';
                    echo " - 2 Days\n";
                    $usql = $db->prepare("UPDATE events SET check = 1 WHERE event_id = $id");
                    $uresult = $usql->execute();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
        // 1 week reminder
        else if ($row['reminder'] == "1w") {
            $now = date("Y-m-d");
            $date = $row['date'];
            $time = strtotime("$date -7 days");
            $date = date("Y-m-d", $time);

            if ($date == $now) {
                $mail = new PHPMailer(true);

                try {
                    // Server
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->SMTPSecure = false;
                    $mail->SMTPAutoTLS = false;
                    $mail->isSMTP();
                    $mail->Host      = '100.100.101.25';
                    $mail->Port      = 25;
                    // Recipients
                    $mail->setFrom('info@grades.spie.ch','Grades-Mailer');
                    $mail->addAddress($to);
                    // Content
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = $subject;
                    $mail->Body    = $msg;
                    $mail->AltBody = $msg;
                    $mail->send();
                    echo 'Message has been sent';
                    echo " - 1 Week\n";
                    $usql = $db->prepare("UPDATE events SET check = 1 WHERE event_id = $id");
                    $uresult = $usql->execute();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    // }
}