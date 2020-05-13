<?php
    $db = new SQLite3('sqlite/webapp.db');

    $result = $db->query('select * from "group"');

    // Select every class in class and display it in "option" element in HTML
    while($row = $result->fetchArray(SQLITE3_ASSOC) ) {
        echo "<option value=".$row['group_id'].">".$row['group']."</option>";
    }
?>