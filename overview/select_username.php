<?php
if (isset($_GET['user-preview'])) {
    $db = new SQLite3('sqlite/webapp.db');
    
    $userID = $_GET['user-preview'];

    $sql = $db->prepare("SELECT * FROM login WHERE user_id = :id");
    $sql->bindValue(':id',$userID);
    $result = $sql->execute();
    $row = $result->fetchArray();

    $id = $row['user_id'];
    echo "<div><p class='ov-title'>".$row['username']."</p></div>";
} else {}