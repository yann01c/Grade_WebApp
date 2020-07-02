<?php
if (isset($_GET['token'])) {
    $tok = $_GET['token'];

    $token = filter_var($tok, FILTER_SANITIZE_STRING);


    $db = new SQLite3('sqlite/webapp.db');

    $sql = $db->prepare("SELECT * FROM token WHERE token = :thetoken");
    if (!$sql) {
        header('reset.php?error=sql');
        exit();
    }
    $sql->bindValue(':thetoken',$token);
    $result = $sql->execute();
    $row = $result->fetchArray();

    if (empty($row['token'])) {
        header('reset.php?error=notoken');
    }

    $date = $row['timestamp'];

    if (strtotime($date) < strtotime('-900 seconds') && !empty($date)) { 
        alert("Token Valid!");
    } else {
        header("Location: account.php?error=expired");
        exit();
    }   
}