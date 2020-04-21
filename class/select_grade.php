<?php
    $db = new SQLite3('sqlite/webapp.db');
    $userID = $_SESSION['userID'];

    $result = $db->query("SELECT * FROM grade WHERE fk_user = '$userID'");

    // Select every grade in grade and display it in "option" element in HTML
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        echo "<option value=".$row['grade'].">".$row['grade']."</option>";
    }
?>