<?php
    $db = new SQLite3('sqlite/webapp.db');
    $db->exec('CREATE TABLE IF NOT EXISTS events (
        event_id INTEGER PRIMARY KEY,
        eventname varchar(100),
        date date,
        time date,
        description TEXT,
        email varchar(50),
        reminder varchar(32),
        priority varchar(16),
        "check" INTEGER,
        deleted varchar(16),
        fk_user INTEGER,
        FOREIGN KEY (fk_user)
            REFERENCES login (user_id))');