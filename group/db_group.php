<?php
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE IF NOT EXISTS "group" (
        group_id INTEGER PRIMARY KEY,
        "group" varchar(50))');
?>