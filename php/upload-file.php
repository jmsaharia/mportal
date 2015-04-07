	
<?php
 //require 'upload-study-material.php';
 require 'core.php';
 $targetfolder = "uploaded/";
 require 'connect_me.php';
 $targetfolder = $targetfolder.basename( $_FILES['file']['name']) ;
 
 if(move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder))
 { 
    $smTitle = $_POST['sm_title'];
    $smName = basename( $_FILES['file']['name']) ;
    $smPath = $targetfolder;
    $facultyId = getFacultyId();
    if (isset($smTitle) && isset($smName) && isset($smPath) && isset($facultyId))
    {
        $sql = "INSERT INTO study_material(sm_name, sm_path, sm_title, faculty_id) values('$smName','$smPath','$smTitle','$facultyId')";
        if(mysqli_query($con,$sql))
        {
            echo "The file ". basename( $_FILES['file']['name'])." is uploaded";
            header('Location: display-study-material.php');
        }
        else
        {
            echo "Unable to upload file ". basename( $_FILES['file']['name']);
            header('Location: upload-study-material.php');
        }
    }
    //renderForm($error);
 }
 else
 {
    echo "Unable to upload file ". basename( $_FILES['file']['name']);
    header('Location: upload-study-material.php');
    //renderForm($error);
 }
 
 ?>
