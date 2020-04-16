<?php
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE IF NOT EXISTS login (user_id INTEGER PRIMARY KEY, username varchar(50), email varchar(50), passwd varchar(30), rpasswd varchar(30))');
?>