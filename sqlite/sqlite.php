    <?php
    class MyDB extends SQLite3
    {
        function __construct()
        {
            $db = $this->open('grade.db');
        }
    }
    $db = new MyDB();
    if(!$db){
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully\n";
    }
    
    $sql =<<<EOF
    CREATE TABLE CLASSES
    (ID INT PRIMARY KEY     NOT NULL,
    GRADE           FLOAT    NOT NULL,
    CLASS           VARCHAR(30) NOT NULL,
    DATE            DATE        NOT NULL,
    WEIGHT         INT          NOT NULL);
    EOF;

    $ret = $db->exec($sql);
    if(!$ret){
    echo $db->lastErrorMsg();
    } else {
    echo "Table created successfully\n";
    }
    $db->close();
    ?>