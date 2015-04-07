
<?php
function renderForm($facultyId, $collageId, $facultyName, $facultyAddress, $phone, $email, $error)
 {
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Faculty</title>
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
    <form action="faculty.php" method="post">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">Faculty Entry Form</th>
        <tr>
            <td colspan="2">Faculty Id</td>
            <td colspan="2"><input class="switch1" type="text" name="faculty_id" value= "<?php echo $facultyId?>" ></td>
            <td><input type="submit" value="Get Record" name="getFaculty"></td>
        </tr>
	<?php
	require 'connect_me.php';
	$sql = "SELECT * FROM collage";
	$result = mysqli_query($con,$sql);
        ?>
	<tr>
            <td colspan="2">Collage Name</td>
            <td colspan="3">
		<select name="collage_id">
		    <option style='display:none;'>--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['collage_id'] == $collageId)
			{
			?>
			<option value="<?php echo $row['collage_id'];?>" selected><?php echo $row['collage_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['collage_id'];?>"><?php echo $row['collage_name']; ?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
        <tr>
            <td colspan="2">Faculty Name</td>
            <td colspan="3"><input class="switch2" type="text" name="faculty_name" value="<?php echo $facultyName ?>"></td>
    
        </tr>
	
        <tr>
            </tr>
        <tr>
            <td colspan="2">Faculty Address</td>
            <td colspan="3"><textarea class="switch3" name="faculty_address"><?php echo $facultyAddress ?></textarea></td>
    
        </tr>
        <tr>
            <td colspan="2">Phone</td>
            <td colspan="3"><input class="switch4" type="text" name="phone" value="<?php echo $phone ?>"></td>
    
        </tr>
        <tr>
            <td colspan="2">Email</td>
            <td colspan="3"><input class="switch5" type="text" name="email" value="<?php echo $email ?>"></td>
    
        </tr>
        <tr>
            <td><input type="submit" value="Insert" name="insertFaculty"></td>
            <td><input type="submit" value="Update" name="updateFaculty"></td>
            <td><input type="submit" value="Delete" name="deleteFaculty"></td>
            <td><input type="submit" value="Get All Record" name="getAllFaculty"></td>
            </form>
            <form action="faculty.php">
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
if(isset($_POST['getFaculty']))
{
    $facultyId = $_POST['faculty_id'];
    if (isset($facultyId) && is_numeric($facultyId) && $facultyId > 0)
    {
        $sql = "SELECT * FROM faculty WHERE faculty_id = $facultyId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
        $facultyId = $row['faculty_id'];
	    $collageId = $row['collage_id'];
        $facultyName = $row['faculty_name'];
	    $facultyAddress = $row['faculty_address'];
	    $phone = $row['phone'];
	    $email = $row['email'];
            renderForm($facultyId, $collageId, $facultyName, $facultyAddress, $phone, $email,'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '','', '','','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid faculty id";
        renderForm('', '','','','','', $error);
    }
    
}
else if(isset($_POST['insertFaculty']))
{
    $facultyId = $_POST['faculty_id'];
    $collageId = $_POST['collage_id'];
    $facultyName = $_POST['faculty_name'];
    $facultyAddress = ($_POST['faculty_address']);
    $phone = $_POST['phone'];
    $email = $_POST['email'];
 
    if ((isset($facultyId) ))
    {
        $sql = "INSERT INTO faculty values('$facultyId', $collageId , '$facultyName', '$facultyAddress', '$phone', '$email',null)";
        if(mysqli_query($con,$sql))
        {
            $error = "Record inserted successfully";
            renderForm('','','','','','',$error);
        }
        else
        {
            $error = "Unable to add record";
            renderForm('','','','','','',$error);
        }
    }
    else
    {
        $error = "Please enter faculty id and faculty";
        renderForm('','','','','','',$error);
    }
}
else if(isset($_POST['updateFaculty']))
{
    $facultyId = $_POST['faculty_id'];
    $collageId = $_POST['collage_id'];
    $facultyName = $_POST['faculty_name']  ;
    $facultyAddress =$_POST['faculty_address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    if ((isset($facultyName) && $facultyName <= 50))
    {
        $sql = "UPDATE faculty SET faculty_name = '$facultyName', faculty_address = '$facultyAddress', phone = '$phone', email = '$email' WHERE faculty_id = '$facultyId'";
        if(mysqli_query($con,$sql))
        {
            $error = "Record updated successfully";
            renderForm('','','','','','',$error);
        }
        else
        {
            $error = "Unable to update record";
            renderForm('','','','','','',$error);
        }
    }
    else
    {
        $error = "Please enter faculty";
        renderForm('','','','','','',$error);
    }
}
else if(isset($_POST['deleteFaculty']))
{
    $facultyId = $_POST['faculty_id'];
    if (isset($facultyId) && is_numeric($facultyId) && $facultyId > 0)
    {
        $sql = "DELETE FROM faculty WHERE faculty_id = $facultyId";
        if(mysqli_query($con,$sql))
        {
            $error = "Record deleted successfully";
            renderForm('','','','','','',$error);
        }
        else
        {
            $error = "Unable to delete record";
            renderForm('','','','','','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid faculty id";
        renderForm('','','','','','', $error);
    }
}
else if(isset($_POST['getAllFaculty']))
{
    header('Location: display-faculty.php');
}
else
{
    $sql ="SELECT MAX(faculty_id) AS max_faculty_id FROM faculty";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $facultyId = $row['max_faculty_id'] + 1;
    }
    renderForm($facultyId,'','','','','','');
}

?>

