<?php
session_start();
if(isset($_POST['submit'])) {

    // POST vars
    $grade = $_POST['s_grade'];
    $date = $_POST['s_date'];
    $weighting = $_POST['s_weighting'];
    $description = $_POST['s_description'];
    $class = $_POST['s_class'];

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

    // Check if weighting is valid
    //else if ($weighting > 2.0 || $weighting < 0) {
    //    header("Location: ../index.php?error=weighting");
    //    exit();
    //}

    // Check if grade is valid
    else if ($grade > 6.0 || $grade < 0) {
        header("Location: ../index.php?error=grade?d=$date?w=$weighting?c=$class");
        exit();
    }

    if (empty($description)) {
        $description = "-";
    }
    
    // File array
    $filearray = array();
    $path_filename_ext = array();
    // Target directory var
    $target_dir = "../upload/";
    // Allowed extensions array
    $ext_arrays = array("jpg", "JPG", "jpeg", "JPEG");

    // For loop for multiple files
    for ($i = 0; $i < $total_files; $i++) {
        if(!is_uploaded_file($_FILES['fileToUpload']['tmp_name'][$i])) {
            $db = new SQLite3('../sqlite/webapp.db');
            $db->busyTimeout(5000);
            $db->exec('PRAGMA journal_mode = wal;');
            $dbfile = "No Image!";
            echo $dbfile;
            $sqlfile2 = $db->prepare("INSERT INTO file (filename) VALUES (:files)");
            $sqlfile2->bindValue(':files', $dbfile);
            $finish2 = $sqlfile2->execute();
            $db->close();
            break;
        } else {
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
            // Temp path
            $temp_name = $_FILES['fileToUpload']['tmp_name'][$i];
            // Target path
            $path_filename_ext[] = $target_dir.$filename[$i].".".$ext;
            // Encrypt
            //$fileData = file_get_contents($_FILES["fileToUpload"]["tmp_name"][$i]);
            //$aes = new AES($fileData, $inputKey, $blockSize);
            //$encData = $aes->encrypt();
            //file_put_contents($path_filename_ext[$i], $encData);        
            //echo $encData;
            // DB insert
            $dbfile[] = "upload/".$filename[$i].".".$ext;
            // Max size of files (byte)
            $maxSize = 0;

            // Check if extension is allowed
            if (!empty($ext)) {
                // Check if $ext is in $ext_arrays
                if (!in_array($ext, $ext_arrays)) {
                    header("Location: ../index.php?error=wrongext");
                    exit();
                }
            }

            // Check if file already exists
            //if (file_exists($path_filename_ext[$i])) {
            //    header("Location: ../index.php?error=exist");
            //    exit();
            //}

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
        }
    }
    
    $db = new SQLite3('../sqlite/webapp.db');
    $db->busyTimeout(5000);
    $db->exec('PRAGMA journal_mode = wal;');

    // SQL insert into table "grade"
    $sql = $db->prepare("SELECT class_id from class WHERE class='$class'");
    $r = $sql->execute();
    $row = $r->fetchArray();
    $fkclass = $row['class_id'];
    $userID = $_SESSION['userID'];
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
        while ($a != $i) {
            $file_grade = $db->prepare("INSERT INTO file_grade (fk_grade,fk_file) VALUES (:gradeid,:fileid)");
            $file_grade->bindValue(':gradeid',$idgrade);
            $file_grade->bindValue(':fileid',$idfiles[$i]);
            $file_result = $file_grade->execute();
            $i++;
        }
        //} else {
        //    echo "Check = FALSE";
        //}

        // Success message
        header("Location: ../index.php?info=success");
        exit();
    }
}