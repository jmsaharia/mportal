
<?php

function renderForm ($userId, $userName, $password,$facultyId,$studentId,$error)
{
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>User</title>
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
    <form action="user.php" method= "post" >
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">Create User Form</th>
	<input type="hidden" name="role" value="<?php getRoleId(); ?>">
        <tr>
            <td colspan="2">Create user Id</td>
            <td colspan="2"><input class="switch1" type="text" name="user_id" value= "<?php echo $userId?>" ></td>
            <td>
		<?php if($roleid == 1) { ?>
		<input type="submit" value="Get Record" name="getUserByAdmin">
		<?php }
		if($roleid == 2)
		{
		?>
		<input type="submit" value="Get Record" name="getUserByFaculty"></td>
		<?php
		}
		?>
        </tr>
		<tr>
            <td colspan="2">User Name</td>
            <td colspan="3"><input class="switch1" type="text" name="user_name" value= "<?php echo $userName?>" ></td>
        </tr>
	<tr>
            <td colspan="2">Password</td>
            <td colspan="3"><input class="switch1" type="text" name="password" value= "<?php echo $password?>" ></td>
        </tr>
	<?php
	require 'connect_me.php';
	$sql = "SELECT * FROM role";
	$result = mysqli_query($con,$sql);
        ?>
	
	<?php
	$roleid = getRoleId();
	?>

       <?php
	$sql = "SELECT faculty_id, faculty_name, collage_name FROM faculty f, collage c where f.collage_id = c.collage_id";
	$result = mysqli_query($con,$sql);
	if($roleid == 1)
	{
        ?>
	<tr>
            <td colspan="2">Faculty Name</td>
            <td colspan="3">
		<select name="faculty_id">
		    <option style='display:none;'value="-1">--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['faculty_id'] == $facultyId)
			{
			?>
			<option value="<?php echo $row['faculty_id'];?>" selected> <?php echo $row['faculty_name']." / ".$row['collage_name'];?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['faculty_id'];?>"> <?php echo $row['faculty_name']." / ".$row['collage_name'];?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
	<?php
	}
	$sql = "SELECT student_id, student_name, collage_name FROM student s, collage c where s.collage_id = c.collage_id";
	$result = mysqli_query($con,$sql);
	if($roleid == 2)
	{
        ?>
	<tr>
            <td colspan="2">Student Name</td>
            <td colspan="3">
		<select name="student_id">
		    <option style='display:none;'value="-2">--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['student_id'] == $studentId)
			{
			?>
			<option value="<?php echo $row['student_id'];?>" selected> <?php echo $row['student_name']." / ".$row['student_id']." / ".$row['collage_name'];?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['student_id'];?>"> <?php echo $row['student_name']." / ".$row['student_id']." / ".$row['collage_name'];?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
	<?php
	}
	?>
        <tr>
	    <?php if($roleid == 1){ ?>
            <td><input type="submit" value="Insert" name="insertByAdmin"></td>
            <td><input type="submit" value="Update" name="updateByAdmin"></td>
	    <?php
	    }
	    if($roleid== 2){ ?>
	    <td><input type="submit" value="Insert" name="insertByFaculty"></td>
            <td><input type="submit" value="Update" name="updateByFaculty"></td>
	    <?php }?>
            <td><input type="submit" value="Delete" name="deleteUser"></td>
            <td><input type="submit" value="Get All Record" name="getAllUser"></td>
            </form>
            <form action="user.php">
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
if(isset($_POST['getUserByAdmin']))
{
    $userId = $_POST['user_id'];
    if (isset($userId) && is_numeric($userId) && $userId > 0)
    {
        $sql = "SELECT u.user_id,user_name,password,faculty_id FROM user u, faculty f WHERE u.user_id = f.user_id and f.user_id = $userId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $userId = $row['user_id'];
	    $userName = $row['user_name'];
	    $password = $row['password'];
            $facultyId = $row['faculty_id'];
	    renderForm($userId, $userName, $password,$facultyId,'','');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '','','','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid user_id";
        renderForm('', '','','','',$error);
    }
    
}
elseif(isset($_POST['getUserByFaculty']))
{
    $userId = $_POST['user_id'];
    if (isset($userId) && is_numeric($userId) && $userId > 0)
    {
        $sql = "SELECT u.user_id,user_name,password,student_id FROM user u, student s WHERE u.user_id = s.user_id and s.user_id = $userId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $userId = $row['user_id'];
	    $userName = $row['user_name'];
	    $password = $row['password'];
            $studentId = $row['student_id'];
	    renderForm($userId, $userName, $password, '',$studentId,'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '','','','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid user_id";
        renderForm('', '','','','',$error);
    }
    
}
else if(isset($_POST['insertByAdmin']))
{
    $userId = $_POST['user_id'];
    $userName = $_POST['user_name'];
    $password = $_POST['password'];
    $facultyId = $_POST['faculty_id'];
    if(isset($facultyId))
    {
        $sql = "INSERT INTO user(user_id,user_name,password,role_id) values('$userId', '$userName', '$password', 2)";
	$sql3 = "Update faculty set user_id= '$userId' where faculty_id = '$facultyId'";
        if(mysqli_query($con,$sql))
        {
	    if($facultyId != -1 && mysqli_query($con,$sql3))
	    {
		$error = "Faculty Record inserted successfully";
		renderForm('','','','','','',$error);
	    }
	    
        }
	else
	    {
		$error = "Unable to add record";
		renderForm('','','','','','',$error);
	    }
    }
     else
    {
        $error = "Please enter User_id ";
	renderForm('','','','','','',$error);
    }   
}
else if(isset($_POST['updateByAdmin']))
{
    $userId = $_POST['user_id'];
    $userName = $_POST['user_name'];
    $password = $_POST['password'];
    $facultyId = $_POST['faculty_id'];
    if (isset($userName) && $userName <= 50)
    {
        $sql = "UPDATE user SET user_name='$userName',password='$password' WHERE user_id = '$userId'";
        if(mysqli_query($con,$sql))
        {
            $error = "Record Updated Successfully";
            renderForm('','','','','',$error);
        }
        else
        {
            $error = "Unable to Update Record";
            renderForm('','','','','',$error);
        }
    }
    else
    {
        $error = "Please Enter User";
        renderForm('','','','','',$error);
    }
}
else if(isset($_POST['insertByFaculty']))
{
    $userId = $_POST['user_id'];
    $userName = $_POST['user_name'];
    $password = $_POST['password'];
    $studentId = $_POST['student_id'];
    if(isset($studentId))
    {
        $sql = "INSERT INTO user(user_id,user_name,password,role_id) values('$userId', '$userName', '$password',3)";
	$sql3 = "Update student set user_id= '$userId' where student_id = '$studentId'";
        if(mysqli_query($con,$sql))
        {
	    if($studentId != -2 && mysqli_query($con,$sql3))
	    {
		$error = "Student Record inserted successfully";
		renderForm('','','','','','',$error);
	    }
	    else
	    {
		$error = "Unable to add record";
		renderForm('','','','','','',$error);
	    }
        }
    }
     else
    {
        $error = "Please enter User_id ";
	renderForm('','','','','','',$error);
    }   
}
else if(isset($_POST['updateByFaculty']))
{
    $userId = $_POST['user_id'];
    $userName = $_POST['user_name'];
    $password = $_POST['password'];
    $studentId = $_POST['student_id'];
    if (isset($userName) && $userName <= 50)
    {
        $sql = "UPDATE user SET user_name='$userName',password='$password' WHERE user_id = '$userId'";
        if(mysqli_query($con,$sql))
        {
            $error = "Record Updated Successfully";
            renderForm('','','','','',$error);
        }
        else
        {
            $error = "Unable to Update Record";
            renderForm('','','','','',$error);
        }
    }
    else
    {
        $error = "Please Enter User";
        renderForm('','','','','',$error);
    }
}
else if(isset($_POST['deleteUser']))
{
    $userId = $_POST['user_id'];
    if (isset($userId) && is_numeric($userId) && $userId > 0)
    {
        $sql = "DELETE FROM user WHERE user_id = $userId";
        if(mysqli_query($con,$sql))
        {
            $error = "Record Deleted Successfully";
            renderForm('','','','','',$error);
        }
        else
        {
            $error = "Unable to Delete Record";
            renderForm('','','','','',$error);
        }
    }
    else
    {
        $error = "Please Enter a Valid User id";
        renderForm('','','','','',$error);
    }
}
else if(isset($_POST['getAllUser']))
{
    header('Location: display-user.php');
}
else
{
    $sql ="SELECT MAX(user_id) AS max_user_id FROM user";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $userId = $row['max_user_id'] + 1;
    }
    renderForm($userId,'','','','','','');
}

?>

