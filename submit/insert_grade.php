<?php
session_start();
if(isset($_POST['submit'])) {

    // POST vars
    $grade = $_POST['s_grade'];
    $date = $_POST['s_date'];
    $weighting = $_POST['s_weighting'];
    $description = $_POST['s_description'];
    $desc = filter_var($description, FILTER_SANITIZE_STRING);
    $class = $_POST['s_class'];
    echo "CLASS = ".$class;

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
    else if (empty($desc)) {
        $desc = "-";
    }
    // Check if grade is valid
    else if ($grade > 6.0 || $grade < 0) {
        header("Location: ../index.php?error=grade?d=$date?w=$weighting?c=$class");
        exit();
    }

    // File array
    $path_filename_ext = array();
    // Target directory var
    $target_dir = "../upload/";
    // Allowed extensions array (heif & heic are iphone image extensions)
    $ext_arrays = array("jpg", "JPG", "jpeg", "JPEG", "PNG", "png", "heif", "HEIF", "heic", "HEIC");

    $test = $_FILES['fileToUpload']['name'][0];
    $test2 = $_FILES['fileToUpload']['tmp_name'][0];
    $test3 = $_FILES['fileToUpload']['size'][0];
    $test4 = $_FILES['fileToUpload']['type'][0];

    // File debugging
    
    // error_log("|", 3, "/var/www/grade/log/php.log");
    // error_log("Name: ".$test." ", 3, "/var/www/grade/log/php.log");
    // error_log("TMP Name: ".$test2." ", 3, "/var/www/grade/log/php.log");
    // error_log("Size: ".$test3." ", 3, "/var/www/grade/log/php.log");
    // error_log("Type: ".$test4, 3, "/var/www/grade/log/php.log");
    // error_log("|\n", 3, "/var/www/grade/log/php.log");


    // For loop for multiple files
    for ($i = 0; $i < $total_files; $i++) {
        if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i])) {
            $userID = $_SESSION['userID'];
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
            // File extension
            $ext = $path['extension'];
            // Temp path
            $temp_name = $_FILES['fileToUpload']['tmp_name'][$i];
            // Target path
            $path_filename_ext[] = $target_dir.$filename[$i].".".$ext;
            // DB insert var
            $dbfile[] = "upload/".$filename[$i].".".$ext;
            // Max size of files (byte,50MB)
            $maxSize = 50000000;

            // Check if file is not bigger than 50 MB
            if ($filesize >= $maxSize) {
                //error_log("FILESIZE: ".$filesize."||".$maxSize, 3, "/var/www/grade/log/php.log");
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

            $sqlfile = $db->prepare("INSERT INTO file (filename,fk_user) VALUES (:file,:fkuser)");
            $sqlfile->bindValue(':file', $dbfile[$i]);
            $sqlfile->bindValue(':fkuser', $userID);
            $finish = $sqlfile->execute();

            $sqlids = $db->prepare("SELECT MAX(file_id) FROM file");
            $idfres = $sqlids->execute();
            $idfrow = $idfres->fetchArray();
            
            $idfiles[$i] = $idfrow[0];
            $db->close();

        } else {

            // No file(s) uploaded
            $db = new SQLite3('../sqlite/webapp.db');
            $db->busyTimeout(5000);
            $db->exec('PRAGMA journal_mode = wal;');

            $dbfile = "No Image!";

            // File debugging

            // echo "################";
            // echo "T-EXTENSION: ".$text;
            // echo "T-NAME: ".$_FILES['fileToUpload']['name'][$i];
            // echo "T-TMPNAME: ".$_FILES['fileToUpload']['tmp_name'][$i];
            // echo "T-TYPE: ".$_FILES['fileToUpload']['type'][$i];
            // echo "################";
            // echo $dbfile;

            $sqlfile2 = $db->prepare("INSERT INTO file (filename) VALUES (:files)");
            $sqlfile2->bindValue(':files', $dbfile);
            $finish2 = $sqlfile2->execute();
            $db->close();
        }
    }
    
    $userID = $_SESSION['userID'];

    $db = new SQLite3('../sqlite/webapp.db');
    $db->busyTimeout(5000);
    $db->exec('PRAGMA journal_mode = wal;');

    // SQL insert into table "grade"
    $sql = $db->prepare("SELECT * from class WHERE class = :iclass AND fk_user = :user");
    $sql->bindValue(':iclass',$class);
    $sql->bindValue(':user',$userID);
    $r = $sql->execute();
    $row = $r->fetchArray();
    $fkclass = $row['class_id'];
    $sqlg = $db->prepare("INSERT INTO grade (grade,date,weighting,description,timestamp,fk_class,fk_user,deleted) VALUES (:grade,:date,:weighting,:des,date('now'),:fkclass,:userid,'false')");

    if (!$sql) {
        header("Location: ../index.php?error=sql");
        exit();
    } else {
        $sqlg->bindValue(':grade',$grade);
        $sqlg->bindValue(':date',$date);
        $sqlg->bindValue(':weighting',$weighting);
        $sqlg->bindValue(':des',$desc);
        $sqlg->bindValue(':fkclass',$fkclass);
        $sqlg->bindValue(':userid',$userID);
        $result = $sqlg->execute();

        $idselect = $db->prepare("SELECT MAX(grade_id) FROM grade");
        $idres = $idselect->execute();
        $idrow = $idres->fetchArray();
        $idgrade = $idrow[0];

        $i = 0;
        $a = $total_files;
        
        if ($dbfile != "No Image!") {
            while ($a != $i) {
                $file_grade = $db->prepare("INSERT INTO file_grade (fk_grade,fk_file) VALUES (:gradeid,:fileid)");
                $file_grade->bindValue(':gradeid',$idgrade);
                $file_grade->bindValue(':fileid',$idfiles[$i]);
                $file_result = $file_grade->execute();
                $i++;
            }
        }

        // Success message
        header("Location: ../index.php?info=success&grade=$grade&class=$class");
        exit();
    }
} else {
    // Redirect when accessed manually
    header("Location: account.php");
    exit();
}