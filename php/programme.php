
<?php
function renderForm($programmeId, $programmeName, $error)
 {
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Programme</title>
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
    <form action="programme.php" method="post">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">Programme Entry Form</th>
        <tr>
            <td colspan="2">programmeId</td>
            <td colspan="2"><input class="switch1" type="text" name="programme_id" value= "<?php echo $programmeId?>" ></td>
            <td><input type="submit" value="Get Record" name="getProgramme"></td>
        </tr>
        <tr>
            <td colspan="2">Programme</td>
            <td colspan="3"><input class="switch2" type="text" name="programme_name" value="<?php echo $programmeName ?>"></td>
    
        </tr>
        <tr>
            <td><input type="submit" value="Insert" name="insertProgramme"></td>
            <td><input type="submit" value="Update" name="updateProgramme"></td>
            <td><input type="submit" value="Delete" name="deleteProgramme"></td>
            <td><input type="submit" value="Get All Record" name="getAllProgramme"></td>
            </form>
            <form action="programme.php">
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
if(isset($_POST['getProgramme']))
{
    $ProgrammeId = $_POST['programme_id'];
    if (isset($ProgrammeId) && is_numeric($ProgrammeId) && $ProgrammeId > 0)
    {
        $sql = "SELECT * FROM programme WHERE programme_id = $ProgrammeId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $programmeId = $row['programme_id'];
            $programmeName = $row['programme_name'];
            renderForm($programmeId, $programmeName,'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '', $error);
        }
    }
    else
    {
        $error = "Please enter a valid Programme id";
        renderForm('', '', $error);
    }
    
}
else if(isset($_POST['insertProgramme']))
{
    $programmeId = $_POST['programme_id'];
    $programmeName = $_POST['programme_name'];
    if ((isset($programmeId) && is_numeric($programmeId) && $programmeId > 0) && (isset($programmeName) && $programmeName <= 20))
    {
        $sql = "INSERT INTO programme values( $programmeId ,'$programmeName')";
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
        $error = "Please enter programme id and programme";
        renderForm('','',$error);
    }
}
else if(isset($_POST['updateProgramme']))
{
    $programmeId = $_POST['programme_id'];
    $programmeName = $_POST['programme_name'];
    if ((isset($programmeName) && $programmeName <= 50))
    {
        $sql = "UPDATE programme SET programme_name = '$programmeName' WHERE programme_id = '$programmeId'";
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
        $error = "Please enter programme";
        renderForm('','',$error);
    }
}
else if(isset($_POST['deleteProgramme']))
{
    $programmeId = $_POST['programme_id'];
    if (isset($programmeId) && is_numeric($programmeId) && $programmeId > 0)
    {
        $sql = "DELETE FROM programme WHERE programme_id = $programmeId";
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
        $error = "Please enter a valid Programme id";
        renderForm('', '', $error);
    }
}
else if(isset($_POST['getAllProgramme']))
{
    header('Location: display-programme.php');
}
else
{
    $sql ="SELECT MAX(programme_id) AS max_programme_id FROM Programme";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $programmeId = $row['max_programme_id'] + 1;
    }
    renderForm($programmeId,'','');
}

?>

