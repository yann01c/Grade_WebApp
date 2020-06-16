<?php
    $db = new SQLite3('sqlite/webapp.db');

    // Get fk_group ID
    $userID = $_SESSION['userID'];
    $sql = $db->prepare("SELECT fk_group FROM login WHERE user_id = :userid");
    if (!$sql) {
        echo "<p style='color:orange;font-weight:bold;font-size:1.5em;'>SQLite Error 1</p>";
        exit();
    }
    $sql->bindValue(':userid',$userID);
    $r = $sql->execute();
    $fk = $r->fetchArray();

    // Get all Classes with group_id = $fkgroup
    $sql2 = $db->prepare("SELECT * FROM class WHERE fk_user = :userid");
    if (!$sql2) {
        echo "<p style='color:orange;font-weight:bold;font-size:1.5em;'>SQLite Error 2</p>";
        exit();
    }
    $sql2->bindValue(':userid',$userID);
    $result = $sql2->execute();

    // Select every class in class with the right group id and display it in "option" element in HTML
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        echo "<option value=".$row['class'].">".$row['class']."</option>";
    }