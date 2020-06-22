<?php
session_start();
if(isset($_POST['submit'])) {

    // POST vars
    $grade = $_POST['s_grade'];
    $date = $_POST['s_date'];
    $weighting = $_POST['s_weighting'];
    $description = $_POST['s_description'];
    $class = $_POST['s_class'];
    echo "CLASS = ".$class;

    $check = 0;

    // Count files
    if (isset($_FILES['fileToUpload']['name'])) { 
        $total_files = count($_FILES['fileToUpload']['name']);
    }

    // Check for missing fields
    if (empty($grade)) {
        header("Location: ../index.php?error=empty&d=$date&w=$weighting&c=$class");
        exit();
    }
    else if (empty($date)) {
        header("Location: ../index.php?error=empty&g=$grade&w=$weighting&c=$class");
        exit();
    }
    else if (empty($weighting)) {
        header("Location: ../index.php?error=empty&g=$grade&d=$date&c=$class");
        exit();
    }
    else if (empty($class)) {
        header("Location: ../index.php?error=empty&g=$grade&d=$date&w=$weighting");
        exit();
    }

    // Check if grade is valid
    else if ($grade > 6.0 || $grade < 0) {
        header("Location: ../index.php?error=grade?d=$date?w=$weighting?c=$class");
        exit();
    }

    if (empty($description)) {
        $description = "-";
    }

    // File array
    $path_filename_ext = array();
    // Target directory var
    $target_dir = "../upload/";
    // Allowed extensions array
    $ext_arrays = array("jpg", "JPG", "jpeg", "JPEG", "PNG", "png", "heif", "heic");

    // For loop for multiple files
    for ($i = 0; $i < $total_files; $i++) {
        if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i])) {

            // File(s) uploaded
            $db = new SQLite3('../sqlite/webapp.db');
            $db->busyTimeout(5000);
            $db->exec('PRAGMA journal_mode = wal;');
            // Type
            $filetype = $_FILES['fileToUpload']['type'][$i];
            // Size
            $filesize = $_FILES['fileToUpload']['size'][$i];
            // File
            $file = $_FILES['fileToUpload']['name'][$i];
            // Path
            $path = pathinfo($file);
            // Custom file name
            $filename[$i] = md5(uniqid(rand(), true));
            echo "<h1>".$filename[$i]."</h1>";
            // File extension
            $ext = $path['extension'];
            echo "EXTENSION: ".$ext;
            // Temp path
            $temp_name = $_FILES['fileToUpload']['tmp_name'][$i];
            // Target path
            $path_filename_ext[] = $target_dir.$filename[$i].".".$ext;
            // DB insert
            $dbfile[] = "upload/".$filename[$i].".".$ext;
            // Max size of files (byte)
            $maxSize = 10000000;

            // Check if file is not bigger than 10 MB
            if ($filesize >= $maxSize) {
                header("Location: ../index.php?error=toobig");
                exit();
            }

            // Check if extension is allowed
            if (!empty($ext)) {
                // Check if $ext is in $ext_arrays
                if (!in_array($ext, $ext_arrays)) {
                    header("Location: ../index.php?error=wrongext");
                    exit();
                }
            }

            // Move file(s) in /upload directory with the right permissions
            move_uploaded_file($temp_name,$path_filename_ext[$i]);
            chmod($path_filename_ext[$i], 0755);

            $idfiles[] = array();

            $sqlfile = $db->prepare("INSERT INTO file (filename) VALUES (:file)");
            $sqlfile->bindValue(':file', $dbfile[$i]);
            $finish = $sqlfile->execute();

            $sqlids = $db->prepare("SELECT MAX(file_id) FROM file");
            $idfres = $sqlids->execute();
            $idfrow = $idfres->fetchArray();
            
            $idfiles[$i] = $idfrow[0];
            $check = 1;
            echo "FILE ID's = ".$idfiles[$i];
            $db->close();
        } else {

            // No file(s) uploaded
            $db = new SQLite3('../sqlite/webapp.db');
            $db->busyTimeout(5000);
            $db->exec('PRAGMA journal_mode = wal;');

            $dbfile = "No Image!";

            $tfile = $_FILES['fileToUpload']['name'][$i];
            $tpath = pathinfo($tfile);
            $text = $tpath['extension'];
            echo "T-EXTENSION: ".$text;
            echo "T-NAME: ".$_FILES['fileToUpload']['name'][$i];
            echo "T-TMPNAME: ".$_FILES['fileToUpload']['tmp_name'][$i];
            echo "T-TYPE: ".$_FILES['fileToUpload']['type'][$i];

            echo $dbfile;
            $sqlfile2 = $db->prepare("INSERT INTO file (filename) VALUES (:files)");
            $sqlfile2->bindValue(':files', $dbfile);
            $finish2 = $sqlfile2->execute();
            $db->close();
        }
    }
    
    $db = new SQLite3('../sqlite/webapp.db');
    $db->busyTimeout(5000);
    $db->exec('PRAGMA journal_mode = wal;');

    // SQL insert into table "grade"
    $userID = $_SESSION['userID'];
    $sql = $db->prepare("SELECT * from class WHERE class = :iclass AND fk_user = :user");
    $sql->bindValue(':iclass',$class);
    $sql->bindValue(':user',$userID);
    $r = $sql->execute();
    $row = $r->fetchArray();
    $fkclass = $row['class_id'];
    $sqlg = $db->prepare("INSERT INTO grade (grade,date,weighting,description,fk_class,fk_user) VALUES (:grade,:date,:weighting,:des,:fkclass,:userid)");

    // Check if SQL statement is valid (works)
    if (!$sql) {
        header("Location: ../index.php?error=sql");
        exit();
    } else {

        // Bind values to prepare statement
        $sqlg->bindValue(':grade',$grade);
        $sqlg->bindValue(':date',$date);
        $sqlg->bindValue(':weighting',$weighting);
        $sqlg->bindValue(':des',$description);
        $sqlg->bindValue(':fkclass',$fkclass);
        $sqlg->bindValue(':userid',$userID);
        $result = $sqlg->execute();

        $idselect = $db->prepare("SELECT MAX(grade_id) FROM grade");
        $idres = $idselect->execute();
        $idrow = $idres->fetchArray();
        $idgrade = $idrow[0];

        $check = 1;
        $i = 0;
        $a = $total_files;

        if ($dbfile != "No Image!") {
            while ($a != $i) {
                $file_grade = $db->prepare("INSERT INTO file_grade (fk_grade,fk_file) VALUES (:gradeid,:fileid)");
                $file_grade->bindValue(':gradeid',$idgrade);
                $file_grade->bindValue(':fileid',$idfiles[$i]);
                $file_result = $file_grade->execute();
                $i++;
                echo "  FILE_GRADE  ";
            }
        }

        // Success message
        header("Location: ../index.php?info=success&grade=$grade&class=$new_class");
        exit();
        echo "finished";
    }
}