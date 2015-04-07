
<?php
function renderForm($subjectId, $subjectName, $error)
 {
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Subject</title>
</head>
<body>
    
<?php 
 if ($error != '')
 {
 //echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 ?>
<script>alert('<?php echo $error ?>');</script>
<?php
 }
 include "home.php";
 ?>
 <div class="position">
    <form action="subject.php" method="post">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">Subject Entry Form</th>
        <tr>
            <td colspan="2">Subject Id</td>
            <td colspan="2"><input class="switch1" type="text" name="subject_id" value= "<?php echo $subjectId ?>" ></td>
            <td><input type="submit" value="Get Record" name="getSubject"></td>
        </tr>
        <tr>
            <td colspan="2">Subject</td>
            <td colspan="3"><input class="switch2" type="text" name="subject_name" value="<?php echo $subjectName ?>"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Insert" name="insertSubject"></td>
            <td><input type="submit" value="Update" name="updateSubject"></td>
            <td><input type="submit" value="Delete" name="deleteSubject"></td>
            <td><input type="submit" value="Get All Record" name="getAllSubject"></td>
            </form>
            <form action="subject.php">
                <td><input type="submit" value="Refresh"></td>
            </form>    
        </tr>   
    </table>
</div>
<div id="footer">
		
</div>
</div>
</body>
</html>
<?php
}
?>

<?php
require 'connect_me.php';
if(isset($_POST['getSubject']))
{
    $subjectId = $_POST['subject_id'];
    if (isset($subjectId) && is_numeric($subjectId) && $subjectId > 0)
    {
        $sql = "SELECT * FROM subject WHERE subject_id = $subjectId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $subjectId = $row['subject_id'];
            $subjectName = $row['subject_name'];
            renderForm($subjectId, $subjectName,'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '', $error);
        }
    }
    else
    {
        $error = "Please enter a valid subject id";
        renderForm('', '', $error);
    }
    
}
else if(isset($_POST['insertSubject']))
{
    $subjectId = $_POST['subject_id'];
    $subjectName = $_POST['subject_name'];
    if ((isset($subjectId) && is_numeric($subjectId) && $subjectId > 0) && (isset($subjectName) && $subjectName <= 20))
    {
        $sql = "INSERT INTO subject values( $subjectId ,'$subjectName')";
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
        $error = "Please enter subject id and subject";
        renderForm('','',$error);
    }
}
else if(isset($_POST['updateSubject']))
{
    $subjectId = $_POST['subject_id'];
    $subjectName = $_POST['subject_name'];
    if ((isset($subjectName) && $subjectName <= 50))
    {
        $sql = "UPDATE subject SET subject_name = '$subjectName' WHERE subject_id = '$subjectId'";
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
        $error = "Please enter subject";
        renderForm('','',$error);
    }
}
else if(isset($_POST['deleteSubject']))
{
    $subjectId = $_POST['subject_id'];
    if (isset($subjectId) && is_numeric($subjectId) && $subjectId > 0)
    {
        $sql = "DELETE FROM subject WHERE subject_id = $subjectId";
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
        $error = "Please enter a valid subject id";
        renderForm('', '', $error);
    }
}
else if(isset($_POST['getAllSubject']))
{
    header('Location: display-subject.php');
}
else
{
    $sql ="SELECT MAX(subject_id) AS max_subject_id FROM subject";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $subjectId = $row['max_subject_id'] + 1;
    }
    renderForm($subjectId,'','');
}

?>

