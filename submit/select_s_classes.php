<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $db = new SQLite3('sqlite/webapp.db');

    // Get fk_group ID
    $userID = $_SESSION['userID'];
    $sql = $db->prepare("SELECT fk_group FROM login WHERE user_id = :userid");
    if (!$sql) {
        header("Location: class.php?error=sql");
        exit();
    }
    $sql->bindValue(':userid',$userID);
    $r = $sql->execute();
    $fk = $r->fetchArray();

    // Get all Classes with group_id = $fkgroup
    $sql2 = $db->prepare("SELECT * FROM class WHERE fk_user = :user");
    if (!$sql2) {
        header("Location: class.php?error=sql");
        exit();
    }
    
    $sql2->bindValue(':user',$userID);
    $result = $sql2->execute();

    // Select every class in class with the right group id and display it in "option" element in HTML
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        echo "<option value=".$row['class'].">".$row['class']."</option>";
    }