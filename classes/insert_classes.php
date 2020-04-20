<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $class) {
        echo "Class added: ",$class;
    }
    $db = new SQLite3('../sqlite/webapp.db');
    $db->exec("INSERT INTO class (class) VALUES ('$class')");
}
?>