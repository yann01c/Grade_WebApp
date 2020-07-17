<?php

$db = new SQLite3('sqlite/webapp.db');

$sql = $db->query("INSERT INTO 'group' (group_id,'group') VALUES (1,'IT')");
$sql = $db->query("INSERT INTO 'group' (group_id,'group') VALUES (2,'KV')");
$sql = $db->query("INSERT INTO 'group' (group_id,'group') VALUES (3,'Berufsbildner')");
$sql = $db->query("INSERT INTO 'group' (group_id,'group') VALUES (4,'Admin')");

$db->close();