<?php
    $db = new SQLite3('sqlite/webapp.db');

    $sql = $db->prepare("SELECT * FROM login WHERE fk_group != 3");
    $result = $sql->execute();

    while($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $id = $row['user_id'];
        echo "<option value='$id'>".$row['username']."</option>";
    }