<?php
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE user (user_id INTEGER PRIMARY KEY,username varchar(50),email varchar(50),password ')
?>