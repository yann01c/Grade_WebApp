<?php
session_start();
$db = new SQLite3('sqlite/webapp.db');

$userID = $_SESSION['userID'];

$sql = $db->prepare("SELECT * FROM grade WHERE fk_user = $userID ");