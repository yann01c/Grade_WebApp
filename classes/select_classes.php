<?php
    $db = new SQLite3('sqlite/webapp.db');

    // Get fk_group ID
    $userID = $_SESSION['userID'];
    $sql = $db->prepare("SELECT fk_group FROM login WHERE user_id = :userid");
    $sql->bindValue(':userid',$userID);
    $r = $sql->execute();
    $fk = $r->fetchArray();
    $fkgroup = $fk['fk_group'];
    $result = $db->query("SELECT * FROM class WHERE fk_group = '$fkgroup'");

    // Select every class in class with the right group id and display it in "option" element in HTML
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        echo "<option value=".$row['class'].">".$row['class']."</option>";
    }