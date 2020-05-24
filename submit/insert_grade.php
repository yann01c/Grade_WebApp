<?php
session_start();
if(isset($_POST['submit'])) {

    // POST vars
    $grade = $_POST['s_grade'];
    $date = $_POST['s_date'];
    $weighting = $_POST['s_weighting'];
    $description = $_POST['s_description'];
    $class = $_POST['s_class'];

    // Count files
    if (isset($_FILES['fileToUpload']['name'])) { 
        $total_files = count($_FILES['fileToUpload']['name']);
    }

    // Check for missing fields
    if (empty($grade) || empty($date) || empty($weighting)) {
        header("Location: ../index.php?error=empty");
        exit();
    }

    // Check if weighting is valid
    else if ($weighting > 2.0 || $weighting < 0) {
        header("Location: ../index.php?error=weighting");
        exit();
    }

    // Check if grade is valid
    else if ($grade > 6.0 || $grade < 0) {
        header("Location: ../index.php?error=grade");
        exit();
    }

    // Check if no file was submitted
    $db = new SQLite3('../sqlite/webapp.db');

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
            $dbfile = "No Image";
            echo $dbfile;
            $sqlfile2 = $db->prepare("INSERT INTO file (filename) VALUES (:files)");
            $sqlfile2->bindValue(':files', $dbfile);
            $finish2 = $sqlfile2->execute();
            break;
        } else {
            // Type
            $filetype = $_FILES['fileToUpload']['type'][$i];
            // Size
            $filesize = $_FILES['fileToUpload']['size'][$i];
            // File
            $file = $_FILES['fileToUpload']['name'][$i];
            // Path
            $path = pathinfo($file);
            // Filename
            //$filename = $path['filename'];

            // Custom file name
            //$filename = "file".$i.$_SESSION['userID'];
            $filename[] = md5(uniqid(rand(), true));
            //echo "Filename = ".$filename.$id;
            echo "<h1>".$filename[$i]."</h1>";
            // File extension
            $ext = $path['extension'];
            // Temp path
            $temp_name = $_FILES['fileToUpload']['tmp_name'][$i];
            // Target path
            $path_filename_ext[] = $target_dir.$filename[$i].".".$ext;
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
            if (file_exists($path_filename_ext[$i])) {
                header("Location: ../index.php?error=exist");
                exit();
            }

            // Move file(s) in /upload directory with the right permissions
            move_uploaded_file($temp_name,$path_filename_ext[$i]);
            chmod($path_filename_ext[$i], 0755);

            // Change content when empty
            //if (empty($file)) {
            //    $file = "No Image";
            //} else {
            //    $file = "upload/".$filename.".".$ext;
            //}

            $sqlfile = $db->prepare("INSERT INTO file (filename) VALUES (:file)");
            $sqlfile->bindValue(':file', $dbfile[$i]);
            $finish = $sqlfile->execute();

            if ($total_files > 1) {
                echo "File's Submitted";
            } else {
                echo "File Submitted";
            }
        }
    }
    
    // SQL insert into table "grade"
    $db = new SQLite3('../sqlite/webapp.db');
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
        $maxid = $idrow[0];

        //$fileid = $db->prepare("INSERT INTO file_grade (fk_file,fk_grade) VALUES (...,$maxid)")
        // Success message
        header("Location: ../index.php?info=success");
        exit();
    }
}