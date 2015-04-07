<?php

?>
<?php
function renderForm($collageId, $collageName, $collageLocation, $error)
 {
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>College</title>
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
	
    <form action="collage.php" method="post">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">College Entry Form</th>
        <tr>
            <td colspan="2">College Id</td>
            <td colspan="2"><input class="switch1" type="text" name="collage_id" value= "<?php echo $collageId ?>" ></td>
            <td><input type="submit" value="Get Record" name="getCollage"></td>
        </tr>
		<tr>
            <td colspan="2">College Name</td>
            <td colspan="3"><textarea class="switch2" name="collage_name"><?php echo $collageName?></textarea></td>
        </tr>
        <tr>
            <td colspan="2">College Location</td>
            <td colspan="3"><textarea class="switch3" name="collage_location"><?php echo $collageLocation?></textarea></td>
        </tr>
        <tr>
            <td><input type="submit" value="Insert" name="insertCollage"></td>
            <td><input type="submit" value="Update" name="updateCollage"></td>
            <td><input type="submit" value="Delete" name="deleteCollage"></td>
            <td><input type="submit" value="Get All Record" name="getAllCollage"></td>
            </form>
            <form action="collage.php">
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
if(isset($_POST['getCollage']))
{
    $collageId = $_POST['collage_id'];
    if (isset($collageId) && is_numeric($collageId) && $collageId > 0)
    {
        $sql = "SELECT * FROM collage WHERE collage_id = $collageId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $collageId = $row['collage_id'];
            $collageName = $row['collage_name'];
            $collageLocation = $row['collage_location'];
            renderForm($collageId, $collageName, $collageLocation, '');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '', '',$error);
        }
    }
    else
    {
        $error = "Please enter a valid College id";
        renderForm('', '', '', $error);
    }
    
}
else if(isset($_POST['insertCollage']))
{
    $collageId = $_POST['collage_id'];
    $collageName = $_POST['collage_name'];
    $collageLocation =$_POST['collage_location'];
    if ((isset($collageId) && is_numeric($collageId) && $collageId > 0) && (isset($collageName) && $collageName <= 20))
    {
        $sql = "INSERT INTO collage values( $collageId ,'$collageName', '$collageLocation')";
        if(mysqli_query($con,$sql))
        {
            $error = "Record inserted successfully";
            renderForm('','','',$error);
        }
        else
        {
            $error = "Unable to add record";
            renderForm('','','',$error);
        }
    }
    else
    {
        $error = "Please enter College id and College";
        renderForm('','','',$error);
    }
}
else if(isset($_POST['updateCollage']))
{
    $collageId = $_POST['collage_id'];
    $collageName = $_POST['collage_name'];
    $collageLocation = $_POST['collage_location'];
    if ((isset($collageName) && $collageName <= 50))
    {
        $sql = "UPDATE collage SET collage_name = '$collageName', collage_location = '$collageLocation' WHERE collage_id = '$collageId'";
        if(mysqli_query($con,$sql))
        {
            $error = "Record updated successfully";
            renderForm('','','',$error);
        }
        else
        {
            $error = "Unable to update record";
            renderForm('','','',$error);
        }
    }
    else
    {
        $error = "Please enter College";
        renderForm('','','',$error);
    }
}
else if(isset($_POST['deleteCollage']))
{
    $collageId = $_POST['collage_id'];
    if (isset($collageId) && is_numeric($collageId) && $collageId > 0)
    {
        $sql = "DELETE FROM collage WHERE collage_id = $collageId";
        if(mysqli_query($con,$sql))
        {
            $error = "Record deleted successfully";
            renderForm('','','',$error);
        }
        else
        {
            $error = "Unable to delete record";
            renderForm('','','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid collage id";
        renderForm('', '','', $error);
    }
}
else if(isset($_POST['getAllCollage']))
{
    header('Location: display-collage.php');
}
else
{
    $sql ="SELECT MAX(collage_id) AS max_collage_id FROM collage";
    $result = mysqli_query($con,$sql);

    while($row = mysqli_fetch_array($result))
    {
        $collageId = $row['max_collage_id'] + 1;
    }
renderForm($collageId,'','','');
}

?>

