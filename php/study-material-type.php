
<?php
function renderForm($study-material-typeId, $study-material-typeName, $error)
 {
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>study-material-type</title>
</head>
<body>
    
<?php 
 if ($error != '')
 {
 //echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 ?>
<script>alert('<?php echo $error ?>');</script>

<?php
include 'home.php';
require 'connect_me.php';
if(isset($_POST['getStudy-material-type']))
{
    $study-material-typeId = $_POST['study-material-type_id'];
    if (isset($study-material-typeId) && is_numeric($study-material-typeId) && $study-material-typeId > 0)
    {
        $sql = "SELECT * FROM study-material-type WHERE study-material-type_id = $study-material-typeId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $study-material-typeId = $row['study-material-type_id'];
            $study-material-typeName = $row['study-material-type_name'];
            renderForm($study-material-typeId, $study-material-typeName,'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '', $error);
        }
    }
    else
    {
        $error = "Please enter a valid study-material-type id";
        renderForm('', '', $error);
    }
    
}
else if(isset($_POST['insertStudy-material-type']))
{
    $study-material-typeId = $_POST['study-material-type_id'];
    $study-material-typeName = mysql_real_escape_string(htmlspecialchars($_POST['study-material-type_name']));
    if ((isset($study-material-typeId) && is_numeric($study-material-typeId) && $study-material-typeId > 0) && (isset($study-material-typeName) && $study-material-typeName <= 20))
    {
        $sql = "INSERT INTO study-material-type values( $study-material-typeId ,'$study-material-typeName')";
        if(mysqli_query($con,$sql))
        {
            $error = "Record inserted successfully";
            renderForm('','',$error);
        }
        else
        {
            $error = "Unable to add record";
            renderForm('','',$error);
        }
    }
    else
    {
        $error = "Please enter study-material-type id and study-material-type";
        renderForm('','',$error);
    }
}
else if(isset($_POST['updateStudy-material-type']))
{
    $study-material-typeId = $_POST['study-material-type_id'];
    $study-material-typeName = mysql_real_escape_string(htmlspecialchars($_POST['study-material-type_name']));
    if ((isset($study-material-typeName) && $study-material-typeName <= 50))
    {
        $sql = "UPDATE study-material-type SET study-material-type_name = '$study-material-typeName' WHERE study-material-type_id = '$study-material-typeId'";
        if(mysqli_query($con,$sql))
        {
            $error = "Record updated successfully";
            renderForm('','',$error);
        }
        else
        {
            $error = "Unable to update record";
            renderForm('','',$error);
        }
    }
    else
    {
        $error = "Please enter study-material-type";
        renderForm('','',$error);
    }
}
else if(isset($_POST['deleteStudy-material-type']))
{
    $study-material-typeId = $_POST['study-material-type_id'];
    if (isset($study-material-typeId) && is_numeric($study-material-typeId) && $study-material-typeId > 0)
    {
        $sql = "DELETE FROM study-material-type WHERE study-material-type_id = $study-material-typeId";
        if(mysqli_query($con,$sql))
        {
            $error = "Record deleted successfully";
            renderForm('','',$error);
        }
        else
        {
            $error = "Unable to delete record";
            renderForm('','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid study-material-type id";
        renderForm('', '', $error);
    }
}
else if(isset($_POST['getAllStudy-material-type']))
{
    header('Location: display-study-material-type.php');
}
else
{
    $sql ="SELECT MAX(study-material-type_id) AS max_study-material-type_id FROM study-material-type";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $study-material-typeId = $row['max_study-material-type_id'] + 1;
    }
    renderForm($study-material-typeId,'','');
}

?>