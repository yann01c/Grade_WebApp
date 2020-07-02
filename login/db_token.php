<?php
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE IF NOT EXISTS token (
        token_id INTEGER PRIMARY KEY,
        email varchar(50),
        token TEXT,
        timestamp TEXT)');