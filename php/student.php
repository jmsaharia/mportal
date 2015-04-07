
<?php
function renderForm($studentId, $collageId, $studentName, $studentAddress, $studentMobile, $studentEmail, $error)
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
    <form action="student.php" method="post">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">Student Entry Form</th>
        <tr>
            <td colspan="2">Student Id</td>
            <td colspan="2"><input class="switch1" type="text" name="student_id" value= "<?php echo $studentId?>" ></td>
            <td><input type="submit" value="Get Record" name="getStudent"></td>
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
            <td colspan="2">Student Name</td>
            <td colspan="3"><input class="switch2" type="text" name="student_name" value="<?php echo $studentName ?>"></td>
    
        </tr>
	
        <tr>
            </tr>
        <tr>
            <td colspan="2">Student Address</td>
            <td colspan="3"><textarea class="switch3" name="student_address"><?php echo $studentAddress ?></textarea></td>
    
        </tr>
        <tr>
            <td colspan="2">Mobile</td>
            <td colspan="3"><input class="switch4" type="text" name="student_mobile" value="<?php echo $studentMobile ?>"></td>
    
        </tr>
        <tr>
            <td colspan="2">Email</td>
            <td colspan="3"><input class="switch5" type="text" name="student_email" value="<?php echo $studentEmail ?>"></td>
    
        </tr>
        <tr>
            <td><input type="submit" value="Insert" name="insertStudent"></td>
            <td><input type="submit" value="Update" name="updateStudent"></td>
            <td><input type="submit" value="Delete" name="deleteStudent"></td>
            <td><input type="submit" value="Get All Record" name="getAllStudent"></td>
            </form>
            <form action="student.php">
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
if(isset($_POST['getStudent']))
{
    $studentId = $_POST['student_id'];
    if (isset($studentId) && is_numeric($studentId) && $studentId > 0)
    {
        $sql = "SELECT * FROM student WHERE student_id = $studentId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
        $studentId = $row['student_id'];
	    $collageId = $row['collage_id'];
        $studentName = $row['student_name'];
	    $studentAddress = $row['student_address'];
	    $studentMobile = $row['student_mobile'];
	    $studentEmail = $row['student_email'];
            renderForm($studentId, $collageId, $studentName, $studentAddress, $studentMobile, $studentEmail,'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '','', '','','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid student id";
        renderForm('', '','','','','', $error);
    }
    
}
else if(isset($_POST['insertStudent']))
{
    $studentId = $_POST['student_id'];
    $collageId = $_POST['collage_id'];
    $studentName = $_POST['student_name'];
    $studentAddress = ($_POST['student_address']);
    $studentMobile = $_POST['student_mobile'];
    $studentEmail = $_POST['student_email'];
 
    if ((isset($studentId) ))
    {
        $sql = "INSERT INTO student(student_id, collage_id, student_name, student_address, student_mobile, student_email) values('$studentId', $collageId , '$studentName', '$studentAddress', '$studentMobile', '$studentEmail')";
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
        $error = "Please enter student id and student";
        renderForm('','','','','','',$error);
    }
}
else if(isset($_POST['updateStudent']))
{
    $studentId = $_POST['student_id'];
    $collageId = $_POST['collage_id'];
    $studentName = $_POST['student_name']  ;
    $studentAddress =$_POST['student_address'];
    $studentMobile = $_POST['student_mobile'];
    $studentEmail = $_POST['student_email'];
    if ((isset($studentName) && $studentName <= 50))
    {
        $sql = "UPDATE student SET student_name = '$studentName', student_address = '$studentAddress', student_mobile = '$studentMobile', student_email = '$studentEmail' WHERE student_id = '$studentId'";
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
        $error = "Please enter student";
        renderForm('','','','','','',$error);
    }
}
else if(isset($_POST['deleteStudent']))
{
    $studentId = $_POST['student_id'];
    if (isset($studentId) && is_numeric($studentId) && $studentId > 0)
    {
        $sql = "DELETE FROM student WHERE student_id = $studentId";
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
        $error = "Please enter a valid student id";
        renderForm('','','','','','', $error);
    }
}
else if(isset($_POST['getAllStudent']))
{
    header('Location: display-student.php');
}
else
{
    $sql ="SELECT MAX(student_id) AS max_student_id FROM student";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $studentId = $row['max_student_id'] + 1;
    }
    renderForm($studentId,'','','','','','');
}

?>

